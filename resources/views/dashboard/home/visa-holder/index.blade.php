@extends('dashboard.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@endpush

@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Visa Holder Sections</h3>
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
                <a href="{{ route('admin.visa-holder.index') }}" class="links-color">Home / Visa Holder</a>
            </li>
        </ol>
    </div>

    @foreach($sections as $section)
        <div class="col-12 mt-4">
            <div class="col-12 d-flex flex-column align-items-center">
                <h4 class="mt-4">{{ $section->title }}</h4>

                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editSectionModal{{ $section->id }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('visa-holder-section.destroy', $section->id) }}" method="POST"
                    onsubmit="return confirm('Delete this section?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn p-0 text-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>

                @if($section->description)
                    <p class="text-muted text-center col-8">{{ $section->description }}</p>
                @endif
            </div>

            <div class="col-12 d-flex mt-3 flex-wrap">
                @foreach($section->items->where('status', 1) as $item)
                    <div class="col-3 pe-5 mb-4">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="img-fluid rounded">
                        @endif

                        <h4 class="fw-bold mt-3">{{ $item->title }}</h4>

                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('visa-holder-item.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn p-0 text-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                        <p>{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <!-- Create Section Modal -->
    <div class="modal fade" id="createSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visa-holder-section.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-success">Save Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Item Modal -->
    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visa-holder-item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Section</label>
                            <select name="section_id" class="form-select" required>
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-success">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Section Modals -->
    @foreach($sections as $section)
        <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('visa-holder-section.update', $section->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Section</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ $section->title }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $section->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Order</label>
                                <input type="number" name="order" value="{{ $section->order }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" @selected($section->status == 1)>Active</option>
                                    <option value="0" @selected($section->status == 0)>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Edit Item Modals -->
    <!-- Edit Item Modals -->
    @foreach($sections as $section)
        @foreach($section->items as $item)
            <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form action="{{ route('visa-holder-item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Item</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <!-- Section -->
                                <div class="mb-3">
                                    <label>Section</label>
                                    <select name="section_id" class="form-select" required>
                                        <option value="">Select Section</option>
                                        @foreach($sections as $sectionOption)
                                            <option value="{{ $sectionOption->id }}" @selected($sectionOption->id == $item->section_id)>
                                                {{ $sectionOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Title -->
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $item->title }}" class="form-control" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                </div>

                                <!-- Current Image -->
                                @if($item->image)
                                    <div class="mb-3">
                                        <label>Current Image</label><br>
                                        <img src="{{ asset($item->image) }}"
                                            style="width:120px; border-radius:6px; border:1px solid #ddd;">
                                    </div>
                                @endif

                                <!-- Replace Image -->
                                <div class="mb-3">
                                    <label>Replace Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <!-- Order -->
                                <div class="mb-3">
                                    <label>Order</label>
                                    <input type="number" name="order" value="{{ $item->order }}" class="form-control">
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" @selected($item->status == 1)>Active</option>
                                        <option value="0" @selected($item->status == 0)>Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endforeach

@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard/visa-holders.js') }}"></script>
@endpush