<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TrashedUsersController extends Controller
{
    //
    public function index()
    {
        $trashedUsers = User::onlyTrashed()->get();
   
    return view('users.trashed', compact('trashedUsers'));
    }
}
