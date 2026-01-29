@extends('dashboard.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Choose Us</h3>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createModal" class=" text-white" data-bs-toggle="modal" data-bs-target="#createModal">Create
                        <i class="fa fa-plus ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.choose-us.index') }}" class="links-color">Home / Choose Us</a>
            </li>
        </ol>
    </div>


    @foreach($sections as $section)
        <div class="header-layout d-flex col-12 px-2 py-3 rounded my-4 header-link justify-content-around">

            {{-- Section Main Image --}}
            <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                <div class="logo-div mb-5">
                    @if($section->main_image)
                        <img src="{{ asset($section->main_image) }}" class="w-100 rounded" alt="Main Image">
                    @endif
                </div>
            </div>

            {{-- Section Heading & Description --}}
            <div class="col-9">
                <div class="col-12 d-flex flex-column align-items-center">
                    <h4>{{ $section->heading }}</h4>
                    <p>{{ $section->description }}</p>
                </div>

                {{-- Points --}}
                <div class="col-10 ms-5">
                    <div class="col-12 d-flex justify-content-center flex-wrap">
                        @foreach($section->points->sortBy('order') as $point)
                            <div class="col-5 mb-4 ">
                                @if($point->icon_image)
                                    <img src="{{ asset($point->icon_image) }}" class="height" alt="Point Icon">
                                @endif
                                <h4 class="mt-3">{{ $point->heading }}</h4>
                                <p class="mt-2">{{ $point->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Edit / Delete Actions --}}
            <div class="col-1 d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-around align-items-center w-100">
                    <div class="edit-del-icon px-3 py-2 rounded">
                        <a href="#editModal-{{ $section->id }}" data-bs-toggle="modal"
                            data-bs-target="#editModal-{{ $section->id }}">
                            <i class="fa fa-pencil-square-o fs-5 text-white"></i>
                        </a>
                    </div>

                    <div class="bg-danger px-3 py-2 rounded">
                        <form action="{{ route('choose-us.destroy', $section->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn p-0">
                                <i class="fa fa-trash-o fs-5 text-white"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endforeach

    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                {{-- Modal Header --}}
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Create “Why Choose Us” Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body">
                    <form action="{{ route('choose-us.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ================= MAIN SECTION ================= --}}
                        <h6 class="fw-bold mb-3">Main Section</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Page</label>
                                <select name="page_key" class="form-select" required>
                                    <option value="">Select Page</option>
                                    <option value="home">Home</option>
                                    <option value="about">About</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Main Image</label>
                                <input type="file" name="main_image" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="Why Choose Us?" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Main Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Short description about why customers should choose you" required></textarea>
                        </div>

                        <hr>

                        {{-- ================= POINTS SECTION ================= --}}
                        <div class=" mb-3">
                            <h6 class="fw-bold mb-0">Choose Us Points</h6>

                            <div id="pointsWrapper" class="col-12 d-flex flex-column">
                                <!-- Dynamic points will be added here -->
                            </div>

                            <button type="button" class="btn btn-sm btn-primary" id="addPoint">
                                <i class="fa fa-plus"></i> Add Point
                            </button>
                        </div>

                        {{-- <div id="pointsContainer">

                            <div class="card mb-3 point-item">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <label class="form-label">Icon / Image</label>
                                            <input type="file" name="points[0][icon]" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="points[0][title]" class="form-control"
                                                placeholder="Fast & Hassle-Free" required>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="points[0][description]" class="form-control" rows="2"
                                                placeholder="Short description" required></textarea>
                                        </div>

                                        <div class="col-md-1 text-end">
                                            <button type="button" class="btn btn-danger btn-sm removePoint mt-4">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}

                        <small class="text-muted">
                            Minimum 4 points recommended
                        </small>

                        {{-- Modal Footer --}}
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save Section
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit “Why Choose Us” Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('choose-us.update', $section->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h6 class="fw-bold mb-3">Main Section</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Page</label>
                                <select name="page_key" class="form-select" required>
                                    <option value="home" {{ $section->page_key == 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="about" {{ $section->page_key == 'about' ? 'selected' : '' }}>About</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Main Image</label>
                                <input type="file" name="main_image" class="form-control">
                                @if($section->main_image)
                                    <img src="{{ asset($section->main_image) }}" class="mt-2" width="150" alt="Current Image">
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="heading" class="form-control" value="{{ $section->heading }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Main Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                required>{{ $section->description }}</textarea>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="fw-bold mb-0">Choose Us Points</h6>
                            <div id="pointsWrapper-{{ $section->id }}" class="col-12 d-flex flex-column">
                                @foreach($section->points->sortBy('order') as $index => $point)
                                    <input type="hidden" name="points[{{ $index }}][id]" value="{{ $point->id }}">
                                    <div class="card mb-3 point-item" data-index="{{ $index }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>Point {{ $index + 1 }}</strong>
                                                <button type="button" class="btn btn-sm btn-danger remove-point">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Order</label>
                                                <input type="number" name="points[{{ $index }}][order]" class="form-control"
                                                    value="{{ $point->order }}">
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Icon</label>
                                                <input type="file" name="points[{{ $index }}][icon]" class="form-control">
                                                @if($point->icon_image)
                                                    <img src="{{ asset($point->icon_image) }}" width="100" class="mt-1">
                                                @endif
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Heading</label>
                                                <input type="text" name="points[{{ $index }}][heading]" class="form-control"
                                                    value="{{ $point->heading }}">
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Paragraph</label>
                                                <textarea name="points[{{ $index }}][description]" class="form-control"
                                                    rows="3">{{ $point->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-sm btn-primary add-edit-point"
                                data-section="{{ $section->id }}">
                                <i class="fa fa-plus"></i> Add Point
                            </button>
                        </div>

                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Section</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/choose-us.js') }}"></script>
@endpush