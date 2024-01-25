@extends('layout.layout')

@section('content')
    <div class="mt-3">
        @if ($status === 'viewing user')
            @include('users.partials.user-card')

            <p class="text-center my-3">Ideas</p>

            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ideas.partials.idea-card')
                </div>
            @empty
                <p class="text-center my-3">No Ideas Found</p>
            @endforelse

            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
        @else
            @include('users.partials.edit-user-card')
        @endif
    </div>
@endsection
