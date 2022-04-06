<div class="row justify-content-center">
    <div class="col-lg-4">
        
        <main class="form-login">
            <h1 class="h3 mb-3 font-weight-normal text-center">Please login</h1>
            <form action="/login" method="post">
                @csrf
                <div class="form-floating">
                    <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" required autofocus>
                    <label for="inputEmail">Email address</label>  
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror rounded-bottom" placeholder="Password" name="password" required>
                    <label for="inputPassword" class="sr-only">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </main>
    </div>
</div>