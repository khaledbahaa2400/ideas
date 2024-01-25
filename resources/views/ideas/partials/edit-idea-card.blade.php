<form action="{{ route('ideas.update', $idea->id) }}" method="post">
    @csrf
    @method('put')
    <div class="mb-3">
        <textarea class="form-control" name="content" id="idea" rows="3">{{ $idea->content }}</textarea>
        @error('content')
            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
        @enderror
    </div>

    <div class="">
        <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
    </div>
</form>
