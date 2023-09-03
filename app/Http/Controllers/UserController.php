<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Logic to fetch and display a list of users
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        // Logic to show a user's profile
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    // Implement other methods for creating, updating, and deleting users

}
