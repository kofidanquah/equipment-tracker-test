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
        <form action="{{ url('passwordChange') }}" method="POST" class="p-4 shadow rounded bg-white"
            style="width: 100%; max-width: 400px;">
            @csrf
            <h4 class="text-center mb-2">Equipment Tracker</h4>
            <h5 class="text-center mb-2">Change Password</h5><br>
            @yield('alertbar')

            <div class="mb-3 position-relative">
                <div class="form-floating">
                    <input type="password" id="password" class="form-control autofocus" name="password">
                    <label for="password">Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" id="toggle-password">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
            </div>

            <div class="mb-3 position-relative">
                <div class="form-floating">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                    <label for="password_confirmation">Password</label>
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Continue</button>

        </form>
    </div>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var confirmPasswordField = document.getElementById('password_confirmation');
            var icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
