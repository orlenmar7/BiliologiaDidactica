@extends('layouts.dadmin.dashboard')

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Editar categoria</h3>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-list"></i> Categorias</a>
            </div>

            <div class="panel-content">
                <categories-create props_category="{{$category}}"></categories-create>
            </div>
        </div>
    </div>
</div>

@endsection
