@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Colaborador</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="float-right">
                        <a href="#" class="btn btn-sm btn-outline-success" data-toggle="modal"
                            data-target="#nuevoUsuario">Nueva colaborador</a>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    @livewire('colaborador.index')
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    @livewireStyles
@stop

@stack('modals')
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @livewireScripts --}}
    <script>
        Livewire.on('usuario_ok', i => {
            try {
                $('#nuevoUsuario').modal('hide');

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Nuevo usuario',
                    showConfirmButton: false,
                    timer: 1500
                })
            } catch (error) {
                console.log('Error alert', error);
            }
            console.log("llega hasta aqui?");
        })
    </script>
    <script>
        Livewire.on('editar', i => {
            try {
                $('#editUsuario').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Usuario editado',
                    showConfirmButton: false,
                    timer: 1500
                })
            } catch (error) {
                console.log('Error alert', error);
            }
        })
    </script>
    <script>
        Livewire.on('userDuplicado', i => {
            try {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'El empleado ya existe',
                    showConfirmButton: false,
                    timer: 1500
                })
            } catch (error) {
                console.log('Error alert', error);
            }
        })
    </script>
@stop
