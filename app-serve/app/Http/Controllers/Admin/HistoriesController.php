<?php

namespace App\Http\Controllers\Admin;

use App\History;
use App\FileBase6;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Api\HistoryStore;
use App\Http\Requests\Api\HistoryUpdate;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use App\Http\Controllers\Controller;
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
        $histories = History::orderBy('id', 'desc')
                            ->paginate(10);

        return view('admin.histories.index')
            ->with('histories', $histories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.histories.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    public function preview(History $history){
        return view('histories.show')
            ->with('history', $history);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        return view('admin.histories.edit')
            ->with([
                'history' => json_encode($history),
                'history_id' => $history->id
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {

        if ($request->file('video_url') && $request->file('video_new')) {
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
            $video_url = $history->video;
        }

        if (!empty($request->get('image_new'))) {
            $image = FileBase6::pullFile($request->get('image_new'), 'app/public/images/histories/');
            $image = "images/histories/{$image}";
        }else{
            $image = $history->image;
        }

        $history->fill([
            "category_id" => $request->get("category_id"),
            "title" => $request->get("title"),
            "sub_title" => $request->get("sub_title"),
            "status" => $request->get("status"),
            "description" => $request->get("description"),
            "content" => $request->get("content"),
            "image" => $image,
            "video" => $video_url,
        ]);

        $history->update();

        return response()->json([
            'title' => 'Completado',
            'message' => "Historia Biblica {$history->title} editada con éxito",
            'interceptor' => true,
            'plugin' => 'modal',
            'history' => $history,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        $history->delete();
        Alert::success('Completado', 'Historia eliminada con exito.');
        return redirect()->route('admin.histories.index');
    }

    public function changeStatus(History $history){

        $history->status = ($history->status === 'active')? 'deactivated' : 'active' ;
        $history->save();

        return response()->json([
            'title' => 'Completado',
            'message' => "Historia Biblica {$history->title} cabio de estado",
            'interceptor' => true,
            'plugin' => 'modal',
            'history' => $history,
        ], 200);

    }

}
