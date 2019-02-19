<?php

namespace App\Http\Controllers;

use App\Memory;
use Illuminate\Http\Request;

class MemoryController extends Controller
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
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function show(Memory $memory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memory $memory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memory  $memory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memory $memory)
    {
        $history = $memory->history;

        $history->load('memores');

        $memory->delete();

        $num_imgs = count($history->memores);

        if ($num_imgs < 8) {

            return response()->json([
                'title' => 'Completado',
                'message' => "Memoria incompleta, requiere de 8 o mas imagenes",
                'interceptor' => true,
                'plugin' => 'modal',
                'history' => $history,
            ], 200);

        }


        return response()->json([
            'title' => 'Completado',
            'message' => "Imagen de la memoria eliminada con éxito",
            'plugin' => 'notification',
            'interceptor' => true,
            'history' => $history,
        ], 200);
    }
}
