<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckIfUserIsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { //verifie si le user connecte est super admin
        if (Auth::check() && Auth::user()->role !== 'super_admin') {
            // Auth::logout();
            // return redirect()->route('login')->with('error', 'No permission to access this page.');

            //deconnecte
            Auth::logout();
            //Rend la session invalide
            Session::invalidate();
            //regeneration du token crsf pour la securite(empeche l'ancien jeton crsf d'etre utilise)
            Session::regenerateToken();
            //affichage de la page d'erreur
            abort(403,'Access Denied'); //declanche immediatement la vue 403
        }
        return $next($request);
    }
}

//ce middleware a ete enregistre dans le fichier bootstrap/app.php
