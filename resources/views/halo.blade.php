@php
    $i = 0;
@endphp

@while($i < 5)
    <p>Item {{ $i }}</p>

    @php
        $i++;
    @endphp
@endwhile