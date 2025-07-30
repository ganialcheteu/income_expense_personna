<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserIsActive
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et actif
        if (Auth::check() && ! Auth::user()->is_active) {
            // Déconnecter l'utilisateur
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active. Please contact the Super Admin.');
        }

        // Vérifier si l'utilisateur a le rôle super_admin ou admin
        if (Auth::check() && ! in_array(Auth::user()->role, ['super_admin', 'admin'])) {
            // Déconnecter l'utilisateur
            Auth::logout();
            return redirect()->route('login')->with('error', 'You don\'t have the required rights to access this application.');
        }

        return $next($request);
    }
}
