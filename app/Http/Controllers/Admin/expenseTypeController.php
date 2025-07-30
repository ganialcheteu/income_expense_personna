<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\expenseType;
use App\Http\Requests\admin\expenseTypeRequest;
use Illuminate\Http\Request;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;

class expenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $expenseTypes = expenseType::paginate(8);
        return view("admin.expenseType.index", compact("expenseTypes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.expenseType.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(expenseTypeRequest $request): RedirectResponse
    {
        $expensetype = expenseType::create($request->validated());
        return redirect()->route('expenses_types')->with('info', 'Type ' . $expensetype->type . ' created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $expenseType = expenseType::where('slug', $slug)->firstOrFail();
        return view('admin.expenseType.edit', compact('expenseType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(expenseTypeRequest $request, string $slug): RedirectResponse
    {
        // Recherche du type expense par son ID
        $expenseType = expenseType::where('slug',$slug)->firstOrFail();

        // Validation du champ name
        $validated = $request->validated();

        // Mise à jour du champ type
        $expenseType->update($validated);

        // Redirection ou réponse
        return redirect()->route('expenses_types')->with('info', 'Type ' . $request->type . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $expenseType = expenseType::where('slug',$slug)->firstOrFail();
        if ($expenseType) {
            $expenseType->delete();
            return redirect()->route('expenses_types')->with('info', "Type $expenseType->type deleted successfully.");
        }else{

            return redirect()->route('expenses_types')->with('error', 'Type not found.');
        }
    }
}
