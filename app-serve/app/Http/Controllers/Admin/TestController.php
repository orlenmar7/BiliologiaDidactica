<?php

namespace App\Http\Controllers\Admin;

use App\Test;
use App\History;
use App\Http\Requests\Admin\TestStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(History $history)
    {

        $history->load('test');

        return view('admin.tests.create')
            ->with('history', $history);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestStoreRequest $request, History $history)
    {

        $validar_key = NULL;
        foreach ($request->get('tests') as $key => $_test) {
            $validar_check = false;
            foreach ($_test['options'] as $key => $_option) {
                if ($_option['check']) {
                    $validar_check = true;
                    $validar_key = $key;
                }
            }
            if (!$validar_check) {
                return response()->json([
                    'title' => 'Completado',
                    'message' => "Tiene que seleccionar una opcion correcta en la pregunta " . $validar_key,
                    'interceptor' => true,
                    'plugin' => 'notification',
                ], 403);
            }
        }


        if (empty($request->get('update'))) {
            $test = $history->test()->create([
                'questions' => json_encode($request->get('tests'))
            ]);
        }else{
            $test = $history->test()->update([
                'questions' => json_encode($request->get('tests'))
            ]);
        }


        $history->load('letter_soup', 'category', 'user', 'memores', "test");

        return response()->json([
            'title' => 'Completado',
            'message' => "Pregunta registrada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'history' => $history,
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}

