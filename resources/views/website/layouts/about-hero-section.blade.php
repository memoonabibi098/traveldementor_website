{{-- Page Breadcrumb --}}
<div class="page-title">
  <nav class="breadcrumbs mt-4">
    <div class="container">
      <ol>
        <li><a href="{{ route('homepage') }}">Home</a></li>

        @if(isset($heroSection) && $heroSection->page_key === 'about')
          <li class="current">About</li>
        @elseif(isset($heroSection) && $heroSection->page_key === 'home')
          <li class="current">Home</li>
        @elseif(isset($pageTitle))
          <li class="current">{{ $pageTitle }}</li>
        @endif
      </ol>
    </div>
  </nav>
</div>


<section id="about" class="about section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-center mb-5">

      {{-- Left Text --}}
      <div class="col-lg-7">
        <div class="intro-content" data-aos="fade-right" data-aos-delay="200">
          @if(!empty($heroSection->tag))
            <div class="section-badge">
              <i class="bi bi-house-heart"></i>
              <span>{{ $heroSection->tag }}</span>
            </div>
          @endif

          @if(!empty($heroSection->title))
            <h2>{{ $heroSection->title }}</h2>
          @endif

          @if(!empty($heroSection->description))
            <p class="lead-text pe-4">{{ $heroSection->description }}</p>
          @endif
        </div>
      </div>

      {{-- Right Images --}}
      <div class="col-lg-5">
        <div class="visual-section" data-aos="fade-left" data-aos-delay="250">
          <div class="main-image">
            <img src="{{ asset($heroSection->primary_image) }}" alt="Main Hero Image" class="img-fluid">

            {{-- Experience badge --}}
            @if($heroSection->experienceBadges->count())
              <div class="experience-badges">
                <div class="row">
                  @foreach($heroSection->experienceBadges as $badge)
                    @php
                      $value = $badge->fields->firstWhere('field_key', 'value')?->field_value;
                      $suffix = $badge->fields->firstWhere('field_key', 'suffix')?->field_value;
                      $text = $badge->fields->firstWhere('field_key', 'text')?->field_value;
                    @endphp
                    <div class="col-4">
                      <div class="badge-item">
                        <div class="badge-number">{{ $value }}{{ $suffix }}</div>
                        <div class="badge-text">{{ $text }}</div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

          </div>

          @if(!empty($heroSection->secondary_image))
            <div class="overlay-image">
              <img src="{{ asset($heroSection->secondary_image) }}" alt="Secondary Image" class="img-fluid">
            </div>
          @endif
        </div>
      </div>

    </div>
  </div>
</section>