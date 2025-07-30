@if ($role === 'super_admin' && Auth::check())
    {{ $slot }}
@endif