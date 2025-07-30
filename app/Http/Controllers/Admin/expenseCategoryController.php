<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\expenseCategory;
use App\Http\Requests\admin\expenseCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;
class expenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $expenseCategories = ExpenseCategory::paginate(8);
        return view("admin.expenseCategory.index", compact('expenseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.expenseCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $expenseCategory = ExpenseCategory::create($validated);
        return redirect()->route('expenses_categories')->with('info', 'Category ' . $request->category . ' created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $expenseCategory = ExpenseCategory::findOrFail($slug);
        return view('admin.expenseCategory.edit', compact('expenseCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseCategoryRequest $request, string $slug): RedirectResponse
    {
        // Recherche de la categorie de depense par son ID
        $expenseCategory = ExpenseCategory::where('slug',$slug)->firstOrFail();

        // Validation du champ name
        $validated = $request->validated();

        // Mise à jour du champ category
        $expenseCategory->update($validated);
        // Redirection ou réponse
        return redirect()->route('expenses_categories')->with('info', "Category $request->category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $expenseCategory = ExpenseCategory::where('slug', $slug)->first();
        if ($expenseCategory) {
            $expenseCategory->delete();
            return redirect()->route('expenses_categories')->with('info', "Category $expenseCategory->category deleted successfully.");
        }else{
            return redirect()->route('expenses_categories')->with('error', 'Category not found.');
        }
    }
}
