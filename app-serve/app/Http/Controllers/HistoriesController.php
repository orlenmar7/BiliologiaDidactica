<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function puzzles(History $history)
    {
        return view('histories.puzzles')
            ->with('history', $history);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function letter_soup(History $history)
    {
        return view('histories.letter_soup')
            ->with('history', $history);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function memores(History $history)
    {

        $history->load('memores');

        $num_imgs = count($history->memores);

        if ($num_imgs < 8) {


            Alert::success('Info', 'Memoria incompleta, requiere de 8 o mas imagenes.');
            return redirect()->back();

        }

        return view('histories.memores')
            ->with('history', $history);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function video(History $history)
    {
        return view('histories.video')
            ->with('history', $history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Histories $histories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Histories  $histories
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
