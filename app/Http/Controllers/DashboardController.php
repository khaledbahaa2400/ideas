<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::latest();
        $status = 'dashboard';

        if (request()->has("search")) {
            $userIds = User::where("name", "like", "%" . request("search") . "%")->pluck("id");

            $ideas = $ideas->where("content", "like", "%" . request("search") . "%")
                ->orWhereIn('user_id', $userIds)->latest();
        }

        return view("dashboard", [
            'ideas' => $ideas->paginate(5),
            'status' => $status
        ]);
    }

    public function feed()
    {
        $ideas = Idea::whereIn('user_id', auth()->user()->followings()->pluck('user_id'))->latest();
        $status = 'dashboard';

        return view("dashboard", [
            'ideas' => $ideas->paginate(5),
            'status' => $status
        ]);
    }

    public function explore()
    {
        $users = User::whereNotIn('id', auth()->user()->followings()->pluck('user_id'))
            ->whereNot('id', auth()->id())->orderBy('name');
        $status = 'dashboard';

        return view("explore", [
            'users' => $users->paginate(5),
            'status' => $status
        ]);
    }
}
