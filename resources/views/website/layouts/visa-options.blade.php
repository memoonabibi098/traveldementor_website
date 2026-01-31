<div class="departments-grid">
    <div class="row mb-1 justify-content-center">
        <div class="col-lg-12 text-center">
            @if($visaOptions->isNotEmpty())
                <h2 class="section-title title-margin text-center mb-3">
                    {{ $visaOptionMainHeading }}
                </h2>
            @endif
        </div>
    </div>

    <div class="row col-xxl-10 col-lg-12">
        @foreach($visaOptions as $index => $visa)
            <div class="col-lg-3 col-sm-6"
                 data-aos="fade-up"
                 data-aos-delay="{{ 300 + ($index * 50) }}">

                <div class="department-card">
                    <div class="card-icon">
                        <img src="{{ $visa->icon }}" alt="{{ $visa->title }}">
                    </div>

                    <div class="card-content">
                        <h3 class="card-title">{{ $visa->title }}</h3>
                        <p class="card-description">{{ $visa->description }}</p>

                        <div class="card-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ $visa->apply_count }}+</span>
                                <span class="stat-label">Apply</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ $visa->approved_percentage }}%</span>
                                <span class="stat-label">Approved</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>
