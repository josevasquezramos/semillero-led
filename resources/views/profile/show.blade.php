@extends('adminlte::page')

@section('content_header')
    <h4 class="py-2">Perfil de usuario</h4>
    <hr class="mb-2">
@endsection

@php
    $activeTab = session('activeTab', 'profile');
@endphp

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link {{ $activeTab == 'profile' ? 'active' : '' }}" id="nav-profile-tab" data-toggle="tab"
                data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                aria-selected="true">Perfil</button>
            <button class="nav-link {{ $activeTab == 'password' ? 'active' : '' }}" id="nav-password-tab" data-toggle="tab"
                data-target="#nav-password" type="button" role="tab" aria-controls="nav-password"
                aria-selected="false">Contraseña</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane bg-white border-right border-left border-bottom px-3 fade {{ $activeTab == 'profile' ? 'show active' : '' }}"
            id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row pt-4">
                <div class="col-md-5">
                    <h5>Información de Perfil</h5>
                    <p>En esta sección podrás actualizar tu perfil, incluyendo tu nombre completo, teléfono celular y correo
                        electrónico.</p>
                </div>
                <div class="col-md-7">
                    <form action="{{ route('profile.update') }}" method="POST">
                        <div class="card">
                            <div class="card-body">

                                @csrf

                                <div class="form-group">
                                    <label for="name">Nombre Completo</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user "></span>
                                            </div>
                                        </div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="phone">Teléfono Celular</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone "></span>
                                            </div>
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope "></span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane bg-white border-right border-left border-bottom px-3 fade {{ $activeTab == 'password' ? 'show active' : '' }}"
            id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
            <div class="row pt-4">
                <div class="col-md-5">
                    <h5>Actualizar Contraseña</h5>
                    <p>Para actualizar tu contraseña, ingresa la contraseña actual, luego introduce la nueva contraseña
                        seguido de la misma para confirmar.</p>
                </div>
                <div class="col-md-7">

                    <form action="{{ route('profile.update-password') }}" method="POST">
                        <div class="card">
                            <div class="card-body">

                                @csrf

                                <div class="form-group">
                                    <label for="current_password">Contraseña Actual</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            id="current_password" name="current_password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña</label>
                                    <div class="input-group">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endsection
