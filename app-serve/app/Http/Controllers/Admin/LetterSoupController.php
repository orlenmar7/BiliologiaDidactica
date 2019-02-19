<?php

namespace App\Http\Controllers\Admin;

use App\LetterSoup;
use App\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LetterSoupStoreRequest;
use App\Http\Requests\Admin\LetterSoupUpdateRequest;


class LetterSoupController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(History $history)
    {

        $history->load('test');

        return view('admin.letter_soups.create')
            ->with('history', $history);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LetterSoupStoreRequest $request)
    {

        $letter_soup = new LetterSoup;
        $letter_soup->fill($request->all());
        $letter_soup->words = json_encode($request->get('words'));
        $letter_soup->save();

        return response()->json([
            'title' => 'Completado',
            'message' => "Sopa de letra registrada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'letter_soup' => $letter_soup,
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LetterSoup  $letter_soup
     * @return \Illuminate\Http\Response
     */
    public function show(LetterSoup $letter_soup)
    {
        return $letter_soup;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LetterSoup  $letter_soup
     * @return \Illuminate\Http\Response
     */
    public function update(LetterSoupUpdateRequest $request, LetterSoup $letter_soup)
    {
        $letter_soup->fill($request->all());
        $letter_soup->words = json_encode($request->get('words'));
        $letter_soup->update();

        return response()->json([
            'title' => 'Completado',
            'message' => "Sopa de letra actualizada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'letter_soup' => $letter_soup,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LetterSoup  $letter_soup
     * @return \Illuminate\Http\Response
     */
    public function destroy(LetterSoup $letter_soup)
    {
        //
    }
}
