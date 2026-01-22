<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>

    <link rel="icon" href="{{ asset('images/dashboard/dark-scroll-logo.webp') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
</head>

<body>
    <div class="container mt-5">

        <!-- Company Logo -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" alt="Company Logo" class="img-fluid"
                style="max-width: 200px;">
        </div>

        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4" style="color:#c59c3d;">Registration Form</h3>

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" placeholder="Full Name">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" name="useremail"
                            class="form-control @error('useremail') is-invalid @enderror" value="{{ old('useremail') }}"
                            placeholder="Email Address">
                        @error('useremail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-3">
                        <input type="tel" name="userphone" class="form-control @error('userphone') is-invalid @enderror"
                            value="{{ old('userphone') }}" placeholder="Phone Number">
                        @error('userphone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Picture -->
                    <div class="mb-3">
                        <label for="picture" class="form-label">Upload Picture</label>
                        <input type="file" name="picture" class="form-control @error('picture') is-invalid @enderror"
                            id="picture" accept="image/*">
                        @error('picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <input type="text" name="useraddress"
                            class="form-control @error('useraddress') is-invalid @enderror"
                            value="{{ old('useraddress') }}" placeholder="Address">
                        @error('useraddress')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 position-relative">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                            id="password" placeholder="Password">
                        <span toggle="#password" class="fa fa-eye field-icon toggle-password"
                            style="position:absolute; top:10px; right:10px; cursor:pointer;"></span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 position-relative">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            value="{{ old('password_confirmation') }}" id="confirm_password"
                            placeholder="Confirm Password">
                        <span toggle="#confirm_password" class="fa fa-eye field-icon toggle-password"
                            style="position:absolute; top:10px; right:10px; cursor:pointer;"></span>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/registration.js') }}"></script>

</body>

</html>