@extends('layout.layout')

@section('content')
    @include('partials.submit-idea')

    @forelse ($ideas as $idea)
        <div class="mt-3">
            @include('ideas.partials.idea-card')
        </div>
    @empty
        <p class="text-center my-3"> {{ Route::is('dashboard') ? 'No Ideas Found' : 'Follow More People To See More' }} </p>
    @endforelse

    <div class="mt-3">
        {{ $ideas->withQueryString()->links() }}
    </div>
@endsection
