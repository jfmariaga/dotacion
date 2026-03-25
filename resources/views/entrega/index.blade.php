@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Entrega de Dotación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @livewire('entrega.index')
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
        Livewire.on('entrega_ok', i => {
            try {
                $('#nuevaEntrega').modal('hide');

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Entrega realizada con exito',
                    showConfirmButton: false,
                    timer: 1500
                })
            } catch (error) {
                console.log('Error alert', error);
            }
        })
    </script>
    <script>
        Livewire.on('editar', i => {
            try {
                $('#editItem').modal('hide');

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Item editado',
                    showConfirmButton: false,
                    timer: 1500
                })
            } catch (error) {
                console.log('Error alert', error);
            }
        })
    </script>
@stop
