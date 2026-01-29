<div class="untree_co-section">
    <div class="container max-container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="section-title title-margin text-center mb-3">
                    {{ $chooseUsMain->heading ?? 'Why Choose us?' }}
                </h2>
                <p>
                    {{ $chooseUsMain->description ?? 'Find out why we lead the travel document industry — empowering travelers to fly with confidence, comfort, and complete peace of mind.' }}
                </p>
            </div>
        </div>


        <div class="row align-items-stretch">
            @foreach($chooseUsSections as $section)
                @php
                    $firstColumnPoints = $section->points->filter(function ($point, $key) {
                        return ($key % 2) === 0;
                    });
                    $secondColumnPoints = $section->points->filter(function ($point, $key) {
                        return ($key % 2) === 1;
                    });
                @endphp

                <!-- Left image (if any) -->
                <div class="col-sm-4 order-lg-1">
                    <div class="h-100">
                        <div class="frame h-100">
                            @if($section->main_image)
                                <div class="feature-img-bg h-100"
                                    style="background-image: url('{{ asset($section->main_image) }}');"></div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- First column -->
                <div class="col-6 col-sm-4 feature-1-wrap d-md-flex flex-md-column order-lg-2">
                    @foreach($firstColumnPoints as $point)
                        <div class="feature-1 d-md-flex">
                            <div class="align-self-center">
                                @if($point->icon_image)
                                    <span>
                                        <img src="{{ asset($point->icon_image) }}" alt="{{ $point->heading }}"
                                            class="choose-us-icons img-fluid">
                                    </span>
                                @endif
                                <h3>{{ $point->heading }}</h3>
                                <p class="mb-0">{{ $point->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Second column -->
                <div class="col-6 col-sm-4 feature-1-wrap d-md-flex flex-md-column order-lg-3">
                    @foreach($secondColumnPoints as $point)
                        <div class="feature-1 d-md-flex">
                            <div class="align-self-center">
                                @if($point->icon_image)
                                    <span>
                                        <img src="{{ asset($point->icon_image) }}" alt="{{ $point->heading }}"
                                            class="choose-us-icons img-fluid">
                                    </span>
                                @endif
                                <h3>{{ $point->heading }}</h3>
                                <p class="mb-0">{{ $point->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endforeach
        </div>


    </div>
</div>