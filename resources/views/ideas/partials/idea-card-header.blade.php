<div class="px-3 pt-4 pb-2">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImage() }}"
                alt="{{ $idea->user->name }}">

            <div>
                <h5 class="card-title mb-0"><a
                        href="{{ route('users.show', $idea->user->id) }}">{{ $idea->user->name }}</a></h5>
            </div>
        </div>

        <div class="d-flex align-items-center">
            @can('update', $idea)
                @if ($status !== 'editing idea')
                    <a class="mx-2" href="{{ route('ideas.edit', $idea->id) }}">Edit</a>
                @endif
            @endcan

            @if ($status !== 'viewing idea')
                <a href="{{ route('ideas.show', $idea->id) }}">View</a>
            @endif

            @can('update', $idea)
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="ms-1 btn btn-danger btn-sm ms-2"> X </button>
                </form>
            @endcan
        </div>
    </div>
</div>
