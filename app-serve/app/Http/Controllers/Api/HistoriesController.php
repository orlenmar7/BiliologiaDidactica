<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\FileBase6;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Api\HistoryStore;
use App\Http\Requests\Api\HistoryUpdate;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use App\Http\Controllers\Controller;

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
    public function store(HistoryStore $request)
    {

        if ($request->file('video_url')) {
            foreach ($request->file('video_url') as $file) {

                try {
                    $path_vdo = Storage::disk('videos/histories')->putFile('/', $file);
                } catch (FileNotFoundException $e) {
                    return response()->json([
                        'title' => 'Error',
                        'message' => 'Hubo un error al subir sus el video, verifique su conexion a internet',
                        'plugin' => 'modal',
                        'interceptor' => true
                    ], 500);
                }

            }
            $video_url = 'videos/histories/'.$path_vdo;
        }else{
            $video_url = '';
        }

        $image = FileBase6::pullFile($request->get('image_url'), 'app/public/images/histories/');

        $user = auth()->user();
        return response()->json([
            'user' => $user,
        ], 422);

        $history = $user->histories()->create([
            "category_id" => $request->get("category_id"),
            "title" => $request->get("title"),
            "sub_title" => $request->get("sub_title"),
            "description" => $request->get("description"),
            "content" => $request->get("content"),
            "image" => "images/histories/{$image}",
            "video" => $video_url,
        ]);

        return response()->json([
            'title' => 'Completado',
            'message' => "Historia Biblica {$history->title} registrada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'history' => $history,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  History $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        return $history->load('letter_soup', 'category', 'user', 'memores', "test");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  History $history
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
     * @param  int  History $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  History $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
