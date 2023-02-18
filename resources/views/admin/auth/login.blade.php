<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {{-- css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
</head>

<body>

    <body class=" row" data-new-gr-c-s-check-loaded="14.1097.0" data-gr-ext-installed="">
        <form class="form-signin col-md-3 mx-auto mt-5" action="{{ route('admin.authenticate') }}" method="POST">
            @csrf
            @method('post')
            <h1 class="text-center">Admin Panel</h1>
            <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPassword" class="sr-only mt-2">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-lg btn-primary btn-block mt-2 w-100" type="submit">Sign in</button>
        </form>


        {{-- js --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    </body>
</body>

</html>