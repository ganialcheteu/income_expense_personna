<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\incomeTypeRequest;
use App\Models\incomeType;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;

class incomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $incomeTypes = IncomeType::paginate(8);
        return view("admin.incomeType.index", compact("incomeTypes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("admin.incomeType.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(incomeTypeRequest $request): RedirectResponse
    {
        $incomeType = incomeType::create($request->validated());
        return redirect()->route('incomes_types')->with('info', 'Type ' . $request->type . ' created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $incomeType = incomeType::where('slug', $slug)->firstOrFail();
        return view('admin.incomeType.edit', compact('incomeType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(incomeTypeRequest $request, string $slug): RedirectResponse
    {
        $incomeType = Incometype::where('slug', $slug)->firstOrFail();
        $incomeType->update($request->validated());
        return redirect()->route('incomes_types')->with('info', "Type $request->type updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug): RedirectResponse
    {
        $incomeType = incomeType::where('slug', $slug)->firstOrFail();
        if ($incomeType) {
            $incomeType->delete();
            return redirect()->route('incomes_types')->with('info', "Type $incomeType->type deleted successfully.");
        }else{
            return redirect()->route('incomes_types')->with('error', 'Type not found.');
        }
    }
}
