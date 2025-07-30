<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class checkIfIsAdminController extends Controller
{
    public function checkIfIsActive()
    {
        if (Auth::check() && ! Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'error' => 'Your account is not active, contact Super Admin.',
            ]);
        }
    }
}
