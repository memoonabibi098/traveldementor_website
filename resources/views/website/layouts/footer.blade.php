<footer id="footer" class="footer position-relative">

    <div class="container">
        <div class="row gy-5">

            <div class="col-md-5 d-flex justify-content-center">
                <div class="footer-content ">
                    <a href="{{ route('homepage') }}" class="logo d-flex align-items-center mb-4 ">
                        <img src="{{ $footer && $footer->logo ? asset('uploads/footer/' . $footer->logo) : asset('images/website_images/home/dark-logo.webp') }}"
                            alt="Footer Logo" class="w-75">
                    </a>
                    <p class="mb-4">{{ $footer->intro_text ?? 'Travel de Mentor, a trusted Visa Consultancy firm...' }}
                    </p>
                    <div class="newsletter-form">
                        <h5>{{ $footer->newsletter_text ?? 'Stay Updated' }}</h5>
                        <form id="newsletterForm" action="" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                    required>
                                <button type="submit" class="btn-subscribe">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>
                        <div id="newsletterMessage" class="mt-2"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-4">
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        @forelse($companyLinks as $link)
                            <li><a href="{{ $link['url'] ?? '#' }}"><i class="bi bi-chevron-right"></i>
                                    {{ $link['title'] ?? '' }}</a></li>
                        @empty
                            <li><a href="#"><i class="bi bi-chevron-right"></i> FAQs</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Privacy Policy</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right"></i> Terms & Conditions</a></li>
                        @endforelse
                    </ul>
                </div>
            </div>


            <div class="col-md-5 col-7">
                <div class="footer-contact">
                    <h4>Get in Touch</h4>
                    @if($footer->phone)
                        <div class="contact-item">
                            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                            <div class="contact-info">
                                <p>{{ $footer->phone }}</p>
                            </div>
                        </div>
                    @endif

                    @if($footer->email)
                        <div class="contact-item">
                            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                            <div class="contact-info">
                                <p>{{ $footer->email }}</p>
                            </div>
                        </div>
                    @endif

                      <div class="social-links">
                        @if($footer->facebook)
                        <a href="{{ $footer->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($footer->instagram)
                        <a href="{{ $footer->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($footer->mail)
                        <a href="mailto:{{ $footer->mail }}" target="_blank"><i class="bi bi-envelope"></i></a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="copyright">
                        <p>© <span>Copyright</span> <strong class="px-1 sitename">Travel de Mentor</strong> <span>All
                                Rights Reserved</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#newsletterForm').submit(function (e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (response) {
                    $('#newsletterMessage').html('<div class="alert alert-success">' + response.success + '</div>');
                    form[0].reset();
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function (key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#newsletterMessage').html(errorHtml);
                }
            });
        });
    });
</script>