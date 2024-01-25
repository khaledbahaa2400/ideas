<div class="card align-items-center">
    <div class="px-3 pt-4 pb-2 w-75">
        <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('put')

            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImage() }}"
                    alt="{{ $user->name }}">

                <div class="form-group mb-3">
                    <label for="name" class="text-dark">Name:</label><br>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">

                    @error('name')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="bio" class="text-dark">Bio:</label><br>
                <textarea name="bio" cols="4" class="form-control">{{ $user->bio }}</textarea>

                @error('bio')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="text-dark">Profile Picture:</label><br>
                <input class="form-control" type="file" name="image">

                @error('image')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="remember-me" class="text-dark"></label><br>
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
            </div>
        </form>
    </div>
</div>
