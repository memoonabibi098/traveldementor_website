<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>

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
        <h3 class="card-title text-center mb-4" style="color:#c59c3d;">Login Form</h3>

        <!-- Flash Messages -->
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <input type="email" name="useremail" class="form-control @error('useremail') is-invalid @enderror"
              value="{{ old('useremail') }}" placeholder="Email Address">
            @error('useremail')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Password -->
          <div class="mb-3 position-relative">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
              value="{{ old('password') }}" id="password" placeholder="Password">
            <span toggle="#password" class="fa fa-eye field-icon toggle-password"
              style="position:absolute; top:10px; right:10px; cursor:pointer;"></span>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>

        </form>
      </div>
    </div>

  </div>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/dashboard/registration.js') }}"></script>
  <script src="{{ asset('js/dashboard/login.js') }}"></script>

</body>

</html>