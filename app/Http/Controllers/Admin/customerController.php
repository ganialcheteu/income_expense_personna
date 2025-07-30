<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\customerRequest;
use App\Models\customer;
use App\Models\customerType;
use Illuminate\Http\Request;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;
class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::paginate(8);
        $customerTypes = CustomerType::all();
        return view("admin.customer.index", compact("customers","customerTypes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request): View
    {
        $customer_types = CustomerType::all();
        return view("admin.customer.create", compact("customer_types"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(customerRequest $request): RedirectResponse
    {
        $customer_types = CustomerType::all();

        // Validation des données
       $validated = $request->validated();

        // Création du client
        $customer = customer::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('customers')->with('info', "Customer $request->name Created Successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        // Research customer by her ID
        $customer       = customer::where('slug',$slug)->firstOrFail();
        $customer_types = CustomerType::get();
        $customer_type  = CustomerType::findOrFail($customer->customer_type_id);
        return view('admin.customer.edit', compact('customer', 'customer_type', 'customer_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(customerRequest $request, string $slug): RedirectResponse
    {
        // Recherche de la marque par son ID
        $customer = customer::where('slug',$slug)->firstOrFail();

        $validated = $request->validated();
        $customer ->update($validated);

        // Redirection ou réponse
        return redirect()->route('customers')->with('info', "Customer $request->name Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $customer = customer::where('slug',$slug)->firstOrFail();
        if ($customer) {
            $customer->delete();
            return redirect()->route('customers')->with('info', "Customer $customer->name Deleted Successfully.");
        }
        return redirect()->route('customers')->with('error', 'Customer not found.');
    }
}
