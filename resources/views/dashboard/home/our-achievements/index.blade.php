@extends('dashboard.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}" />
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Our Achievements Speak for Themselves</h3>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-center align-items-center me-2">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createSectionModal" class="text-white" data-bs-toggle="modal"
                        data-bs-target="#createSectionModal">
                        Create<i class="fa fa-plus ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createItemModal" class="text-white" data-bs-toggle="modal" data-bs-target="#createItemModal">
                        Item <i class="fa fa-plus ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.our-achievements.section.index') }}" class="links-color">Home / Our
                    Achievements</a>
            </li>
        </ol>
    </div>
    <div class="col-12">
        <div class="col-12 d-flex flex-column align-items-center">
            @if($sections->isNotEmpty())
                <h4 class="mt-4">{{ $sections->first()->main_heading }}</h4>
                @if($sections->isNotEmpty())
                    <div>
                        <!-- Edit Section Icon -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editSectionModal-{{ $sections->first()->id }}"
                            class="me-2">
                            <i class="fa fa-pencil text-primary"></i>
                        </a>

                        <!-- Delete Section Icon -->
                        <form action="{{ route('our-achievements.section.destroy', $sections->first()->id) }}" method="POST"
                            class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this section?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 m-0">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>
                @endif
                @if($sections->first()->description)
                    <p class="text-center col-10">{{ $sections->first()->description }}</p>
                @endif
            @else
                <h4 class="mt-4">Our Achievements Speak for Themselves</h4>
                <p class="text-center col-10">
                    We take pride in helping travelers reach their destinations with confidence. Over
                    the years, we’ve successfully processed hundreds of visa applications across multiple countries,
                    achieving a high approval rate and earning the trust of countless happy clients worldwide.
                </p>
            @endif
        </div>

        <div class="col-12 d-flex flex-wrap mt-3">
            <div class="col-8 d-flex flex-wrap">
                @foreach($sections as $section)
                    @foreach($section->items as $item)
                        <div class="col-6 pe-5 text-center mb-4 position-relative">
                            <i class="{{ $item->icon }} fs-2"></i>
                            <h4 class="fw-bold mt-3">{{ $item->number }}</h4>
                            <h5 class="fw-bold mt-3">{{ $item->heading }}</h5>
                            @if($item->description)
                                <p class="text-muted">{{ $item->description }}</p>
                            @endif

                            <!-- Edit and Delete Icons -->
                            <div class="position-absolute top-0 end-0 me-2 mt-2 d-flex">
                                <!-- Edit Icon -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editItemModal-{{ $item->id }}" class="me-2">
                                    <i class="fa fa-pencil text-primary"></i>
                                </a>

                                <!-- Delete Icon -->
                                <form action="{{ route('our-achievements.item.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 m-0">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>

            <div class="col-4 d-flex justify-content-center align-items-center">
                {{-- Display first section image if exists --}}
                @php
                    $firstSectionWithImage = $sections->firstWhere('image', '!=', null);
                @endphp

                @if($firstSectionWithImage)
                    <img src="{{ asset($firstSectionWithImage->image) }}" class="w-50 rounded" alt="Achievements Image">
                @endif
            </div>
        </div>

    </div>
    <!-- Create Section Modal -->
    <div class="modal fade" id="createSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('our-achievements.section.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Main Heading</label>
                            <input type="text" name="main_heading" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Save Section</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Item Modal -->
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('our-achievements.item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Section</label>
                            <select name="section_id" class="form-select" required>
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->main_heading }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Icon</label>
                            <input type="text" name="icon" class="form-control" placeholder="e.g., lni lni-world" required>
                        </div>
                        <div class="mb-3">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" placeholder="e.g., 52" required>
                        </div>
                        <div class="mb-3">
                            <label>Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="e.g., Countries" required>
                        </div>
                        <div class="mb-3">
                            <label>Description (optional)</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success">Save Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @foreach($sections as $section)
        <!-- Edit Section Modal -->
        <div class="modal fade" id="editSectionModal-{{ $section->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('our-achievements.section.update', $section->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Main Heading</label>
                                <input type="text" name="main_heading" class="form-control" value="{{ $section->main_heading }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $section->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Image (optional)</label>
                                <input type="file" name="image" class="form-control">
                                @if($section->image)
                                    <img src="{{ asset($section->image) }}" class="w-25 mt-2 rounded" alt="Section Image">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control" value="{{ $section->order }}">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="1" {{ $section->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $section->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-success">Update Section</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach




    @foreach($sections as $section)
        @foreach($section->items as $item)
            <!-- Edit Item Modal -->
            <div class="modal fade" id="editItemModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('our-achievements.item.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Section</label>
                                    <select name="section_id" class="form-select" required>
                                        @foreach($sections as $s)
                                            <option value="{{ $s->id }}" {{ $item->section_id == $s->id ? 'selected' : '' }}>
                                                {{ $s->main_heading }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Icon</label>
                                    <input type="text" name="icon" class="form-control" value="{{ $item->icon }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Number</label>
                                    <input type="text" name="number" class="form-control" value="{{ $item->number }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="{{ $item->heading }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Description (optional)</label>
                                    <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Order</label>
                                    <input type="number" name="order" class="form-control" value="{{ $item->order }}">
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success">Update Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endforeach

@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/popular-destination.js') }}"></script>
@endpush