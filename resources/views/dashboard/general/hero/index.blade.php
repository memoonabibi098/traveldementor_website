@extends('dashboard.app')
@push('styles')
    {{--
    <link rel="stylesheet" href="{{ asset('css/dashboard/hero.css') }}"> --}}
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Hero</h3>
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
                <a href="{{ route('admin.hero') }}" class="links-color">General / Hero / Home</a>
            </li>
        </ol>
    </div>



    @foreach($heroes as $pageKey => $pageHeroes)
        <h3 class="fw-bold mb-3 text-capitalize">{{ $pageKey }} Page Hero Section</h3>

        @foreach($pageHeroes as $hero)
            <div class="header-layout d-flex col-12 px-2 py-3 rounded my-4 header-link justify-content-around position-relative"
                data-hero-id="{{ $hero->id }}" data-page-key="{{ $pageKey }}">

                {{-- Edit / Delete Icons for the whole hero section --}}
                <div class="position-absolute top-50 end-0 d-flex gap-1">
                    {{-- Edit --}}
                    <a href="{{ route('hero.edit', $hero->id) }}" class="text-white bg-primary px-2 py-1 rounded edit-hero-btn"
                        data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="fa fa-pencil"></i>
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('hero.destroy', $hero->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this hero section?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-danger text-white border-0 px-2 py-1 rounded" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>

                <div class="col-6">
                    <div class="col-12 d-flex justify-content-start align-items-center">
                        <i class="fa fa-star me-2"></i>
                        <p class="mb-0 fs-5">{{ $hero->tag ?? '' }}</p>
                    </div>
                    <div class="col-12 mt-3">
                        <h5 class="mb-2">{{ $hero->title ?? '' }}</h5>
                        <p class="mb-0 fs-5">{{ $hero->description ?? '' }}</p>
                    </div>

                    {{-- Dynamic Repeaters --}}
                    @foreach($hero->repeaters as $repeater)
                        @php
                            $fields = $repeater->fields;
                        @endphp

                        @if($repeater->type === 'counters' || $repeater->type === 'experience_badges')
                            <div class="col-12 mt-4 d-flex">
                                @foreach($fields as $field)
                                    @if($field->field_key === 'value')
                                        @php $value = $field->field_value; @endphp
                                    @elseif($field->field_key === 'label')
                                        @php $label = $field->field_value; @endphp
                                    @endif
                                @endforeach
                                <div class="col-4">
                                    <h4>{{ $value ?? '' }}</h4>
                                    <p>{{ $label ?? '' }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                {{-- Images & Client Reviews --}}
                <div class="col-5">
                    <div class="col-12 d-flex justify-content-evenly">
                        @if($hero->primary_image)
                            <img src="{{ asset($hero->primary_image) }}" class="w-25 rounded" alt="">
                        @endif
                        @if($hero->secondary_image)
                            <img src="{{ asset($hero->secondary_image) }}" class="w-25 rounded" alt="">
                        @endif
                    </div>

                    {{-- Client Reviews --}}
                    @foreach($hero->repeaters->where('type', 'client_reviews') as $review)
                        @php
                            $name = $review->fields->firstWhere('field_key', 'name')->field_value ?? '';
                            $designation = $review->fields->firstWhere('field_key', 'designation')->field_value ?? '';
                            $rating = $review->fields->firstWhere('field_key', 'rating')->field_value ?? '';
                            $total_reviews = $review->fields->firstWhere('field_key', 'total_reviews')->field_value ?? '';
                            $picture = $review->fields->firstWhere('field_key', 'picture')->field_value ?? '';
                        @endphp
                        <div class="col-12 mt-4 d-flex">
                            <div class="col-3 d-flex justify-content-end">
                                @if($picture)
                                    <img src="{{ asset($picture) }}" class="w-50 rounded" alt="">
                                @endif
                            </div>
                            <div class="col-6 ms-2">
                                <h4>{{ $name }}</h4>
                                <p class="mb-1">{{ $designation }}</p>
                                <p class="mb-1">{{ $rating }} ({{ $total_reviews }} reviews)</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endforeach
    @endforeach



    {{-- add modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Hero Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heroForm" method="POST" action="{{ route('hero.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_key" id="pageKey">

                        <!-- Page Selector -->
                        <div class="mb-3">
                            <label for="pageSelect" class="form-label">Select Page</label>
                            <select id="pageSelect" class="form-select">
                                <option value="">Select Page</option>
                                <option value="home">Home</option>
                                <option value="about">About</option>
                                <option value="services">Services</option>
                                <option value="visa_status">Visa Status</option>
                                <option value="faqs">FAQs</option>
                                <option value="contact">Contact Us</option>
                            </select>
                        </div>

                        <!-- Dynamic Fields -->
                        <div id="heroFormContainer">
                            <!-- JS will inject inputs here -->
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Hero</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Hero Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="heroEditForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="page_key" id="editPageKey">

                        <!-- Dynamic Fields will be injected here -->
                        <div id="heroEditFormContainer"></div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Hero</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/hero.js') }}"></script>
@endpush