@extends('layouts.dadmin.dashboard')

@section('content')


<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Usuarios</h3>

        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary mb-3 float-right"><i class="fa mr-2 fa-plus"></i> Registrar</a>

    </div>

    <div class="panel-content">
        <div class="table-responsive">
            <table class="table table-bordered table-cells-middle">
                <thead class="text-dark">
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Categoria</th>
                        <th>Tipo</th>
                        <th>Puntos</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->age}} años</td>
                            <td>{{$user->my_category}}</td>
                            <td>{{$user->rol}}</td>
                            <td>{{$user->total_point}}</td>
                            <td>
                                @if ($user->status == 'deactivated')
                                    Desactivo
                                @endif
                                @if ($user->status == 'active')
                                    Activo
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" title="Editar" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button href="#"
                                data-delete="{{ 'destroy-user-'. $user->id }}" title="Eliminar" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                {!! Form::model($user, ['route' => ['admin.users.delete', $user], 'method' => 'GET', 'id' => 'destroy-user-'. $user->id , 'style' => 'display: none']) !!}
                                        @csrf
                                {!! Form::close() !!}
                            </form>
                            </td>
                        </tr>
                    @endforeach

                    @empty ($users)
                        <tr>
                            <td colspan="5">
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
                @empty (!$users)
                    {{ $users->links() }}
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
                        text: 'Quieres eliminar este usuario?',
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
