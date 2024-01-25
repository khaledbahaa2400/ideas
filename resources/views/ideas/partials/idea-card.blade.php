<div class="card">
    @include('ideas.partials.idea-card-header')

    <div class="card-body">
        @if ($status === 'editing idea')
            @include('ideas.partials.edit-idea-card')
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif

        @include('ideas.partials.idea-card-footer')
    </div>
</div>
