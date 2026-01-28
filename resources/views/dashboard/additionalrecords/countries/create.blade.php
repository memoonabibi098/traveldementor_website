@extends('dashboard.app')
@section('content')


    {{-- Main Content --}}
    <div class="main-content">
        <!-- Hero Header -->
        <div class="hero-header text-center mb-4">
            <h2 class="mb-0">Create Country</h2>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Country Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Country Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter country name.</div>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Country Code -->
                            <div class="mb-3">
                                <label for="code" class="form-label">Country Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" value="{{ old('code') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter country code.</div>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Urdu Name -->
                            <div class="mb-3">
                                <label for="urdu_name" class="form-label">Urdu Name</label>
                                <input type="text" class="form-control @error('urdu_name') is-invalid @enderror"
                                    id="urdu_name" name="urdu_name" value="{{ old('urdu_name') }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter Urdu name.</div>
                                @error('urdu_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Flag -->
                            <div class="mb-3">
                                <label for="img" class="form-label">Flag</label>
                                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img"
                                    name="img" accept="image/*" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please upload a flag image.</div>
                                @error('img')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Client-Side Validation --}}
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
