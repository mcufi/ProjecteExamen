<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    public function ShowUsers() {
        $users = User::get();
        return Inertia::render('Users', [
            "users" => $users
        ]);
    }

    public function AddUsers(Request $request) {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'age' => 'required|integer|max:3',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Aquest correu electrònic ja està registrat.',
        ]);

        User::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'age' => $validated['age'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return Redirect::to('/Users');
    }


    public function ShowEditUsers($id) {
        $users = User::where('id', $id)->get();
        return Inertia::render('EditUser', [
            "users" => $users
        ]);
    }

    public function EditUsers(Request $request, $id) {
        $name = $request->get("name");
        $surname = $request->get("surname");
        $age = $request->get("age");
        $email = $request->get("email");
        $password = $request->get("password");
        
        $user = User::findOrFail($id);
        $user->name = $name;
        $user->surname = $surname;
        $user->age = $age;
        $user->email = $email;
        if ($password != null) {
            $user->password = bcrypt($password);
        }
        $user->save();

        return Inertia::render('Users');
    }

    public function DeleteUser($id) {
    
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::to('/Users');
    }

    public function SearchUser(Request $request) {
        $name = $request->get('search');
        $user = User::where('name', 'like', "%{$name}%")->orWhere('surname', 'like', "%{$name}%")->orWhere('age', $name)->get();

        return $user->toJson();
    }

    public function filter($category) {
        $users = User::orderBy($category, 'asc')->get();
        return $users->toJson();
    }
}