<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\History;
use App\User;
use App\Category;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();

        if ($user instanceof User && $user->my_category != 'Libre') {

            $search = $user->my_category;

            $histories_notCategory = History::orderBy('id', 'asc')
                ->whereNull('category_id')
                ->where('status', 'active');

            $histories = History::orderBy('id', 'asc')
                ->whereHas('category', function ($query) use ($search) {
                    $query->where('name', $search);
                })
                ->where('status', 'active')
                ->take(3)
                ->union($histories_notCategory)
                ->get();

        }else{

            $histories = History::inRandomOrder()
                ->where('status', 'active')
                ->take(3)
                ->get();

        }


        $categories = Category::orderBy('id', 'asc')->get();

        $counts = [];

        foreach ($categories as $key => $category) {
            $counts[$category->id] = History::where('category_id', $category->id)->count();
        }

        return view('index')
            ->with([
                'histories' => $histories,
                'categories' => $categories,
                'counts' => $counts,
            ]);
    }

    public function histories()
    {

        $user = auth()->user();

        if ($user instanceof User && $user->my_category != 'Libre') {

            $search = $user->my_category;

            $histories_notCategory = History::orderBy('id', 'asc')
                ->whereNull('category_id')
                ->where('status', 'active');

            $histories = History::orderBy('id', 'desc')
                ->whereHas('category', function ($query) use ($search) {
                    $query->where('name', $search);
                })
                ->where('status', 'active')
                ->union($histories_notCategory)
                ->paginate(5);

        }else{

            $histories = History::orderBy('id', 'desc')
                ->where('status', 'active')
                ->paginate(5);
        }


        return view('histories.index')
            ->with('histories', $histories);
    }

    public function history(History $history)
    {

        $user = auth()->user();

        if ($user instanceof User && $user->my_category != 'Libre' && $history->category) {

            $my_category = $user->my_category;

            if($history->status != 'active' || $history->category->name != $my_category){
                return redirect()->route('histories.index');
            }


        }else{

            if($history->status != 'active'){
                return redirect()->route('histories.index');
            }

        }


        return view('histories.show')
            ->with('history', $history);
    }

    public function search($search)
    {

        $user = auth()->user();

        if ($user instanceof User && $user->my_category != 'Libre') {

            $my_category = $user->my_category;

            $histories = History::search($search)
                ->where('status', 'active')
                ->whereHas('category', function ($query) use ($my_category) {
                    $query->where('name', $my_category);
                })
                /*->orWhereNull('category_id')*/
                ->orderBy('id', 'desc')
                ->paginate(5);


        }else{

            $histories = History::search($search)
                ->where('status', 'active')
                ->orderBy('id', 'desc')
                ->paginate(5);
        }


        return view('histories.index')
            ->with('histories', $histories);

    }

    public function contact(ContactRequest $request)
    {

        return response()->json([
            'title' => 'Completado',
            'plugin' => 'notification',
            'message' => "Mensaje enviado con éxito",
            'interceptor' => true,
        ], 201);

    }

}
