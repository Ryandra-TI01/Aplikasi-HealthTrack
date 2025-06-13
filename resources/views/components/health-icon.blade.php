@php
    use Illuminate\Support\Arr;

    $icons = [
        'heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="w-6 h-6 text-primary"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M19.5 13.572L12 21l-2.896-2.868m-6.117-8.104A5 5 0 0 1 12 7.006a5 5 0 1 1 7.5 6.572"/><path d="M3 13h2l2 3l2-6l1 3h3"/></g></svg>',

        'thermometer' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15 13V5c0-1.66-1.34-3-3-3S9 3.34 9 5v8c-1.21.91-2 2.37-2 4c0 2.76 2.24 5 5 5s5-2.24 5-5c0-1.63-.79-3.09-2-4m-4-2V5c0-.55.45-1 1-1s1 .45 1 1v1h-1v1h1v2h-1v1h1v1z"/></svg>',

        'glucose' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="medicine-outline"><g fill="currentColor" fill-rule="evenodd" class="Vector" clip-rule="evenodd"><path d="m19.873 12.3l-8.033 7.998a5.678 5.678 0 0 1-8.012-8.047l8.033-7.998a5.678 5.678 0 0 1 8.012 8.047m-1.4-6.618a3.68 3.68 0 0 0-5.2-.012l-8.034 7.998a3.678 3.678 0 0 0 5.19 5.213l8.033-7.998a3.68 3.68 0 0 0 .012-5.201Z"/><path d="M8.118 8.524a1 1 0 0 1 1.414 0l6.05 6.05a1 1 0 0 1-1.414 1.414l-6.05-6.05a1 1 0 0 1 0-1.414"/></g></g></svg>',
    ];

   // Pilih nama icon secara acak jika $name tidak diset
    $iconName = isset($name) && isset($icons[$name]) ? $name : Arr::random(array_keys($icons));
@endphp

{!! $icons[$iconName] !!}