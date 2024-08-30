@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

<div class="{{ $preloaderHelper->makePreloaderClasses() }}" style="{{ $preloaderHelper->makePreloaderStyle() }}">

    @hasSection('preloader')

        {{-- Use a custom preloader content --}}
        @yield('preloader')

    @else

        {{-- Use the default preloader content --}}

        <div class="card">
            <div class="card-header bg-dark">
                <h6 class="mb-0">Cargando</h6>
            </div>
            <div class="card-body text-center">
                <i class="fas fa-2x fa-spin fa-spinner text-secondary mt-3"></i>
                <h6 class="mt-4 mb-0 text-dark">Espere un momento por favor</h6>
            </div>
        </div>

        {{--
        <img src="{{ asset(config('adminlte.preloader.img.path', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
             class="img-circle {{ config('adminlte.preloader.img.effect', 'animation__shake') }}"
             alt="{{ config('adminlte.preloader.img.alt', 'AdminLTE Preloader Image') }}"
             width="{{ config('adminlte.preloader.img.width', 60) }}"
             height="{{ config('adminlte.preloader.img.height', 60) }}"
             style="animation-iteration-count:infinite;">
        --}}

    @endif

</div>
