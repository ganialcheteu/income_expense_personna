<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\customerTypeRequest;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class customerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customerTypes = customerType::paginate(8);
        return view("admin.customerType.index", compact("customerTypes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.customerType.create');

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(customerTypeRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $customerType = CustomerType::create($validated);
        return redirect()->route('customers_types')->with('info', 'Type ' . $request->type . ' created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $customerType = customerType::where('slug',$slug)->firstOrFail();
        return view('admin.customerType.edit', compact('customerType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customerTypeRequest $request, string $slug): RedirectResponse
    {
        // Recherche du type de customer par son ID
        $customerType = customerType::where('slug',$slug)->firstOrFail();

        $validated =  $request->validated();

        $customerType->update($validated);
        // Redirection ou réponse
        return redirect()->route('customers_types')->with('info', "Type $customerType->type Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $customerType = CustomerType::where('slug',$slug)->firstOrfail();
        if ($customerType) {
            $customerType->delete();
            return redirect()->route('customers_types')->with('info', "Type $customerType->type deleted successfully.");
        }else{
            return redirect()->route('customers_types')->with('error', 'Type not found.');
        }
    }
}
