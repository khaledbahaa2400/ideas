@include('layout.partials.header')

<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6">
        <form class="form mt-5" action="{{ route('register') }}" method="post">
            @csrf
            <h3 class="text-center text-dark">Register</h3>

            <div class="form-group">
                <label for="name" class="text-dark">Name:</label><br>
                <input name="name" type="text" class="form-control">

                @error('name')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="text-dark">Email:</label><br>
                <input name="email" type="email" class="form-control">

                @error('email')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password" class="text-dark">Password:</label><br>
                <input name="password" type="password" class="form-control">

                @error('password')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                <input name="password_confirmation" type="password"class="form-control">
            </div>

            <div class="form-group">
                <label for="remember-me" class="text-dark"></label><br>
                <input type="submit" class="btn btn-dark btn-md" value="submit">
            </div>
        </form>

        <div class="text-right mt-2">
            <a href="{{ route('login') }}" class="text-dark">Login here</a>
        </div>
    </div>
</div>

@include('layout.partials.footer')
