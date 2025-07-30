<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\activateAdminAccountNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

            //dynamically change status is_active
           $user->is_active = ! $user->is_active; // statut inversion (1 <-> 0)
           $user->save();
           $ucName = ucfirst($user->name); //first letter uppercase for success message
           $user->notify(new activateAdminAccountNotification());
           return redirect()->back()->with('info', "$ucName's Statut Modify Successfully.");

    }
}
