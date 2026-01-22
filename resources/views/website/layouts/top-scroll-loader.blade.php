<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="loader">
        <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" alt="Logo" class="loader-img" />
    </div>
</div>

<!-- Scroll Progress Bar -->
<div id="scroll-progress-bar"></div>



{{-- <div class="whatsapp-icon-main-div">
  <div class="whatsapp-icon-div">
    <a href="https://wa.me/923248652929" target="_blank" rel="noopener noreferrer">
      <img src="{{ asset('images/website_images/home/whatsapp-icon.webp') }}" alt="Chat on WhatsApp">
    </a>
  </div>
</div> --}}
@php
    $message = <<<EOT
    Hello!

    Hello, I visited your website Travel de Mentor. I’m interested in applying for a visit visa. Can you please guide me through the process?

    Thank you!
EOT;
@endphp

<div class="whatsapp-icon-main-div">
    <div class="whatsapp-icon-div">
        <a href="https://wa.me/923248652929?text={{ urlencode($message) }}" target="_blank" rel="noopener noreferrer">
            <img src="{{ asset('images/website_images/home/whatsapp-icon.webp') }}" alt="Chat on WhatsApp">
        </a>
    </div>
</div>

<!-- Scroll To Top Button -->
<div class="scroll-div">
    <div class="scroll-to-top" id="scrollToTopBtn">
        <img src="{{ asset('images/website_images/home/scroll-logo.webp') }}" alt="Scroll to Top" />
    </div>
</div>
