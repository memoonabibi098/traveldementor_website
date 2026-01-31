@extends('dashboard.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Visa Options Tailored for You </h3>
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
                        data-bs-target="#createItemModal">Type
                        <i class="fa fa-plus ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.visa-options.index') }}" class="links-color">Home / Visa Options</a>
            </li>
        </ol>
    </div>



    @foreach($sections as $section)
        <div class="col-12 mt-4">
            <div class="col-12 d-flex flex-column align-items-center">
                <h4 class="mt-4">{{ $section->heading }}</h4>

                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editSectionModal{{ $section->id }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('visa-options.section.destroy', $section->id) }}" method="POST"
                    onsubmit="return confirm('Delete this section?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn p-0 text-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>

                @if($section->description)
                    <p class="text-muted text-center col-8">
                        {{ $section->description }}
                    </p>
                @endif


            </div>

            <div class="col-12 d-flex mt-3 flex-wrap">
                @foreach($section->items->where('status', 1) as $item)
                    <div class="col-3 pe-5 mb-4">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="img-fluid">

                        <h4 class="fw-bold mt-3">{{ $item->title }}</h4>

                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('visa-options.item.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn p-0 text-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                        <p>{{ $item->description }}</p>

                        @if($item->counters->count())
                            <div class="col-12 d-flex">
                                @foreach($item->counters as $counter)
                                    <div class="col-6">
                                        <h4>
                                            {{ $counter->value }}{{ $counter->suffix }}
                                        </h4>
                                        <p>{{ $counter->label }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="createSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Visa Option Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visa-options.section.store') }}" method="POST">
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
                            <label class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control" placeholder="Enter heading" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
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


    <div class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Visa Option Item</h5> <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visa-options.item.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Visa Option Title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <hr>
                        <h6 class="fw-bold">Counters</h6>

                        <div id="counter-wrapper">
                            <div class="row counter-row mb-2">
                                <div class="col-md-3">
                                    <input type="number" name="counters[0][value]" class="form-control" placeholder="Value"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="counters[0][suffix]" class="form-control" placeholder="+ / %">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="counters[0][label]" class="form-control"
                                        placeholder="Apply / Approved">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="counters[0][order]" class="form-control" value="1">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-counter d-none">×</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-counter">
                            + Add Counter
                        </button>

                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" name="order" class="form-control" value="1">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Visa Option</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach($sections as $section)
        <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('visa-options.section.update', $section->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Edit Section</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{ $section->heading }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $section->description }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" @selected($section->status == 1)>Active</option>
                                    <option value="0" @selected($section->status == 0)>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Order</label>
                                <input type="number" name="order" value="{{ $section->order }}" class="form-control">
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


    @foreach($sections as $section)
        @foreach($section->items as $item)
            <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <form method="POST" action="{{ route('visa-options.item.update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Visa Option</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ $item->title }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                </div>

                                @if($item->image)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label><br>
                                        <img src="{{ asset($item->image) }}" alt="Current Image"
                                            style="width: 120px; height: auto; border-radius: 6px; border: 1px solid #ddd;">
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label>Replace Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <hr>
                                <h6 class="fw-bold">Counters</h6>

                                <div class="counter-wrapper-edit">
                                    @foreach($item->counters as $index => $counter)
                                        <div class="row counter-row mb-2">
                                            <input type="hidden" name="counters[{{ $index }}][id]" value="{{ $counter->id }}">

                                            <div class="col-md-3">
                                                <input type="number" name="counters[{{ $index }}][value]" class="form-control"
                                                    value="{{ $counter->value }}" required>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" name="counters[{{ $index }}][suffix]" class="form-control"
                                                    value="{{ $counter->suffix }}">
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" name="counters[{{ $index }}][label]" class="form-control"
                                                    value="{{ $counter->label }}">
                                            </div>

                                            <div class="col-md-2">
                                                <input type="number" name="counters[{{ $index }}][order]" class="form-control"
                                                    value="{{ $counter->order }}">
                                            </div>

                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-counter">×</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-sm btn-primary mt-2 add-counter-edit"
                                    data-item="{{ $item->id }}">
                                    + Add Counter
                                </button>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" @selected($item->status == 1)>Active</option>
                                        <option value="0" @selected($item->status == 0)>Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Order</label>
                                    <input type="number" name="order" value="{{ $item->order }}" class="form-control">
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
    <script src="{{ asset('js/dashboard/visa-option.js') }}"></script>
@endpush