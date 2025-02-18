<!DOCTYPE html>
<html lang="en" data-theme="light">
@include('layouts.partials.head')
@yield('heads')
<body>
@include('layouts.partials.sidebar')

<main class="dashboard-main">
    @include('sweetalert::alert')
    @include('layouts.partials.header')

    @yield('content')

    @include('layouts.partials.footer')
</main>
@include('layouts.partials.script')
@yield('scripts')
</body>
</html>
