@extends('adminlte::page')

@section('js')
    <script>
        PushMenu.prototype.UnExpandOnHover = function () { $(Selector.mainSidebar).off(); };
    </script>
@endsection

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aplicación de asistencias</div>

                    <div class="card-body text-center">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <img class="img-fluid" src="{{ asset('assets/img/home.jpg') }}" alt="home">
                        <p class="mb-0">Bienvenido, {{ auth()->user()->name }}!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
