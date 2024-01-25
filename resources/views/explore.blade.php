@extends('layout.layout')

@section('content')
    @forelse ($users as $user)
        <div class="mt-3">
            @include('users.partials.user-card')
        </div>
    @empty
        <p class="text-center my-3">No Users To Follow</p>
    @endforelse

    <div class="mt-3">
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
