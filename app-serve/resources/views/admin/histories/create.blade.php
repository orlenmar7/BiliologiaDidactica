@extends('layouts.dadmin.dashboard')

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-8">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Registrar historia bíblica</h3>
                <a href="{{ route('admin.histories.index') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-list"></i> Historias bíblicas</a>
            </div>

            <div class="panel-content">
                <histories-create></histories-create>
            </div>
        </div>
    </div>
</div>

@endsection
