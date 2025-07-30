<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\incomeRequest;
use App\Models\activity;
use App\Models\customer;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $incomes          = Income::paginate(8);
        $customers        = Customer::get();
        $activities       = Activity::get();
        $incomeTypes      = IncomeType::get();
        $incomeCategories = IncomeCategory::get();
        return view('admin.income.index', compact('incomes', 'customers', 'activities', 'incomeTypes', 'incomeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers        = Customer::get();
        $activities       = Activity::get();
        $incomeTypes      = IncomeType::get();
        $incomeCategories = IncomeCategory::get();
        return view('admin.income.create', compact('customers', 'activities', 'incomeTypes', 'incomeCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(incomeRequest $request): RedirectResponse
    {
        $income = income::create($request->validated());
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('images', 'public');
                $income->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('incomes')->with("info", "Income $request->name created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): View
    {
        // Récupérer les incomes avec ses images
        $income = Income::where('slug', $slug)->with('images')->firstOrFail();
        //passer a la vue
        return view('admin.income.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
    */
    public function edit(string $slug): View
    {
        $income           = Income::where('slug', $slug)->with('images')->firstOrFail();
        $activities       = Activity::get();
        $customers        = Customer::get();
        $incomeTypes      = IncomeType::get();
        $incomeCategories = IncomeCategory::get();
        return view('admin.income.edit', compact('income', 'activities', 'customers', 'incomeTypes', 'incomeCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(incomeRequest $request, string $slug): RedirectResponse
    {
        {
            // dd($request->all());
            $income = Income::where('slug', $slug)->with('images')->firstOrFail();

            // Mettre à jour les champs de l'income
            $income->update($request->validated());

            // Supprimer les anciennes images associées à l'income
            foreach ($income->images as $image) {
                // Supprimer le fichier du stockage
                \Storage::disk('public')->delete($image->path);
                // Supprimer l'entrée dans la base de données
                $image->delete();
            }

            // Ajouter les nouvelles images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $path = $file->store('images', 'public');
                    $income->images()->create([
                        'path' => $path,
                    ]);
                }
            }

            return redirect()->route('incomes')->with('info', "Income $request->name Edited successfully.");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $income = Income::where('slug', $slug)->firstOrFail();
        if ($income) {
            $income->delete();
            return redirect()->route('incomes')->with('info', "Income $income->name deleted successfully.");
        }else{
            return redirect()->route('incomes')->with('error', 'Income not found.');
        }
    }

}
