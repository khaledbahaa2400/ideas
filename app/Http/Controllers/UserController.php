<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        request()->session()->regenerate();
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Account Created Successfully');
    }

    public function authenticate()
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($validated)) :
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in Successfully');
        endif;

        return redirect()->route('login')->with('error', 'Incorrect Credentials');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out Successfully');
    }

    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);
        $status = 'viewing user';

        return view('users.show', compact('user', 'status', 'ideas'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $status = 'editing user';
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'status', 'ideas'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user);

        $validated = request()->validate([
            "name" => "required",
            "bio" => "nullable|min:3|max:240",
            "image" => "nullable|image"
        ]);

        if (request('image')) :
            $path = request('image')->store('profile', 'public');
            $validated['image'] = $path;

            Storage::disk('public')->delete($user->image ?? '');
        endif;

        $user->update($validated);
        return redirect()->route("users.show", compact('user'))->with("success", "Updated Successfully");
    }

    public function follow(User $user)
    {
        if (auth()->id() === $user->id || auth()->user()->follows($user)) :
            abort(409);
        endif;

        auth()->user()->followings()->attach($user);
        return back()->with("success", "Followed Successfully");
    }

    public function unfollow(User $user)
    {
        if (auth()->id() === $user->id || !auth()->user()->follows($user)) :
            abort(409);
        endif;

        auth()->user()->followings()->detach($user);
        return back()->with("success", "Unfollowed Successfully");
    }

    public function like(Idea $idea)
    {
        auth()->user()->likes()->attach($idea);
        return back();
    }

    public function unlike(Idea $idea)
    {
        auth()->user()->likes()->detach($idea);
        return back();
    }
}
