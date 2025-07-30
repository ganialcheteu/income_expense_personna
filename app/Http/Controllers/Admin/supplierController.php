<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\supplier;
use Illuminate\Http\Request;
use App\Http\Requests\admin\supplierRequest;
class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::paginate(8);
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(supplierRequest $request)
    {
        // Validation des données
        $validated = $request->validated();
        // Création du supplier
        $supplier = supplier::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('suppliers')->with('info', "Supplier $request->name created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $supplier = supplier::where('slug',$slug)->firstOrFail();
        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(supplierRequest $request, string $slug)
    {
        // Recherche de le supplier par son ID
        $supplier = supplier::where('slug', $slug)->firstOrFail();

        // Mise à jour des champs du modele supplier
        $supplier->update($request->validated());

        // Redirection ou réponse
        return redirect()->route('suppliers')->with('info', "Supplier $supplier->name updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $supplier = supplier::where('slug',$slug)->firstOrfail();
        if ($supplier) {
            $supplier->delete();
            return redirect()->route('suppliers')->with('info', "Supplier $supplier->name deleted successfully.");
        }
        return redirect()->route('suppliers')->with('error', 'Supplier not found.');
    }
}
