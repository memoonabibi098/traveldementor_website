@extends('dashboard.app')

@section('content')


    {{-- Main Content --}}
    <div class="main-content">
        <!-- Hero Header -->
        <div class="hero-header d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Country List</h2>
            <a href="{{ route('countries.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table id="countryTable" class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Sr. No</th>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Urdu Name</th>
                        <th>Flag</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($countries as $index => $country)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->code }}</td>
                            <td>{{ $country->urdu_name }}</td>
                            <td>
                                @if ($country->img)
                                    <img src="{{ asset($country->img) }}" width="70" height="50">

                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('countries.show', $country->id) }}" class="btn btn-sm btn-primary"
                                    style="padding: 0.5rem !important;"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-sm btn-success"
                                    style="padding: 0.5rem !important;"><i class="fa fa-pencil-square"></i></a>
                                <form action="{{ route('countries.destroy', $country->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" style="padding: 0.5rem !important;"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>


            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#countryTable').DataTable({
        order: [[1, 'asc']], // 👈 Country Name ASC
        pageLength: 10,
        columnDefs: [
            { orderable: false, targets: [5] }
        ]
    });
});
</script>
@endpush
