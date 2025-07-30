<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\registerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\view\view;

class registerController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("admin.register");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(registerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Vérifier si un guest veut créer un compte avec role super_admin,il est empeche
        if ($data['role'] === 'super_admin') {
            if (User::where('role', 'super_admin')->exists()) {
                return back()
                    ->withInput()
                    ->withErrors(['role' => 'You can\'t be Super Admin.']);
            }
        }

        // Création de l'utilisateur
        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => $data['role'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }


}
