@php
    $input = preg_replace('/_id$/', '', $columnName);
    $replaced = str_replace('_', ' ', $input);
    $capitalized = ucwords($replaced);
@endphp

<div class="d-flex justify-content-between align-items-center">
    <span>{{ $capitalized }}</span>
    @if ($sortColumn !== $columnName)
        <x-heroicon-s-chevron-up-down class="sort-lg-button" />
    @elseif($sortDirection === 'ASC')
        <x-heroicon-s-chevron-down class="sort-md-button" />
    @else
        <x-heroicon-s-chevron-up class="sort-md-button" />
    @endif
</div>
