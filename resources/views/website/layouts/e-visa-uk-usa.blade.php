<div class="section animated-row" data-section="visa-holders">
    <div class="section-inner">
        <div class="row justify-content-center">
            <div class="col-md-11 col-xxl-8 wide-col-laptop">

                {{-- Loop through sections --}}
                @foreach($visaHolderSections as $section)
                    {{-- Section Title --}}
                    <div class="title-block animate text-center mb-4" data-animate="fadeInUp">
                        <h2>{{ $section->title }}</h2>
                        {{-- @if($section->description)
                            <p>{{ $section->description }}</p>
                        @endif --}}
                    </div>

                    {{-- Items Carousel / Grid --}}
                    <div class="gallery-section">
                        <div class="gallery-list owl-carousel">
                            @foreach($section->items as $item)
                                <div class="item animate" data-animate="fadeInUp">
                                    <div class="portfolio-item">
                                        <div class="thumb">
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                            @endif
                                        </div>
                                        <div class="thumb-inner animate" data-animate="fadeInUp">
                                            <h4>{{ $item->title }}</h4>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
