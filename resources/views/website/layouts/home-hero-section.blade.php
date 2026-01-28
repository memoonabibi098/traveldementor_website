{{-- <section id="hero" class="hero section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="hero-content">
      <div class="row align-items-center">

        <div class="col-lg-6 hero-text" data-aos="fade-right" data-aos-delay="200">
          <div class="hero-badge">
            <i class="bi bi-star-fill"></i>
            <span>Visa Consultant</span>
          </div>
          <h1>Navigating Visas, Simplifying Journeys</h1>
          <p>We specialize in Visit Visa consultancy, offering expert assistance for Visit, Business, Family/Friend, and
            Tourist Visas. Along with visa guidance, we also provide additional travel services such as hotel booking,
            air ticketing, and complete trip arrangements for a smooth travel experience.</p>

          <div class="search-form" data-aos="fade-up" data-aos-delay="300">
            <form action="">
              <div class="row g-3">
                <div class="col-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="location" name="location" required="" value="Pakistan"
                      readonly>
                    <label for="location">From Country</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-floating">
                    <select class="form-select" id="property-type" name="property_type" required="">
                      <option value="">Select Country</option>
                      <option value="house">Canada</option>
                      <option value="apartment">Japan</option>
                      <option value="condo">Turkey</option>
                      <option value="townhouse">Morocco</option>
                      <option value="land">United States of America</option>
                    </select>
                    <label for="property-type">To Country</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="price-range" name="price_range" required="">
                      <option value="">Price Range</option>
                      <option value="0-200000">Under $200K</option>
                      <option value="200000-500000">$200K - $500K</option>
                      <option value="500000-800000">$500K - $800K</option>
                      <option value="800000-1200000">$800K - $1.2M</option>
                      <option value="1200000+">Above $1.2M</option>
                    </select>
                    <label for="price-range">Price Range</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="bedrooms" name="bedrooms">
                      <option value="">Bedrooms</option>
                      <option value="1">1 Bedroom</option>
                      <option value="2">2 Bedrooms</option>
                      <option value="3">3 Bedrooms</option>
                      <option value="4">4 Bedrooms</option>
                      <option value="5+">5+ Bedrooms</option>
                    </select>
                    <label for="bedrooms">Bedrooms</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="bathrooms" name="bathrooms">
                      <option value="">Bathrooms</option>
                      <option value="1">1 Bathroom</option>
                      <option value="2">2 Bathrooms</option>
                      <option value="3">3 Bathrooms</option>
                      <option value="4+">4+ Bathrooms</option>
                    </select>
                    <label for="bathrooms">Bathrooms</label>
                  </div>
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-search w-100">
                    <i class="bi bi-search"></i>
                    View Requirements
                  </button>
                </div>
              </div>
            </form>
          </div>

          <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
              <div class="col-4">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="4365" data-purecounter-duration="1"
                      class="purecounter"></span>+</h3>
                  <p>Happy Customers</p>
                </div>
              </div>
              <div class="col-4">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="13" data-purecounter-duration="1"
                      class="purecounter"></span>+</h3>
                  <p>Years of Experience</p>
                </div>
              </div>
              <div class="col-4">
                <div class="stat-item">
                  <h3><span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1"
                      class="purecounter"></span>%</h3>
                  <p>Visa Approval Rate</p>
                </div>
              </div>
            </div>
          </div>

        </div><!-- End Hero Text -->

        <div class="col-lg-6 hero-images" data-aos="fade-left" data-aos-delay="400">
          <div class="image-stack">
            <div class="main-image">
              <img src="{{ asset('images/website_images/home/assaasfdfd.webp') }}" alt="Luxury Property"
                class="img-fluid">
            </div>

            <div class="secondary-image">
              <img src="{{ asset('images/website_images/home/asasasa.webp') }}" alt="Property Interior"
                class="img-fluid">
            </div>

            <div class="floating-card">
              <div class="agent-info">
                <img src="{{ asset('images/website_images/home/SARFRAZ AHMAD.webp') }}" alt="Agent"
                  class="agent-avatar">
                <div class="agent-details">
                  <h5>SARFRAZ AHMAD</h5>
                  <p>Secretary, National Bank of Pakistan</p>
                  <div class="rating">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <span>5 (127 reviews)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Hero Images -->

      </div>
    </div>

  </div>

</section> --}}







<section id="hero" class="hero section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="hero-content">
            <div class="row align-items-center">

                {{-- Left Text --}}
                <div class="col-lg-6 hero-text" data-aos="fade-right" data-aos-delay="200">
                    @if(!empty($heroSection->tag))
                        <div class="hero-badge">
                            <i class="bi bi-star-fill"></i>
                            <span>{{ $heroSection->tag }}</span>
                        </div>
                    @endif

                    @if(!empty($heroSection->title))
                        <h1>{{ $heroSection->title }}</h1>
                    @endif

                    @if(!empty($heroSection->description))
                        <p>{{ $heroSection->description }}</p>
                    @endif

                    {{-- Search form --}}
                    <div class="search-form" data-aos="fade-up" data-aos-delay="300">
                        <form action="" target="_blank">
                            @csrf
                            <input type="hidden" name="from_country" value="Pakistan" />
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="from_country_display" value="Pakistan" readonly>
                                        <label for="from_country_display">From</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="to_country" name="to_country" required>
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="to_country">To</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-search w-100">
                                        <i class="fa fa-globe"></i> View Requirements
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Counters --}}
                    @if($heroSection->counters->count())
                        <div class="hero-stats">
                            <div class="row">
                                @foreach($heroSection->counters as $counter)
                                    @php
                                        $value = $counter->fields->firstWhere('field_key', 'value')?->field_value;
                                        $label = $counter->fields->firstWhere('field_key', 'label')?->field_value;
                                        $suffix = $counter->fields->firstWhere('field_key', 'suffix')?->field_value;
                                    @endphp
                                    <div class="col-4">
                                        <div class="stat-item">
                                            <h3>
                                                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="{{ $value }}"></span>{{ $suffix }}
                                            </h3>
                                            <p>{{ $label }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Images / Client Review --}}
                <div class="col-lg-6 hero-images" data-aos="fade-left" data-aos-delay="400">
                    <div class="image-stack">
                        <div class="main-image">
                            <img src="{{ asset($heroSection->primary_image) }}" alt="Main Hero Image" class="img-fluid">
                        </div>

                        @if(!empty($heroSection->secondary_image))
                            <div class="secondary-image">
                                <img src="{{ asset($heroSection->secondary_image) }}" alt="Secondary Image" class="img-fluid">
                            </div>
                        @endif

                        @if($heroSection->clientReview)
                            @php
                                $review = $heroSection->clientReview;
                                $name = $review->fields->firstWhere('field_key', 'name')?->field_value;
                                $designation = $review->fields->firstWhere('field_key', 'designation')?->field_value;
                                $rating = (int) ($review->fields->firstWhere('field_key', 'rating')?->field_value ?? 0);
                                $total = $review->fields->firstWhere('field_key', 'total_reviews')?->field_value;
                                $picture = $review->fields->firstWhere('field_key', 'picture')?->field_value;
                            @endphp

                            <div class="floating-card">
                                <div class="agent-info">
                                    <img src="{{ asset($picture) }}" class="agent-avatar">
                                    <div class="agent-details">
                                        <h5>{{ $name }}</h5>
                                        <p>{{ $designation }}</p>
                                        <div class="rating">
                                            @for($i = 0; $i < $rating; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                            <span>{{ $rating }} ({{ $total }} reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
