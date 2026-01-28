@extends('dashboard.app')

@section('content')


  {{-- Main Content --}}
  <div class="main-content" >

    <!-- Hero Header -->
    <div class="hero-header text-center mb-4">
      <h2 class="mb-0">Edit Country</h2>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <form action="{{ route('countries.update', $country->id) }}" method="POST" enctype="multipart/form-data"
              id="editCountryForm">
              @csrf
              @method('PUT')

              <!-- Country Name -->
              <div class="form-group mb-3">
                <label for="name">Country Name</label>
                <input type="text" class="form-control border-success @error('name') is-invalid @enderror" id="name"
                  name="name" value="{{ old('name', $country->name) }}">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Country Code -->
              <div class="form-group mb-3">
                <label for="code">Country Code</label>
                <input type="text" class="form-control border-success @error('code') is-invalid @enderror" id="code"
                  name="code" value="{{ old('code', $country->code) }}">
                @error('code')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Urdu Name -->
              <div class="form-group mb-3">
                <label for="urdu_name">Urdu Name</label>
                <input type="text" class="form-control border-success @error('urdu_name') is-invalid @enderror"
                  id="urdu_name" name="urdu_name" value="{{ old('urdu_name', $country->urdu_name) }}">
                @error('urdu_name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Flag -->
              <div class="form-group mb-3">
                <label for="img">Flag</label>
                <div class="mb-2">
                  @if($country->img)
                    <img src="{{ asset($country->img) }}" alt="Current Flag" class="img-thumbnail" width="100">
                  @endif
                </div>
                <input type="file" class="form-control border-success @error('img') is-invalid @enderror" id="img"
                  name="img" accept="image/*">
                @error('img')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <!-- Buttons -->
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('scripts')
  <script>
    // Client-side validation
    document.getElementById('editCountryForm').addEventListener('submit', function (e) {
      let valid = true;
      ['name', 'code', 'urdu_name'].forEach(function (id) {
        let input = document.getElementById(id);
        if (input.value.trim() === '') {
          alert(id.replace('_', ' ') + ' is required!');
          input.focus();
          valid = false;
          e.preventDefault();
          return false;
        }
      });
    });
  </script>
@endsection