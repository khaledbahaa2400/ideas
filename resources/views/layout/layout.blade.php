@include('layout.partials.header')

<div class="container py-4">
    @include('partials.success-message')

    <div class="row">
        <div class="col-3">
            @include('layout.partials.sidebar')
        </div>

        <div class="col-6">
            @yield('content')
        </div>

        <div class="col-3">
            @include('layout.partials.search-bar')
            @include('layout.partials.follow-box')
        </div>
    </div>
</div>

@include('layout.partials.footer')
