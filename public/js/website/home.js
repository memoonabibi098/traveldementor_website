/**
 * Template Name: TheProperty
 * Template URL: https://bootstrapmade.com/theproperty-bootstrap-real-estate-template/
 * Updated: Aug 05 2025 with Bootstrap v5.3.7
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
(function () {
    "use strict";
    /**
     * Initiate Pure Counter
     */
    new PureCounter();

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                let config = JSON.parse(
                    swiperElement
                        .querySelector(".swiper-config")
                        .innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
    }

    window.addEventListener("load", initSwiper);

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Product Image Zoom and Thumbnail Functionality
     */

    function productDetailFeatures() {
        // Initialize Drift for image zoom
        function initDriftZoom() {
            // Check if Drift is available
            if (typeof Drift === "undefined") {
                console.error("Drift library is not loaded");
                return;
            }

            const driftOptions = {
                paneContainer: document.querySelector(".image-zoom-container"),
                inlinePane: window.innerWidth < 768 ? true : false,
                inlineOffsetY: -85,
                containInline: true,
                hoverBoundingBox: false,
                zoomFactor: 3,
                handleTouch: false,
            };

            // Initialize Drift on the main product image
            const mainImage = document.getElementById("main-product-image");
            if (mainImage) {
                new Drift(mainImage, driftOptions);
            }
        }

        // Thumbnail click functionality
        function initThumbnailClick() {
            const thumbnails = document.querySelectorAll(".thumbnail-item");
            const mainImage = document.getElementById("main-product-image");

            if (!thumbnails.length || !mainImage) return;

            thumbnails.forEach((thumbnail) => {
                thumbnail.addEventListener("click", function () {
                    // Get image path from data attribute
                    const imageSrc = this.getAttribute("data-image");

                    // Update main image src and zoom attribute
                    mainImage.src = imageSrc;
                    mainImage.setAttribute("data-zoom", imageSrc);

                    // Update active state
                    thumbnails.forEach((item) =>
                        item.classList.remove("active")
                    );
                    this.classList.add("active");

                    // Reinitialize Drift for the new image
                    initDriftZoom();
                });
            });
        }

        // Image navigation functionality (prev/next buttons)
        function initImageNavigation() {
            const prevButton = document.querySelector(
                ".image-nav-btn.prev-image"
            );
            const nextButton = document.querySelector(
                ".image-nav-btn.next-image"
            );

            if (!prevButton || !nextButton) return;

            const thumbnails = Array.from(
                document.querySelectorAll(".thumbnail-item")
            );
            if (!thumbnails.length) return;

            // Function to navigate to previous or next image
            function navigateImage(direction) {
                // Find the currently active thumbnail
                const activeIndex = thumbnails.findIndex((thumb) =>
                    thumb.classList.contains("active")
                );
                if (activeIndex === -1) return;

                let newIndex;
                if (direction === "prev") {
                    // Go to previous image or loop to the last one
                    newIndex =
                        activeIndex === 0
                            ? thumbnails.length - 1
                            : activeIndex - 1;
                } else {
                    // Go to next image or loop to the first one
                    newIndex =
                        activeIndex === thumbnails.length - 1
                            ? 0
                            : activeIndex + 1;
                }

                // Simulate click on the new thumbnail
                thumbnails[newIndex].click();
            }

            // Add event listeners to navigation buttons
            prevButton.addEventListener("click", () => navigateImage("prev"));
            nextButton.addEventListener("click", () => navigateImage("next"));
        }

        // Initialize all features
        initDriftZoom();
        initThumbnailClick();
        initImageNavigation();
    }

    productDetailFeatures();
})();

// e-visa Uk USA Visa holder

(function ($, window, document, undefined) {
    "use strict";
    var $winW = function () {
        return $(window).width();
    };
    var $winH = function () {
        return $(window).height();
    };
    var $screensize = function (element) {
        $(element).width($winW()).height($winH());
    };
    var screencheck = function (mediasize) {
        if (typeof window.matchMedia !== "undefined") {
            var screensize = window.matchMedia(
                "(max-width:" + mediasize + "px)"
            );
            if (screensize.matches) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($winW() <= mediasize) {
                return true;
            } else {
                return false;
            }
        }
    };
    $(document).ready(function () {
        if ($(".gallery-list").length) {
            $(".gallery-list").owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                items: 3,
                autoplay: true,
                smartSpeed: 700,
                autoplayTimeout: 4000,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0,
                    },
                    576: {
                        items: 2,
                        margin: 20,
                    },
                    992: {
                        items: 3,
                        margin: 30,
                    },
                },
            });
        }
    });
})(jQuery, window, document);

/*----------Set Background Image Color & Mask Popular Destination ----------*/
if ($("[data-bg-src]").length > 0) {
    $("[data-bg-src]").each(function () {
        var src = $(this).attr("data-bg-src");
        $(this).css("background-image", "url(" + src + ")");
        $(this).removeAttr("data-bg-src").addClass("background-image");
    });
}

if ($("[data-bg-color]").length > 0) {
    $("[data-bg-color]").each(function () {
        var color = $(this).attr("data-bg-color");
        $(this).css("background-color", color);
        $(this).removeAttr("data-bg-color");
    });
}

$("[data-border]").each(function () {
    var borderColor = $(this).data("border");
    $(this).css("--th-border-color", borderColor);
});

if ($("[data-mask-src]").length > 0) {
    $("[data-mask-src]").each(function () {
        var mask = $(this).attr("data-mask-src");
        $(this).css({
            "mask-image": "url(" + mask + ")",
            "-webkit-mask-image": "url(" + mask + ")",
        });
        $(this).addClass("bg-mask");
        $(this).removeAttr("data-mask-src");
    });
}

// swiperEl.addEventListener('mouseenter', function(event) {
document.addEventListener(
    "mouseenter",
    (event) => {
        const el = event.target;
        if (el && el.matches && el.matches(".swiper-container")) {
            // console.log('mouseenter');
            // console.log('autoplay running', swiper.autoplay.running);
            el.swiper.autoplay.stop();
            el.classList.add("swiper-paused");

            const activeNavItem = el.querySelector(
                ".swiper-pagination-bullet-active"
            );
            activeNavItem.style.animationPlayState = "paused";
        }
    },
    true
);

document.addEventListener(
    "mouseleave",
    (event) => {
        // console.log('mouseleave', swiper.activeIndex, swiper.slides[swiper.activeIndex].progress);
        // console.log('autoplay running', swiper.autoplay.running);
        const el = event.target;
        if (el && el.matches && el.matches(".swiper-container")) {
            el.swiper.autoplay.start();
            el.classList.remove("swiper-paused");

            const activeNavItem = el.querySelector(
                ".swiper-pagination-bullet-active"
            );

            activeNavItem.classList.remove("swiper-pagination-bullet-active");
            // activeNavItem.style.animation = 'none';

            setTimeout(() => {
                activeNavItem.classList.add("swiper-pagination-bullet-active");
                // activeNavItem.style.animation = '';
            }, 10);
        }
    },
    true
);

/* category slider 1 start ---------------------*/
$(document).ready(function () {
    $(".categorySlider").each(function () {
        const multiplier = {
            translate: 0.1,
            rotate: 0.01,
        };

        new Swiper(".categorySlider", {
            slidesPerView: 5,
            spaceBetween: 60,
            centeredSlides: true,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 3000, // 3 seconds delay
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                300: { slidesPerView: 1, spaceBetween: 10 },
                600: { slidesPerView: 2, spaceBetween: 30 },
                768: { slidesPerView: 3, spaceBetween: 30 },
                1024: { slidesPerView: 4, spaceBetween: 40 },
                1280: { slidesPerView: 5, spaceBetween: 60 },
            },
        });

        function calculateWheel() {
            const slides = document.querySelectorAll(".single");
            slides.forEach((slide, i) => {
                const rect = slide.getBoundingClientRect();
                const r = window.innerWidth * 0.5 - (rect.x + rect.width * 0.5);
                let ty =
                    Math.abs(r) * multiplier.translate -
                    rect.width * multiplier.translate;
                if (ty < 0) ty = 0;
                const transformOrigin = r < 0 ? "left top" : "right top";
                slide.style.transform = `translate(0, ${ty}px) rotate(${
                    -r * multiplier.rotate
                }deg)`;
                slide.style.transformOrigin = transformOrigin;
            });
        }

        function raf() {
            requestAnimationFrame(raf);
            calculateWheel();
        }

        raf();
    });
});
/* category slider 1 end ---------------------*/
