<section class="category-area bg-top-center" data-bg-src="{{ asset('images/website_images/home/category_bg_1.webp') }}">
    <div class="container popular-destination th-container">

        @if($popularDestinationsSections->count())
            @foreach($popularDestinationsSections as $section)
                <div class="title-area text-center mb-4">
                    @if($section->sub_heading)
                        <span class="sub-title">{{ $section->sub_heading }}</span>
                    @endif
                    <h2 class="sec-title">{{ $section->heading }}</h2>
                </div>

                @if($section->items->count())
                    <div class="swiper categorySlider" id="categorySlide-{{ $section->id }}">
                        <div class="swiper-wrapper">
                            @foreach($section->items as $item)
                                <div class="swiper-slide">
                                    <div class="category-card single">
                                        <div class="box-img global-img">
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->text }}">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </div>
                                        <h3 class="box-title">{{ $item->text }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <p>No destinations available in this section.</p>
                    </div>
                @endif
            @endforeach
        @else
            <div class="text-center py-5">
                <p>No popular destinations available.</p>
            </div>
        @endif

    </div>
</section>
