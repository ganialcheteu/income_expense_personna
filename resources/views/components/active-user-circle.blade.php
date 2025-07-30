@php

    (auth()->user()) ? $active = "online" : $active = "offline";

    (auth()->user()->role === "super_admin") ? $src = asset('assets/images/faces/face8.png') : $src = asset('assets/images/faces/avatar_profile.png');

@endphp


    <img class="img-xs rounded-circle user-active  {{ $active }}" src="{{ $src }}" alt="Profile image"
        style="width: {{ $width }}; height:{{ $height }};">
