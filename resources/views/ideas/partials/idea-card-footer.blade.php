<div>
    @if ($status !== 'editing idea')
        <div class="d-flex justify-content-between mb-2">
            <div>
                @auth
                    @if (auth()->user()->liked($idea))
                        <form action="{{ route('ideas.unlike', $idea->id) }}" method="post">
                            @csrf
                            <button class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                                </span> {{ $idea->likes_count }} </button>
                        </form>
                    @else
                        <form action="{{ route('ideas.like', $idea->id) }}" method="post">
                            @csrf
                            <button class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                                </span> {{ $idea->likes_count }} </button>
                        </form>
                    @endif

                @endauth
                @guest
                    <a href="{{ route('login') }}" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                        </span> {{ $idea->likes_count }} </a>
                @endguest
            </div>

            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }} </span>
            </div>
        </div>

        <form action="{{ route('ideas.comments.store', $idea->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
            </div>

            <div>
                <button class="btn btn-primary btn-sm"> Post Comment </button>
            </div>
            <hr>
        </form>

        @if ($status === 'viewing idea')
            @forelse ($idea->comments as $comment)
                @include('ideas.partials.idea-comment', ['comment' => $comment])

                @if (!$loop->last)
                    <hr>
                @endif
            @empty
                <p class="text-center my-3">No Comments Yet</p>
            @endforelse
        @else
            @forelse ($idea->comments->take(2) as $comment)
                @include('ideas.partials.idea-comment', ['comment' => $comment])

                @if (!$loop->last)
                    <hr>
                @endif
            @empty
                <p class="text-center my-3">No Comments Yet</p>
            @endforelse

            @if ($idea->comments->count() > 2)
                <hr>
                <a href="{{ route('ideas.show', $idea->id) }}">Load More</a>
            @endif
        @endif
    @endif
</div>
