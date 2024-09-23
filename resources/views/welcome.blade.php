@extends('layouts.app')

@section('body')
    @include('adminlte::partials.common.navbar-home')

    <section id="features" class="container my-3">

        <div class="row">
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/img/alumnos.png') }}" class="img-fluid pb-3 pb-lg-0" alt="Imagen de ejemplo">
            </div>
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                <div>
                    <h2 class="text-center text-lg-start">
                        <span class="text-danger">
                            <b><span class="text-danger">L</span><span class="text-warning">E</span><span
                                    class="text-primary">D</span></b>
                            Llapantsikpaq Patsa</span>
                    </h2>
                    <h2 class="pb-3 text-center text-lg-start">
                        Aplicación de Asistencias
                    </h2>
                    <p class="text-center text-lg-start">¡Bienvenido a nuestra aplicación! Aquí encontrarás la solución
                        perfecta para asegurar la asistencia escolar de tus hijos y mantenerte al tanto.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">Registro de Asistencia</h6>
                                    <p class="card-text">Las asistencias se pueden registrar fácilmente mediante un código
                                        QR.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">Notificaciones</h6>
                                    <p class="card-text">Envía notificaciones a los padres para mantenerlos
                                        informados.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title">Informes Detallados</h6>
                                    <p class="card-text">Genera informes detallados sobre la asistencia para análisis y
                                        seguimiento.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                <div class="text-center text-lg-start py-2">
                    <h2 class="pb-3 text-dark">Nuestro Semillero</h2>
                    <p>En <b><span class="text-danger">L</span><span class="text-warning">E</span><span
                                class="text-primary">D</span></b> <span class="text-danger"> Llapantsikpaq Patsa</span>,
                        somos un equipo multidisciplinario formado por estudiantes de diversas carreras de la <a
                            href="https://www.uns.edu.pe/" target="_blank" class="link-danger">Universidad Nacional del
                            Santa</a>. Nuestra misión es aprender y desarrollar habilidades investigativas que nos permitan
                        contribuir al avance del conocimiento y enfrentar los desafíos del futuro.</p>
                    <p>Cada miembro de nuestro equipo aporta una perspectiva única, enriqueciendo nuestro enfoque y
                        fortaleciendo nuestros proyectos.</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                @include('adminlte::partials.common.carousel')
            </div>
        </div>
    </section>

    <footer class="text-center py-4 bg-light">
        <p>&copy; 2024 LED Llapantsikpaq Patsa</p>
    </footer>
@endsection
