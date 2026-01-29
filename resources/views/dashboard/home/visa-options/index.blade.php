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
    <div class="col-12">
        <div class="col-12 d-flex flex-column align-items-center">
            <h4 class="mt-4">Visa Options Tailored for You</h4>
        </div>
        <div class="col-12 d-flex mt-3">
            <div class="col-3 pe-5">
                <img src="{{ asset('images/website_images/home/business-visa-dark-golden.webp') }}" alt="">
                <h4 class="fw-bold mt-3">Business Visa</h4>
                <p>Whether to attend a Business Meeting or to participate in an International Exhibition, We ensure you meet
                    all requirements.</p>
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <h4>1250+</h4>
                        <p>Apply</p>
                    </div>
                    <div class="col-6">
                        <h4>93%</h4>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
            <div class="col-3 pe-5">
                <img src="{{ asset('images/website_images/home/Tourist-visa-dark-golden.webp') }}" alt="">
                <h4 class="fw-bold mt-3">Tourist Visa</h4>
                <p>Ready to explore new Destinations? Let us handle the paper work and logistics of securing your tourist
                    visa so you can focus on creating unforgettable travel memories.</p>
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <h4>1450+</h4>
                        <p>Apply</p>
                    </div>
                    <div class="col-6">
                        <h4>97%</h4>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
            <div class="col-3 pe-5">
                <img src="{{ asset('images/website_images/home/family-friend-visa-dark-golden.webp') }}" alt="">
                <h4 class="fw-bold mt-3">Family/Friend Visa</h4>
                <p>Reuniting with family members is Priceless. We will assist You in obtaining the necessary visa for your
                    family or friend’s visit, making the journey to see your loved ones stress-free.</p>
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <h4>1300+</h4>
                        <p>Apply</p>
                    </div>
                    <div class="col-6">
                        <h4>90%</h4>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
            <div class="col-3 pe-5">
                <img src="{{ asset('images/website_images/home/e-visa-dark-golden.webp') }}" alt="">
                <h4 class="fw-bold mt-3">E-Visa</h4>
                <p>An E-visa is a digital visa that lets you apply online, saving time and effort. Countries like Thailand,
                    Malaysia and Baku E-visas for Pakistani, making travel simple and convenient!
                </p>
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <h4>1800+</h4>
                        <p>Apply</p>
                    </div>
                    <div class="col-6">
                        <h4>98%</h4>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


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


@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/popular-destination.js') }}"></script>
@endpush