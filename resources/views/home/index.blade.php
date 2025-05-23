@include('layout.components')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <form action="{{ url('login') }}" method="POST" class="p-4 shadow rounded bg-white"
            style="width: 100%; max-width: 400px;">
            @csrf
            <h4 class="text-center mb-2">Equipment Tracker</h4>
            <h5 class="text-center mb-2">Login</h5><br>
            @yield('alertbar')
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" autofocus>
                <label for="email">Email</label>
            </div>
            <div class="mb-3 position-relative">
                <div class="form-floating">
                    <input type="password" id="password" class="form-control" name="password">
                    <label for="password">Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="toggle-password">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
                <div class="text-end text-primary mt-2"><a href="#">Forgot Password?</a></div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

        </form>
    </div>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
