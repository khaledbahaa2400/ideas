<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImage() }}"
                    alt="{{ $user->name }}">

                <div>
                    <h3 class="card-title mb-0"><a
                            href="{{ Request::is('users/' . $user->id) ? '' : route('users.show', $user->id) }}">{{ $user->name }}</a>
                    </h3>
                    <span class="fs-6 text-muted">{{ $user->email }}</span>
                </div>
            </div>

            @can('update', $user)
                <div>
                    <a href="{{ route('users.edit', Auth::id()) }}">Edit</a>
                </div>
            @endcan
        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio : </h5>

            <p class="fs-6 fw-light">{{ $user->bio ?? 'No Bio Added Yet' }}</p>

            <div class="d-flex justify-content-start">
                <div href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{ $user->followers->count() }} Followers </div>

                <div class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{ $user->ideas->count() }} </div>

                <div href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{ $user->comments->count() }} </div>
            </div>

            @cannot('update', $user)
                <div class="mt-3">
                    @auth
                        @if (auth()->user()->follows($user))
                            <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                @csrf
                                <button class="btn btn-primary btn-sm"> Unfollow </button>
                            </form>
                        @else
                            <form action="{{ route('users.follow', $user->id) }}" method="post">
                                @csrf
                                <button class="btn btn-primary btn-sm"> Follow </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endcan
        </div>
    </div>
</div>
