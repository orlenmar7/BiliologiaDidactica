<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\History;
use App\User;
use App\Category;
use App\Point;

class HomeController extends Controller
{

    public function index()
    {

        $users = User::orderBy('id', 'asc')->get();

        $winer = null;
        $nun = 0;

        foreach ($users as $key => $user) {
            if ($user->total_point > $nun ) {
                $nun = $user->total_point;
                $winer = $user;
            }
        }


        $counts =  [
            'histories' => History::orderBy('id', 'asc')->count(),
            'users' => User::orderBy('id', 'asc')->count(),
            'categories' => Category::orderBy('id', 'asc')->count(),
            'winer' => $winer
        ];

        return view('admin.home')
            ->with([
                'counts' => $counts
            ]);
    }

}
