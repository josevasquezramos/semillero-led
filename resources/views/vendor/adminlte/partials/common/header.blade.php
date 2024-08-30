<header class="rounded-lg elevation-1" style="position: relative; width: 100%; height: 100px; background-image: url('{{ asset('assets/img/back.jpg') }}');
    background-size: cover; background-position: center; color: white; display: flex; align-items: center; padding: 0 20px;
    box-sizing: border-box; overflow: hidden;">
    <div style="display: flex; align-items: center; color: white; width: 100%;">
        <i class="{{ $icon }}" style="font-size: 2.5rem; margin-right: 15px;"></i>
        <div style="display: flex; flex-direction: column; justify-content: center; flex: 1; overflow: hidden;">
            <h1 style="margin: 0; font-size: 1.2rem; line-height: 1.2; white-space: normal; overflow: hidden;
            text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ $title }}</h1>
        </div>
    </div>
</header>
