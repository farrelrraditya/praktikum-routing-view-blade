@php
    $projects = [
        'Project A',
        'Project B',
        'Project C'
    ];

    $total = count($projects);
@endphp

<h1>Projects</h1>

<p>Total project: {{ $total }}</p>