<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">

    @php
        // Verifica si la ruta actual empieza con el prefijo especificado
        $isActive = request()->is($item['url'] . '*');
    @endphp

    <a class="nav-link {{ $item['class'] }} {{ $isActive ? 'active' : '' }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>

        <p>
            {{ $item['text'] }}

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </p>

    </a>

</li>
