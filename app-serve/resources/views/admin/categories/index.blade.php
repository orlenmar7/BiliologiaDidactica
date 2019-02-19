@extends('layouts.dadmin.dashboard')

@section('content')


<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Categorias</h3>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-plus"></i> Registrar</a>

    </div>

    <div class="panel-content">
        <div class="table-responsive">
            <table class="table table-bordered table-cells-middle">
                <thead class="text-dark">
                    <tr>
                        <th>Categoria</th>
                        <th style="width: 65%;">Descripción</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category) }}" title="Editar" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button href="#"
                                data-delete="{{ 'destroy-category-'. $category->id }}" title="Eliminar" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                {!! Form::model($category, ['route' => ['admin.categories.destroy', $category], 'method' => 'DELETE', 'id' => 'destroy-category-'. $category->id , 'style' => 'display: none']) !!}
                                        @csrf
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach

                    @empty ($categories)
                        <tr>
                            <td colspan="3">
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
                @empty (!$categories)
                    {{ $categories->links() }}
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
                        text: 'Quieres eliminar esta categoria?',
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
