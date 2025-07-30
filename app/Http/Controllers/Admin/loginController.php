<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use App\Notifications\UserWelcomeMailNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class loginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.login");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        $request->session()->regenerate();

        $currentUser = $request->user();

        // theck if currentUser is active before login
        if (! $currentUser || ! $currentUser->is_active) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'error' => 'Votre compte n\'est pas actif. Contactez le Super Admin.',
            ]);
        }

        // Redirection to dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Show datas for admin in dashboard.
     */
    public function dashboard(Income $Incomes, Expense $expenses, User $request): View
    {

        // --------------------- HEAD DASHBOARD---------------------
        // incomes
        $totalIncomes       = Income::sum('amount');
        $totalIncomeRecords = Income::count();

        //expenses
        $totalExpenses       = Expense::sum('amount');
        $totalExpenseRecords = Expense::count();

        // *** about income_type_id and expense_type_id :  normal represents 1 pfs represents 2
        // *** MAKE SURE this is how recorded in the database

        //normal profit
        $totalNormalProfit        = Income::where('income_type_id', 1)->sum('amount') - Expense::where('expense_type_id', 1)->sum('amount');
        $totalNormalIncomeRecords = Income::where('income_type_id', 1)->count();

        //pfs profit
        $totalPfsProfit        = Income::where('income_type_id', 2)->sum('amount') - Expense::where('expense_type_id', 2)->sum('amount');
        $totalPfsIncomeRecords = Income::where('income_type_id', 2)->count();

        //customer
        $totalCustomers = Customer::count();

        //activity
        $totalActivities = Activity::count();

        //total profit
        $totalProfit = $totalIncomes - $totalExpenses;
        $users       = User::where('role', 'admin')->get();

        // --------------------- CHARTS DASHBOARD---------------------

        // >>>>>>>bar chart incomes and expenses by month

        $totalIncomesPerMonth = Income::selectRaw('MONTH(payment_date) as month, SUM(amount) as totalIncomesPerMonth')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('totalIncomesPerMonth', 'month')
            ->toArray();

        $totalExpensesPerMonth = Expense::selectRaw('MONTH(payment_date) as month, SUM(amount) as totalExpensesPerMonth')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('totalExpensesPerMonth', 'month')
            ->toArray();

        // Ceci génère un tableau de 12 mois initialisé à 0 pour equivalence entre chriffres et mois lors de l'envoi de donnees php(LoginController) vers Js(canvans_chart.js)
        $incomesByMonth = array_fill(1, 12, 0);
        foreach ($totalIncomesPerMonth as $month => $amount) {
            $incomesByMonth[$month] = $amount;
        }

        $expensesByMonth = array_fill(1, 12, 0);
        foreach ($totalExpensesPerMonth as $month => $amount) {
            $expensesByMonth[$month] = $amount;
        }

        // >>>>>>> pie chart incomes category and expenses
        // >>>>>>> incomes category
        $incomesByCategory = DB::table('incomes as i')
            ->join('income_categories as c', 'i.income_category_id', '=', 'c.id')
            ->select('c.category as category_name', DB::raw('SUM(i.amount) as total'))
            ->groupBy('c.category')
            ->orderByDesc('total')
            ->get();

        // >>>>>>> expenses category
        $expensesByCategory = DB::table('expenses as i')
            ->join('expense_categories as c', 'i.expense_category_id', '=', 'c.id')
            ->select('c.category as category_name', DB::raw('SUM(i.amount) as total'))
            ->groupBy('c.category')
            ->orderByDesc('total')
            ->get();

        // >>>>>>> top 10 best customers
        $topCustomers = DB::table('incomes')
            ->select('customer_id', DB::raw('SUM(amount) as total_income'))
            ->whereNotNull('customer_id')
            ->groupBy('customer_id')
            ->orderByDesc('total_income')
            ->limit(10)
            ->get();

        $topCustomers = $topCustomers->map(function ($item) {
            $customer = Customer::find($item->customer_id);
            return [
                'id'           => $customer->id,
                'name'         => $customer->name,
                'email'        => $customer->email,
                'phone'        => $customer->phone,
                'country'      => $customer->country,
                'city'         => $customer->city,
                'total_income' => $item->total_income,
            ];
        });
        // >>>>>>> top 5 best activities
        $topActivities = DB::table('incomes')
            ->select('activity_id', DB::raw('SUM(amount) as total_income'))
            ->whereNotNull('activity_id')
            ->groupBy('activity_id')
            ->orderByDesc('total_income')
            ->limit(5)
            ->get();

        $topActivities = $topActivities->map(function ($item) {
            $activity = Activity::find($item->activity_id);
            return [
                'id'           => $activity->id,
                'name'         => $activity->name,
                'total_income' => $item->total_income,
            ];
        });

        //>>>>>>>> active and inactives users
        $activeAdmins   = User::where('role', 'admin')->where('is_active', 1)->count();
        $inactiveAdmins = User::Where('role', 'admin')->Where('is_active', 0)->count();

        //welcome mail noification
        $currentUser = Auth::user();
        if (! $currentUser->has_logged_in) {
            $currentUser->notify(new UserWelcomeMailNotification($currentUser));
            $currentUser->update(['has_logged_in' => true]);
        }

        return view('admin.dashboard', compact(
            'users',
            'totalIncomes',
            'totalIncomeRecords',
            'totalExpenses',
            'totalExpenseRecords',
            'totalNormalProfit',
            'totalNormalIncomeRecords',
            'totalPfsProfit',
            'totalPfsIncomeRecords',
            'totalCustomers',
            'totalActivities',
            'totalProfit',
            'incomesByMonth',
            'expensesByMonth',
            'incomesByCategory',
            'expensesByCategory',
            'topCustomers',
            'topActivities',
            'activeAdmins',
            'inactiveAdmins'
        ));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
