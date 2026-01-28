@extends('dashboard.app')

@section('content')


    {{-- Main Content --}}
    <div class="main-content">
        <!-- Header -->

        <div class="hero-header d-flex justify-content-between align-items-center mb-3">
            <!-- Left Side: Heading -->
            <h2 class="mb-0">Show Country</h2>

            <!-- Right Side: Action Buttons -->
            <div>
                <a href="{{ route('countries.index') }}" class="btn btn-secondary btn-sm me-2">
                    <i class="fa fa-arrow-left fa-lg"></i>
                </a>
                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil-square"></i>
                </a>
            </div>
        </div>

        <!-- Card -->
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 text-primary">Country Details</h5>

                <table class="table table-bordered">
                    <tr>
                        <th style="width: 30%;">Country Name</th>
                        <td>{{ $country->name }}</td>
                    </tr>
                    <tr>
                        <th>Country Code</th>
                        <td>{{ $country->code }}</td>
                    </tr>
                    <tr>
                        <th>Urdu Name</th>
                        <td>{{ $country->urdu_name }}</td>
                    <tr>
                        <th>Flag</th>
                        <td>
                            @if ($country->img)
                                <img src="{{ asset($country->img) }}" width="80" height="50" alt="Country Flag" class="rounded shadow">
                            @else
                                <span class="text-muted">No Image Available</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $country->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At:</th>
                        <td>{{ $country->updated_at->format('d M Y h:i A') }}</td>

                    </tr>
                </table>


            </div>
        </div>
    </div>
@endsection