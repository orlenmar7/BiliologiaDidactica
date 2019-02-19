@extends('layouts.dadmin.dashboard')

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Editar historia bíblica</h3>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-list"></i> Historias bíblicas</a>

                <a target="_black" href="{{ route('admin.histories.preview', $history_id) }}" class="btn btn-primary mb-3 float-right">Vista previa</a>
            </div>

            <div class="panel-content">
                <histories-create props_history="{{ $history }}"></histories-create>
            </div>
        </div>
    </div>
</div>

@endsection
