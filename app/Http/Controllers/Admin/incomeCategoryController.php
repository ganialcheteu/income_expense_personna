<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\incomeCategoryRequest;
use App\Models\incomeCategory;
use Illuminate\Http\Request;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;

class incomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $incomeCategories = incomeCategory::paginate(8);
        return view("admin.incomeCategory.index", compact("incomeCategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.incomeCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(  incomeCategoryRequest $request): RedirectResponse
    {
        $category = incomeCategory::create($request->validated());

        return redirect()->route('incomes_categories')->with('info', 'Category ' . $request->category . ' created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $incomeCategory = incomeCategory::where('slug', $slug)->firstOrFail();
        return view('admin.incomeCategory.edit', compact('incomeCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(incomeCategoryRequest $request, $slug): RedirectResponse
    {

        // Recherche de la category income  par son ID
        $incomeCategory = incomeCategory::where('slug', $slug)->firstOrFail();

        // Mise à jour du champ category
        $incomeCategory->update($request->validated());

        // Redirection ou réponse
        return redirect()->route('incomes_categories')->with('info', "Category $request->category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $incomeCategory = incomeCategory::where('slug', $slug)->firstOrFail();
        if ($incomeCategory) {
            $incomeCategory->delete();
            return redirect()->route('incomes_categories')->with('info', "Category $incomeCategory->category deleted successfully.");
        }else{
            return redirect()->route('incomes_categories')->with('error', 'Category not found.');
        }
    }
}
