<h1>Profil</h1>

<p>Nama: {{ $nama }}</p>
<p>Umur: {{ $umur }}</p>

@if($umur >= 17)
    <p>Sudah dewasa</p>
@elseif($umur >= 13)
    <p>Remaja</p>
@else
    <p>Anak-anak</p>
@endif

