$(function () {
  "use strict";

  /* =========================================================
     HELPERS
     safe(): ek section fail ho to baaki sections chalte rahein
     ========================================================= */
  function safe(name, fn) {
    try {
      fn();
    } catch (err) {
      if (window.console && console.error) {
        console.error("[main.js] Section failed -> " + name, err);
      }
    }
  }

  function callIfExists(fnName) {
    var fn = window[fnName];
    if (typeof fn === "function") {
      var args = Array.prototype.slice.call(arguments, 1);
      return fn.apply(window, args);
    }
  }

  function swiperReady() {
    return typeof window.Swiper === "function";
  }

  function initSwiper(selector, options) {
    if (!swiperReady()) return null;
    if (!document.querySelector(selector)) return null;
    return new Swiper(selector, options);
  }

  function padNum(n) {
    return n < 10 ? "0" + n : "" + n;
  }

  function pad(n) {
    return n < 10 ? "0" + n : String(n);
  }

  /* =========================================================
     SHARED FUNCTIONS (multiple sections use these)
     ========================================================= */
  function closeModel() {
    $(".overlay, .model, .ham-pop").removeClass("is-open");
    $("body, html").removeClass("overflow-hidden");

    setTimeout(function () {
      $(".model, .ham-pop").removeClass("is-booking is-enquire");
    }, 500);
  }

  function scrollToHash(hash) {
    var headerHeight = parseInt($(":root").css("--headerheight")) || 0;
    var $target = $(hash);

    if (!$target.length) return;

    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $target.offset().top - headerHeight,
        },
        600
      );
  }

  function runCount($el) {
    var end = parseFloat($el.attr("data-num")) || 0;
    var icon = $el.attr("data-num-icon") || "";

    $({ n: 0 }).animate(
      { n: end },
      {
        duration: 2000,
        easing: "swing",
        step: function (now) {
          $el.text(Math.floor(now).toLocaleString("en-IN") + icon);
        },
        complete: function () {
          $el.text(end.toLocaleString("en-IN") + icon);
        },
      }
    );
  }

  function dealTick() {
    var now = Date.now();
    document.querySelectorAll(".deal-timer").forEach(function (timer) {
      var diff = Math.max(0, new Date(timer.dataset.end).getTime() - now);
      var vals = {
        days: Math.floor(diff / 86400000),
        hours: Math.floor((diff % 86400000) / 3600000),
        mins: Math.floor((diff % 3600000) / 60000),
        secs: Math.floor((diff % 60000) / 1000),
      };
      timer.querySelectorAll("[data-unit]").forEach(function (el) {
        el.textContent = pad(vals[el.dataset.unit]);
      });
    });
  }

  var $floatMenu = $(".float-menu");
  var $stickyBars = $(".cart-bar, .co-bar, .pay-bar");

  function toggleFloatMenu() {
    var scrolled = $(window).scrollTop() > 200;
    var popupOpen = $(".ham-pop").hasClass("is-open");
    var showMenu = scrolled && !popupOpen;
    $floatMenu.toggleClass("show", showMenu);
    $stickyBars.toggleClass("is-lifted", showMenu);
  }

  /* =========================================================
     1. HEADER FIXED ON SCROLL
     ========================================================= */
  safe("header-fixed", function () {
    if (!$("header").is(".header-fixed")) {
      $(window).on("scroll", function () {
        $(this).scrollTop() > 100
          ? $("header").addClass("header-fixed")
          : $("header").removeClass("header-fixed");
      });

      $(window).scrollTop() > 100
        ? $("header").addClass("header-fixed")
        : $("header").removeClass("header-fixed");
    }
  });

  /* =========================================================
     2. PHONE INPUT (intl-tel-input)
     ========================================================= */
  safe("phone-input", function () {
    if (typeof window.intlTelInput !== "function") return;

    var utils =
      "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js";

    $(".js-phone").each(function () {
      var input = this;
      var $in = $(input);
      var $form = $in.closest("form");

      if ($in.data("iti")) return;

      var iti = window.intlTelInput(input, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb", "ae", "ca", "au", "sg"],
        separateDialCode: true,
        autoPlaceholder: "off",
        useFullscreenPopup: false,
        utilsScript: utils,
      });

      $in.data("iti", iti);

      function sync() {
        var d = iti.getSelectedCountryData();
        $form.find('[name="country_code"]').val((d.iso2 || "").toUpperCase());
        $form.find('[name="dial_code"]').val("+" + (d.dialCode || ""));
      }

      input.addEventListener("countrychange", sync);
      sync();

      $form.on("submit", function () {
        sync();
        var full = iti.getNumber();
        if (!full) {
          full =
            "+" +
            iti.getSelectedCountryData().dialCode +
            $in.val().replace(/\D/g, "");
        }
        $form.find('[name="phone_full"]').val(full);
      });
    });
  });

  /* =========================================================
     3. FORM CONTROLS
     ========================================================= */
  safe("form-controls", function () {
    if (typeof window.handleForm !== "function") return;

    var formControls = $(".form-control");

    if (typeof window.throttle === "function") {
      formControls.on("focus input change blur", throttle(handleForm));
    } else {
      formControls.on("focus input change blur", handleForm);
    }

    formControls.each(function () {
      handleForm.call(this);
    });
  });

  /* =========================================================
     4. NICE SELECT
     ========================================================= */
  safe("nice-select", function () {
    if (typeof window.niceSelect === "function") {
      niceSelect($);
    }
    if ($.fn.niceSelect) {
      $("select").niceSelect();
    }
  });

  /* =========================================================
     5. DATA-ANIMATE
     ========================================================= */
  safe("handleAnimations", function () {
    callIfExists("handleAnimations");
  });

  /* =========================================================
     6. WHATSAPP URL
     ========================================================= */
  safe("whatsapp-urls", function () {
    callIfExists("adjustWhatsAppUrls");
    $(window).on("resize", function () {
      callIfExists("adjustWhatsAppUrls");
    });
  });

  /* =========================================================
     7. COUNT ANIMATION (external startCountAnimation)
     ========================================================= */
  safe("startCountAnimation", function () {
    callIfExists("startCountAnimation");
    $(window).on("scroll", function () {
      callIfExists("startCountAnimation");
    });
  });

  /* =========================================================
     8. TABS (.tab-nav)
     ========================================================= */
  safe("tab-nav", function () {
    $(".tab-nav li").on("click", function () {
      var tab = $(this).data("tab");
      var $nav = $(this).closest(".tab-nav");
      var $content = $nav.next(".tab-nav-content");
      var $target = $content.children('.tabs[data-tab="' + tab + '"]');

      $(this).addClass("active").siblings().removeClass("active");

      if ($target.length) {
        $target.addClass("active").siblings(".tabs").removeClass("active");
        $target.find(".swiper").each(function () {
          if (this.swiper) {
            this.swiper.update();
            this.swiper.slideTo(0, 0);
          }
        });
      } else {
        $content.children(".tabs").removeClass("active");
      }
    });
  });

  /* =========================================================
     9. DATA-SCROLLTO
     ========================================================= */
  safe("data-scrollTo", function () {
    $(document).on("click", "[data-scrollTo]", function () {
      var headerheight =
        (parseInt($(":root").css("--headerpadding")) || 0) +
        (parseInt($(":root").css("--headerfixed")) || 0);

      var section = $(this).attr("data-scrollTo");

      if (section && $(section).length) {
        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: $(section).offset().top - headerheight,
            },
            1000
          );
      }
    });
  });

  /* =========================================================
     10. MODEL OPEN / CLOSE
     ========================================================= */
  safe("model-open-close", function () {
    $(document).on("click", "[data-model]", function () {
      var model = $(this).attr("data-model");
      var type = $(this).attr("data-type");
      callIfExists("openModel", model, type);
    });

    $(document).on("click", ".overlay, .close", function () {
      closeModel();
    });
  });

  /* =========================================================
     11. SCROLL TO SECTION (hash)
     ========================================================= */
  safe("scroll-to-hash", function () {
    // On page load
    if (window.location.hash) {
      scrollToHash(window.location.hash);
    }

    // On hash change
    $(window).on("hashchange", function () {
      scrollToHash(window.location.hash);
      closeModel();
    });

    // For all internal anchor links
    $(document).on("click", 'a[href^="#"]', function (e) {
      var hash = $(this).attr("href");

      if (hash.length > 1 && $(hash).length) {
        e.preventDefault();

        history.pushState(null, null, hash);
        scrollToHash(hash);
        closeModel();
      }
    });
  });

  /* =========================================================
     12. HAM DROPDOWN
     ========================================================= */
  safe("ham-dropdown", function () {
    $(".hasDropdown").click(function (e) {
      e.stopPropagation(); // Prevents event bubbling

      var slideMenu = $(this).find(".dropdown-menu-ham");
      var plusIcon = $(this).find(".plu-ico");

      $(".dropdown-menu-ham").not(slideMenu).slideUp();
      $(".hasDropdown").not(this).removeClass("active");
      $(".plu-ico").not(plusIcon).removeClass("active");

      $(this).toggleClass("active");
      plusIcon.toggleClass("active");

      slideMenu.stop().slideToggle();
    });
  });

  /* =========================================================
     13. ACCORDION
     ========================================================= */
  safe("accordion", function () {
    $(".accordion-wrapper").each(function () {
      var $wrapper = $(this);

      $wrapper.find(".accordion-item").removeClass("active");
      $wrapper.find(".accordion-content").hide();
      $wrapper.find(".accordion-icon").text("+");

      var $firstItem = $wrapper.find(".accordion-item").first();
      $firstItem.addClass("active");
      $firstItem.find(".accordion-content").show();
      $firstItem.find(".accordion-icon").text("−");

      $wrapper.on("click", ".accordion-header", function () {
        var $item = $(this).closest(".accordion-item");
        var $content = $(this).siblings(".accordion-content");
        var isActive = $item.hasClass("active");

        $wrapper.find(".accordion-item").removeClass("active");
        $wrapper.find(".accordion-content").slideUp(300);
        $wrapper.find(".accordion-icon").text("+");

        if (!isActive) {
          $item.addClass("active");
          $content.slideDown(300);
          $item.find(".accordion-icon").text("−");
        }
      });
    });

    $(".expand-toggle input[type='checkbox']").on("change", function () {
      var $wrapper = $(this)
        .closest(".Itinerary, .listing-secI")
        .find(".accordion-wrapper");

      if ($(this).is(":checked")) {
        $wrapper.find(".accordion-item").addClass("active");
        $wrapper.find(".accordion-content").slideDown(300);
        $wrapper.find(".accordion-icon").text("−");
      } else {
        $wrapper.find(".accordion-item").removeClass("active");
        $wrapper.find(".accordion-content").slideUp(300);
        $wrapper.find(".accordion-icon").text("+");

        var $firstItem = $wrapper.find(".accordion-item").first();
        $firstItem.addClass("active");
        $firstItem.find(".accordion-content").show();
        $firstItem.find(".accordion-icon").text("−");
      }
    });
  });

  /* =========================================================
     14. VIDEO POPUP
     ========================================================= */
  safe("video-popup", function () {
    $("[data-video]").on("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      var src = $(this).attr("data-video");

      if (src.includes("youtube.com/embed/")) {
        var videoId = src.split("embed/")[1].split("?")[0];

        src +=
          (src.includes("?") ? "&" : "?") +
          "autoplay=1&loop=1&playlist=" +
          videoId;
      }

      $("#iframe1").attr("src", src);
      $(".video-pop").addClass("is-open");
      $("body, html").addClass("overflow-hidden");
    });

    // Close modal
    $(".video-pop .close, .video-pop .close-btn").on("click", function (e) {
      e.preventDefault();

      $(".video-pop").removeClass("is-open");
      $("#iframe1").attr("src", "");
      $("body, html").removeClass("overflow-hidden");
    });

    // Close when clicking the overlay
    $(".video-pop").on("click", function (e) {
      if ($(e.target).is(".video-pop")) {
        $(this).removeClass("is-open");
        $("#iframe1").attr("src", "");
        $("body, html").removeClass("overflow-hidden");
      }
    });

    // Stop video when pressing Escape
    $(document).on("keydown", function (e) {
      if (e.key === "Escape" && $(".video-pop").hasClass("is-open")) {
        $(".video-pop").removeClass("is-open");
        $("#iframe1").attr("src", "");
        $("body, html").removeClass("overflow-hidden");
      }
    });
  });

  /* =========================================================
     15. SWIPERS
     ========================================================= */

  // ============ HEADER ANNOUNCEMENT (vertical) ============
  safe("swiper-announcement", function () {
    initSwiper(".announcement-swiper", {
      slidesPerView: 1,
      loop: true,
      speed: 700,
      allowTouchMove: false,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  });

  // ============ HERO ============
 safe("swiper-hero", function () {
  var heroSwiper = initSwiper(".singleSlider", {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    speed: 1200,
    allowTouchMove: true,
    grabCursor: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    navigation: {
      nextEl: ".singleSlider-next",
      prevEl: ".singleSlider-prev",
    },
    pagination: {
      el: ".singleSlider .swiper-pagination",
      clickable: true,
    },
  });

  var mq = window.matchMedia("(max-width: 991px)");

  function toggleAutoplay() {
    if (!heroSwiper || !heroSwiper.autoplay) return;
    if (mq.matches) {
      heroSwiper.autoplay.start();
    } else {
      heroSwiper.autoplay.stop();
    }
  }

  toggleAutoplay();

  if (mq.addEventListener) {
    mq.addEventListener("change", toggleAutoplay);
  } else {
    mq.addListener(toggleAutoplay);
  }

  window.heroSwiper = heroSwiper;
});

  safe("swiper-offerSlider", function () {
    initSwiper(".home-secE .offerSlider", {
      slidesPerView: 1.3,
      spaceBetween: 12,
      speed: 700,
      grabCursor: true,
      navigation: {
        nextEl: ".home-secE .btn-next",
        prevEl: ".home-secE .btn-prev",
        disabledClass: "disabled",
      },
      breakpoints: {
        0: { slidesPerView: 2, spaceBetween: 14 },
        1280: { slidesPerView: 3, spaceBetween: 20 },
      },
    });
  });

  safe("swiper-gridSlider", function () {
    initSwiper(".home-secA .gridSlider", {
      slidesPerView: 2,
      spaceBetween: 16,
      grid: { rows: 2, fill: "row" },
      speed: 700,
      navigation: {
        nextEl: ".home-secA .btn-next",
        prevEl: ".home-secA .btn-prev",
      },
      breakpoints: {
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
      },
    });
  });

  safe("swiper-thirdSilder", function () {
    initSwiper(".thirdSilder", {
      navigation: {
        nextEl: ".thirdSilder-next",
        prevEl: ".thirdSilder-prev",
      },
      loop: true,
      speed: 1000,
      breakpoints: {
        0: {
          slidesPerView: 1.2,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 1.2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 2.2,
          spaceBetween: 20,
        },
        991: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
      },
    });
  });

  safe("swiper-twoSlider", function () {
    initSwiper(".twoSlider", {
      navigation: {
        nextEl: ".twoSlider-next",
        prevEl: ".twoSlider-prev",
      },
      speed: 1000,
      breakpoints: {
        0: {
          slidesPerView: 1.2,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 1.2,
          spaceBetween: 10,
        },
        1280: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
      },
    });
  });

  safe("swiper-fourSlider", function () {
    if (!swiperReady()) return;

    $(".fourSlider").each(function () {
      var $slider = $(this);
      var $wrap = $slider.closest(".swiper-wrap");
      var $foot = $wrap.siblings(".slider-foot");
      var $current = $foot.find(".sliderCurrent");
      var $total = $foot.find(".sliderTotal");
      var $progress = $foot.find(".sliderProgress");

      var mob = parseFloat($slider.attr("data-mob")) || 2;
      var sm = parseFloat($slider.attr("data-sm")) || 2;
      var lg = parseFloat($slider.attr("data-lg")) || 3;
      var xl = parseFloat($slider.attr("data-xl")) || 4;

      function updateCount(swiper) {
        if (!$current.length) return;
        $current.text(padNum(swiper.snapIndex + 1));
        $total.text(padNum(swiper.snapGrid.length));
      }

      new Swiper(this, {
        slidesPerView: mob,
        spaceBetween: 12,
        speed: 700,
        grabCursor: true,
        observer: true,
        observeParents: true,
        navigation: {
          prevEl: $wrap.find(".btn-prev")[0],
          nextEl: $wrap.find(".btn-next")[0],
          disabledClass: "disabled",
          lockClass: "swiper-button-lock",
        },
        pagination: $progress.length
          ? { el: $progress[0], type: "progressbar" }
          : false,
        breakpoints: {
          541: { slidesPerView: sm, spaceBetween: 18 },
          992: { slidesPerView: lg, spaceBetween: 22 },
          1200: { slidesPerView: xl, spaceBetween: 24 },
        },
        on: {
          init: function (swiper) {
            updateCount(swiper);
          },
          snapIndexChange: function (swiper) {
            updateCount(swiper);
          },
          breakpoint: function (swiper) {
            updateCount(swiper);
          },
          resize: function (swiper) {
            updateCount(swiper);
          },
        },
      });
    });
  });

  safe("swiper-centerSlider", function () {
    initSwiper(".centerSlider", {
      centeredSlides: true,
      centeredSlidesBounds: true,
      slidesOffsetAfter: 120,
      loop: true,
      navigation: {
        nextEl: ".centerSlider-next",
        prevEl: ".centerSlider-prev",
      },

      breakpoints: {
        0: {
          slidesPerView: 1.2,
          spaceBetween: 10,
          speed: 1000,
        },
        520: {
          slidesPerView: 1.2,
          spaceBetween: 10,
          speed: 1000,
        },
        769: {
          slidesPerView: 2.3,
          spaceBetween: 20,
          speed: 1000,
        },
        991: {
          slidesPerView: 2.3,
          spaceBetween: 60,
          speed: 1000,
        },
        1100: {
          slidesPerView: 2.3,
          spaceBetween: 60,
          speed: 1000,
        },
      },
    });
  });

  safe("swiper-cartRelatedSlider", function () {
    initSwiper(".cartRelatedSlider", {
      slidesPerView: 2,
      spaceBetween: 12,
      navigation: {
        nextEl: ".cart-secB .btn-next",
        prevEl: ".cart-secB .btn-prev",
        disabledClass: "disabled",
      },
      breakpoints: {
        769: { slidesPerView: 3, spaceBetween: 16 },
        1025: { slidesPerView: 4, spaceBetween: 24 },
      },
    });
  });

  safe("swiper-dealSlider", function () {
    var dealSwiper = initSwiper(".dealSlider", {
      fadeEffect: { crossFade: true },
      slidesPerView: 1,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".dealSlider-next",
        prevEl: ".dealSlider-prev",
      },
      pagination: {
        el: ".dealSlider .swiper-pagination",
        clickable: true,
      },
    });
    window.dealSwiper = dealSwiper;
  });

  /* =========================================================
     16. HOME TABS (secB, secC)
     ========================================================= */
  safe("home-secB-tabs", function () {
    $(".home-secB .tab-btn").on("click", function () {
      var target = $(this).data("tab");
      $(".home-secB .tab-btn").removeClass("active");
      $(this).addClass("active");
      $(".home-secB .tab-pane").removeClass("active");
      $(target).addClass("active");
    });
  });

  safe("home-secC-tabs", function () {
    $(".home-secC .tab-btn").on("click", function () {
      var target = $(this).data("tab");
      $(".home-secC .tab-btn").removeClass("active");
      $(this).addClass("active");
      $(".home-secC .tab-pane").removeClass("active");
      $(target).addClass("active");
    });
  });

  /* =========================================================
     17. FLOAT MENU
     ========================================================= */
  safe("float-menu", function () {
    $(window).on("scroll resize", toggleFloatMenu);

    $(document).on("click", "[data-model], .overlay, .close", function () {
      setTimeout(toggleFloatMenu, 50);
    });

    toggleFloatMenu();
  });

  /* =========================================================
     18. CART QTY
     ========================================================= */
  safe("cart-qty", function () {
    $(".cart-qty").on("click", ".qty-plus, .qty-minus", function () {
      var $i = $(this).siblings(".qty-input"),
        v = parseInt($i.val(), 10) || 1;
      $i.val(
        $(this).hasClass("qty-plus") ? Math.min(v + 1, 10) : Math.max(1, v - 1)
      );
    });
  });

  /* =========================================================
     19. SEARCH INPUT
     ========================================================= */
  safe("search-input", function () {
    $(".searchInput").on("input", function () {
      var val = $.trim($(this).val()).toLowerCase();
      var $box = $(this).closest(".formField").find(".search-results");

      if (!val) {
        $box.removeClass("show");
        return;
      }

      var found = 0;

      $box.find(".res-list li").each(function () {
        var match = String($(this).data("name")).indexOf(val) > -1;
        $(this).toggle(match);
        if (match) found++;
      });

      $box.find(".res-empty").toggle(found === 0);
      $box.find(".res-all").toggle(found > 0);
      $box.addClass("show");
    });
  });

  /* =========================================================
     20. PZ LOCATOR
     ========================================================= */
  safe("pz-locator", function () {
    document.querySelectorAll(".home-secP .pz-locator").forEach(function (box) {
      var items = box.querySelectorAll("[data-id]");

      function activate(id) {
        items.forEach(function (el) {
          el.classList.toggle("active", el.getAttribute("data-id") === id);
        });
      }

      box.addEventListener("click", function (e) {
        var t = e.target.closest(".pz-loc, .pz-pin");
        if (t) activate(t.getAttribute("data-id"));
      });
    });
  });

  /* =========================================================
     21. COUNT NUMBERS (IntersectionObserver)
     ========================================================= */
  safe("countNum", function () {
    if ("IntersectionObserver" in window) {
      var countObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              runCount($(entry.target));
              countObserver.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.5 }
      );

      $(".countNum").each(function () {
        countObserver.observe(this);
      });
    } else {
      $(".countNum").each(function () {
        runCount($(this));
      });
    }
  });

  /* =========================================================
     22. GLIGHTBOX
     ========================================================= */
  safe("glightbox", function () {
    if (typeof window.GLightbox !== "function") return;

    GLightbox({
      selector: ".glightbox",
      touchNavigation: true,
      loop: true,
      zoomable: true,
    });
  });

  /* =========================================================
     23. HAM MENU (stack navigation)
     ========================================================= */
  safe("ham-menu-stack", function () {
    var stack = ["main"];

    function getPop() {
      return $(".ham-pop");
    }

    function getView(id) {
      return getPop().find('.ham-view[data-ham-view="' + id + '"]');
    }

    function renderHam() {
      var $back = getPop().find("[data-ham-back]");
      var current = stack[stack.length - 1];

      getPop()
        .find(".ham-view")
        .each(function () {
          var id = $(this).attr("data-ham-view");
          $(this)
            .toggleClass("is-active", id === current)
            .toggleClass("is-behind", id !== current && stack.indexOf(id) > -1)
            .attr("aria-hidden", String(id !== current));
        });

      $back.toggleClass("is-visible", stack.length > 1);
      if (stack.length > 1) {
        $back
          .find("span")
          .text(
            "Back to " +
              (getView(stack[stack.length - 2]).attr("data-ham-title") || "Menu")
          );
      }
    }

    $(document).on("click", ".ham-pop [data-ham-open]", function (e) {
      e.preventDefault();
      var id = $(this).attr("data-ham-open");
      if (!getView(id).length) return;
      stack.push(id);
      getView(id).scrollTop(0);
      renderHam();
    });

    $(document).on("click", ".ham-pop [data-ham-back]", function (e) {
      e.preventDefault();
      if (stack.length > 1) {
        stack.pop();
        renderHam();
      }
    });
  });

  /* =========================================================
     24. OFFER POPUP (sirf home page)
     ========================================================= */
  safe("offer-popup", function () {
    var $pop = $(".offer-pop");
    var $overlay = $(".overlay");
    var KEY = "archanaOfferClosed";

    if (!$pop.length) return;

    // sirf home page
    var path = window.location.pathname.toLowerCase();
    var last = path.split("/").pop();
    var isHome = last === "" || last === "index.html" || last === "index";
    if (!isHome) return;

    // purani localStorage wali key hata do (ab sessionStorage use hota hai)
    try {
      localStorage.removeItem(KEY);
    } catch (e) {}

    // isi tab me pehle close ho chuka hai (refresh) to kholo hi mat
    try {
      if (sessionStorage.getItem(KEY)) return;
    } catch (e) {}

    function openPop() {
      $pop.addClass("is-open");
      $overlay.addClass("is-open");
    }

    function closePop() {
      $pop.removeClass("is-open");
      $overlay.removeClass("is-open");
      try {
        sessionStorage.setItem(KEY, "1");
      } catch (e) {}
    }

    // open: page load hote hi
    if (document.readyState === "complete") {
      openPop();
    } else {
      $(window).on("load", openPop);
    }

    // close: button, pop ke andar ke links
    $pop.on("click", ".close, .op-btns a", closePop);

    // close: bahar click (overlay ya page pe kahin bhi)
    $(document).on("mousedown", function (e) {
      if (
        $pop.hasClass("is-open") &&
        !$(e.target).closest(".offer-pop .model-body").length
      ) {
        closePop();
      }
    });

    // close: Esc
    $(document).on("keydown", function (e) {
      if (e.key === "Escape" && $pop.hasClass("is-open")) {
        closePop();
      }
    });
  });

  /* =========================================================
     25. TOAST  (window.showToast is global, call it anytime)
     ========================================================= */
  safe("toast", function () {
    var duration = 3000;

    var types = {
      success: { color: "#218641", icon: "fa-circle-check" },
      error: { color: "#d93025", icon: "fa-circle-xmark" },
      warning: { color: "#b7791f", icon: "fa-triangle-exclamation" },
      info: { color: "#2563eb", icon: "fa-circle-info" },
    };

    function removeToast($toast) {
      $toast.removeClass("is-show");
      setTimeout(function () {
        $toast.remove();
      }, 350);
    }

    function showToast(title, text, type, color) {
      var preset = types[type] || types.info;
      var $toast = $('<div class="toast" role="status"></div>');
      var $body = $('<div class="toast-body"></div>');
      var $toaster = $("#toaster");

      // agar page pe #toaster div nahi hai to khud bana lo
      if (!$toaster.length) {
        $toaster = $('<div class="toaster" id="toaster"></div>').appendTo("body");
      }

      $toast[0].style.setProperty("--toast-color", color || preset.color);
      $toast[0].style.setProperty("--toast-time", duration + "ms");

      if (title) {
        $body.append($('<strong class="toast-title"></strong>').text(title));
      }
      if (text) {
        $body.append($('<span class="toast-text"></span>').text(text));
      }

      $toast.append(
        $('<span class="toast-icon"></span>').append(
          $('<i class="fa-solid" aria-hidden="true"></i>').addClass(preset.icon)
        )
      );
      $toast.append($body);
      $toast.append(
        '<button type="button" class="toast-close" aria-label="Close"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>'
      );

      $toaster.append($toast);

      setTimeout(function () {
        $toast.addClass("is-show");
      }, 10);

      setTimeout(function () {
        removeToast($toast);
      }, duration);
    }

    // global: backend developer kahin se bhi call kar sakta hai
    window.showToast = showToast;

    // data attributes wale buttons / links
    $(document).on("click", "[data-toast-title], [data-toast-text]", function () {
      var $el = $(this);
      showToast(
        $el.attr("data-toast-title"),
        $el.attr("data-toast-text") || $el.attr("data-name"),
        $el.attr("data-toast-type"),
        $el.attr("data-toast-color")
      );
    });

    // toast close button
    $(document).on("click", ".toast-close", function () {
      removeToast($(this).closest(".toast"));
    });
  });

  /* =========================================================
     26. HEADER BAR CLOSE
     ========================================================= */
  safe("bar-close", function () {
    $(".bar-close").on("click", function () {
      $("header").addClass("bar-closed");
    });
  });

  /* =========================================================
     27. SIGNATURE SECTION REVEAL (home-secB)
     ========================================================= */
  safe("signature-reveal", function () {
    var signature = document.querySelector(".home-secB");

    if (signature && "IntersectionObserver" in window) {
      var revealObserver = new IntersectionObserver(
        function (entries, observer) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("in-view");
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.25 }
      );

      revealObserver.observe(signature);
    } else if (signature) {
      signature.classList.add("in-view");
    }
  });

  /* =========================================================
     28. OCCASION CARDS (home-secE)
     ========================================================= */
  safe("occ-cards", function () {
    var $cards = $(".home-secE .occ-card");
    var mq = window.matchMedia("(max-width: 991px)");

    $cards.on("click", function (e) {
      if (mq.matches) return; // grid mode: normal link

      var $this = $(this);
      if (!$this.hasClass("is-active")) {
        e.preventDefault(); // pehle sirf expand
        $cards.removeClass("is-active");
        $this.addClass("is-active");
      }
      // already open hai to link normal open hoga
    });
  });

  /* =========================================================
     29. DEAL TIMER
     ========================================================= */
  safe("deal-timer", function () {
    dealTick();
    setInterval(dealTick, 1000);
  });

  /* =========================================================
     30. SPOTLIGHT THUMBS (home-secG)
     ========================================================= */
  safe("spot-thumbs", function () {
    $(".home-secG .spot-thumbs button").on("click", function () {
      var $btn = $(this);
      if ($btn.hasClass("active")) return;

      var src = $btn.data("src");
      var name = $btn.data("name");
      var $img = $("#spotMain");

      $(".home-secG .spot-thumbs button").removeClass("active");
      $btn.addClass("active");

      $img.addClass("is-changing");
      setTimeout(function () {
        $img.attr({ src: src, alt: name }).removeClass("is-changing");
        $("#spotName").text(name);
      }, 250);
    });
  });
});


$(document).on('click', '.wish-btn', function (e) {
  e.preventDefault()
  var $btn = $(this).toggleClass('active')
  $btn.find('i').toggleClass('fa-regular fa-solid')
  $btn.attr('aria-pressed', $btn.hasClass('active'))
})

// ---------- AFFILIATE SLIDER (2 rows, 4 per view on desktop) ----------
document.querySelectorAll(".affpSlider").forEach(function (el) {
  var wrap = el.closest(".swiper-wrap");
  new Swiper(el, {
    slidesPerView: 1.1,
    spaceBetween: 12,
    speed: 800,
    grid: { rows: 2, fill: "row" },
    watchOverflow: true,
    navigation: {
      prevEl: wrap.querySelector(".btn-prev"),
      nextEl: wrap.querySelector(".btn-next"),
      disabledClass: "disabled",
      lockClass: "swiper-button-lock",
    },
    breakpoints: {
      576: { slidesPerView: 2, spaceBetween: 12, grid: { rows: 2, fill: "row" } },
      992: { slidesPerView: 3, spaceBetween: 12, grid: { rows: 2, fill: "row" } },
      1200: { slidesPerView: 4, spaceBetween: 12, grid: { rows: 2, fill: "row" } },
    },
  });
});

// ---------- COPY LINK ON BUTTON CLICK ----------
document.addEventListener("click", function (e) {
  var btn = e.target.closest(".affp-copy");
  if (!btn) return;

  var link = btn.dataset.link;
  var icon = btn.querySelector("i");

  var done = function () {
    btn.classList.add("copied");
    icon.className = "fa-solid fa-check";
    setTimeout(function () {
      btn.classList.remove("copied");
      icon.className = "fa-solid fa-link";
    }, 1500);
  };

  if (navigator.clipboard) {
    navigator.clipboard.writeText(link).then(done);
  } else {
    var t = document.createElement("textarea");
    t.value = link;
    document.body.appendChild(t);
    t.select();
    document.execCommand("copy");
    t.remove();
    done();
  }
});