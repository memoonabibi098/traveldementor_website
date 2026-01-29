@extends('dashboard.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Popular Destination</h3>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-center align-items-center me-2">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createSectionModal" class=" text-white" data-bs-toggle="modal"
                        data-bs-target="#createSectionModal">Create
                        <i class="fa fa-plus ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createItemModal" class=" text-white" data-bs-toggle="modal"
                        data-bs-target="#createItemModal">Country
                        <i class="fa fa-plus ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.popular-destination-section.index') }}" class="links-color">Home / Popular
                    Destination</a>
            </li>
        </ol>
    </div>
    <div class="col-12">
        @foreach($sections as $section)
            <div class="col-12 d-flex justify-content-between align-items-center mb-2">
                <div>
                    <h6 class="mt-5">{{ $section->sub_heading }}</h6>
                    <h4 class="mt-1">{{ $section->heading }}</h4>
                </div>
                <div class="d-flex">
                    <!-- Edit Section -->
                    <a href="#editSectionModal{{ $section->id }}" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#editSectionModal{{ $section->id }}">
                        <i class="fa fa-edit"></i>
                    </a>

                    <!-- Delete Section -->
                    <form action="{{ route('popular-destination-section.destroy', $section->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this section?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-12 d-flex flex-wrap mt-3">
                @foreach($section->items as $item)
                    <div class="col-3 d-flex flex-column align-items-center mb-4 position-relative">
                        <img src="{{ asset($item->image) }}" class="rounded w-50 mb-3" alt="{{ $item->text }}">
                        <h5>{{ $item->text }}</h5>

                        <div class="d-flex mt-1">
                            <!-- Edit Item -->
                            <a href="#editItemModal{{ $item->id }}" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                data-bs-target="#editItemModal{{ $item->id }}">
                                <i class="fa fa-edit"></i>
                            </a>

                            <!-- Delete Item -->
                            <form action="{{ route('popular-destination-item.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>



    <!-- Section Modal -->
    <div class="modal fade" id="createSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Popular Destination Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('popular-destination-section.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Page</label>
                            <select name="page_key" class="form-select" required>
                                <option value="">Select Page</option>
                                <option value="home">Home</option>
                                <option value="about">About</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Heading</label>
                            <input type="text" name="sub_heading" class="form-control" placeholder="Enter sub heading">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter heading" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Item Modal -->
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Popular Destination Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('popular-destination-item.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Section</label>
                            <select name="section_id" class="form-select" required>
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->heading }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Destination Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Text / Short Description</label>
                            <input type="text" name="text" class="form-control" placeholder="Enter description">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Destination</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @foreach($sections as $section)
<div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('popular-destination-section.update', $section->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Page</label>
                        <select name="page_key" class="form-select" required>
                            <option value="home" {{ $section->page_key == 'home' ? 'selected' : '' }}>Home</option>
                            <option value="about" {{ $section->page_key == 'about' ? 'selected' : '' }}>About</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sub Heading</label>
                        <input type="text" name="sub_heading" class="form-control" value="{{ $section->sub_heading }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="heading" class="form-control" value="{{ $section->heading }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $section->order }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach



@foreach($sections as $section)
    @foreach($section->items as $item)
<div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Destination Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('popular-destination-item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <select name="section_id" class="form-select" required>
                            @foreach($sections as $s)
                                <option value="{{ $s->id }}" {{ $s->id == $item->section_id ? 'selected' : '' }}>
                                    {{ $s->heading }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Destination Image</label>
                        <input type="file" name="image" class="form-control">
                        <small>Current: <img src="{{ asset($item->image) }}" width="50" alt=""></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Text / Short Description</label>
                        <input type="text" name="text" class="form-control" value="{{ $item->text }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="{{ $item->order }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @endforeach
@endforeach


@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/popular-destination.js') }}"></script>
@endpush