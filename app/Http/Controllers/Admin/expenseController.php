<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\expenseRequest;
use App\Models\activity;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\expenseType;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\view\view;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $expenses          = Expense::paginate(8);
        $suppliers         = Supplier::get();
        $activities        = Activity::get();
        $expenseTypes      = ExpenseType::get();
        $expenseCategories = ExpenseCategory::get();
        return view("admin.expense.index", compact("expenses", 'activities', 'suppliers', 'expenseTypes', 'expenseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $suppliers         = Supplier::get();
        $activities        = Activity::get();
        $expenseTypes      = ExpenseType::get();
        $expenseCategories = ExpenseCategory::get();
        return view("admin.expense.create", compact('activities', 'suppliers', 'expenseTypes', 'expenseCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(expenseRequest $request): RedirectResponse
    {
        $valiadated = $request->validated();
        $expense = expense::create($valiadated);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('images', 'public');
                $expense->images()->create([
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('expenses')->with('info', "Expense $request->name Created Successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): View
    {
        // Récupérer lesexpenses avec ses images
        $expense = Expense::where('slug', $slug)->with('images')->firstOrFail();
        return view('admin.expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $expense           = Expense::where('slug', $slug)->with('images')->firstOrFail();
        $activities        = Activity::get();
        $suppliers         = Supplier::get();
        $expenseTypes      = ExpenseType::get();
        $expenseCategories = ExpenseCategory::get();
        return view('admin.expense.edit', compact('expense', 'activities', 'suppliers', 'expenseTypes', 'expenseCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(expenseRequest $request, string $slug): RedirectResponse
    {
        {
            // dd($request->all());
            $expense = Expense::where('slug', $slug)->with('images')->firstOrFail();

            // Validation des données
           $valiadated = $request->validated();

            // Mettre à jour les champs de l'expense
            $expense->update($valiadated);
            // Supprimer les anciennes images associées à l'expense
            foreach ($expense->images as $image) {
                // Supprimer le fichier du stockage
                \Storage::disk('public')->delete($image->path);
                // Supprimer l'entrée dans la base de données
                $image->delete();
            }

            // Ajouter les nouvelles images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $path = $file->store('images', 'public');
                    $expense->images()->create([
                        'path' => $path,
                    ]);
                }
            }

            return redirect()->route('expenses')->with('info', "Expense $expense->name updated successfully.");

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $expense = Expense::where('slug', $slug)->firstOrFail();
        if ($expense) {
            $expense->delete();
            return redirect()->route('expenses')->with('info', "Expense $expense->name deleted successfully.");
        }else{
            return redirect()->route('expenses')->with('error', 'Expense not found.');
        }
    }
}
