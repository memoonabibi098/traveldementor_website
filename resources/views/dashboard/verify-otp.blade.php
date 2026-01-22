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
                <h3 class="card-title text-center mb-4" style="color:#c59c3d;">OTP Verification</h3>

                <form action="{{ route('admin.verify-otp.verify') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <!-- OTP -->
                    <div class="mb-3">
                        <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror"
                            value="{{ old('otp') }}" placeholder="Enter OTP">
                        @error('otp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Verify OTP</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>