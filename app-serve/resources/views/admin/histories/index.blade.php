@extends('layouts.dadmin.dashboard')

@section('content')


<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Historias bíblicas</h3>

        <a href="{{ route('admin.histories.create') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-plus"></i> Registrar</a>

    </div>

    <div class="panel-content">
        <div class="table-responsive">
            <table class="table table-bordered table-cells-middle">
                <thead class="text-dark">
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th style="width: 35%;">Descripción</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $historiy)
                        <tr>
                            <td>{{$historiy->title}}</td>
                            <td>{{($historiy->category)? $historiy->category->name : 'Todos'}}</td>
                            <td>{{$historiy->description}}</td>
                            <td>
                                @if ($historiy->status == 'deactivated')
                                    Oculto
                                @endif
                                @if ($historiy->status == 'active')
                                    Publico
                                @endif
                            </td>
                            <td>
                                <div class="btn-group-list">
                                    <div class="btn-group">
                                        <button title="Agregar juego" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Juegos</button>

                                        <div class="dropdown-menu" data-x-placement="bottom-start" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -114px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a href="{{ route('admin.tests.create', $historiy->id) }}" class="dropdown-item">Test</a>
                                            <a href="{{ route('admin.memories.create', $historiy->id) }}" class="dropdown-item">Memoria</a>
                                            <!-- <a href="#" class="dropdown-item">Rompecabezas</a> -->
                                            <a href="{{ route('admin.letter_soups.create', $historiy->id) }}" class="dropdown-item">Sopa de letras</a>

                                            <a target="_black" href="{{ route('admin.histories.preview', $historiy->id) }}" class="dropdown-item">Vista previa</a>

                                        </div>
                                    </div>
                                    <a href="{{ route('admin.histories.edit', $historiy) }}" title="Editar" class="btn btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button href="#"
                                    data-delete="{{ 'destroy-history-'. $historiy->id }}" title="Eliminar" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {!! Form::model($historiy, ['route' => ['admin.histories.destroy', $historiy], 'method' => 'DELETE', 'id' => 'destroy-history-'. $historiy->id , 'style' => 'display: none']) !!}
                                            @csrf
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @empty ($histories)
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-warning" role="alert">
                                  No se encontraron datos en la DB
                                </div>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 text-center"></div>
                @empty (!$histories)
                    {{ $histories->links() }}
                @endempty
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">

        (function ($) {
            "use strict";

            $(window).on('load', function () {
                $('[data-delete]').on('click', function (event) {
                    event.preventDefault();

                    swal({
                        title: 'Estas seguro?',
                        text: 'Quieres eliminar esta historia?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        cancelButtonText: 'No, cancelar'
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById($(this).data('delete')).submit();
                        }
                    })


                })
            });

        }(jQuery));

    </script>
@endsection
