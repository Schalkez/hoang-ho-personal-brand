$(document).ready(function () {
	var speed = 1000;
	// fullpage
	{
		AOS.init({
			duration: 800,
			once: true,
		});

		setTimeout(function () {
			AOS.init({
				duration: 800,
				once: true,
			});
		}, 300);
	}
	{
		var fullpage;
		if ($(".fullpage-container").length > 0) {
			function setSlider() {
				fullpage = new Swiper(".fullpage-container", {
					hashNavigation: true,
					direction: "vertical",
					effect: "slide",
					speed: 600,
					slidesPerView: "auto",
					autoHeight: true,
					spaceBetween: 0,
					mousewheel: false,
					keyboard: {
						enabled: true,
						onlyInViewport: true,
					},
					pagination: {
						el: ".fullpage-pagination",
						clickable: true,
					},
					on: {
						slideChangeTransitionStart: function () {
							setTimeout(function () {
								$(".fullpage-wrapper > .swiper-slide-active .aos-init").addClass("aos-animate");
							}, 300);
							autoTheme();
							if ($(".swiper-slide video").length) $(".swiper-slide video")[0].pause();
						},
						init: function () {
							setTimeout(() => {
								$(".fullpage-container .aos-init").removeClass("aos-animate");
								$(".fullpage-wrapper > .swiper-slide-active .aos-init").addClass("aos-animate");
							}, 200);
						},
					},
					simulateTouch: false,
					lazy: true,
					preloadImages: false,
				});
			}
			var sleeping = false;
			var indicator = new WheelIndicator({
				elem: document.querySelector(".fullpage-container"),
				callback: function (e) {
					if (sleeping) return;
					if (!fullpage) return;
					sleeping = true;
					setTimeout(() => {
						sleeping = false;
					}, 400);
					if (e.direction == "up") fullpage.slidePrev();
					else fullpage.slideNext();
				},
			});
			function deleteSlider() {
				if (fullpage) {
					fullpage.destroy();
					fullpage = false;
				}
			}
			if ($(window).width() > 991) setSlider();
			else deleteSlider();
			$(window).resize(function () {
				if ($(window).width() > 991) setSlider();
				else deleteSlider();
			});
		}
		$("section").each(function () {
			var $section = $(this);
			$(this)
				.find(".mouse-scroll")
				.click(function () {
					if (fullpage) fullpage.slideNext();
					if (!fullpage && $section.next().length) $("html, body").animate({ scrollTop: $section.next().offset().top }, 600);
				});
		});
		function autoTheme() {
			if (fullpage) {
				// get slide active
				var theme = $(fullpage.slides[fullpage.realIndex]).data("toggle-theme");
				if (theme != null) {
					$("[data-auto-theme]").attr("data-auto-theme", theme);
					$(".nav-header").attr("data-nav", theme);
				}
			} else {
				var $toggleTheme = $("[data-toggle-theme]");
				$("[data-auto-theme]").each(function () {
					var $autoTheme = $(this);
					var top = $autoTheme.offset().top;
					var left = $autoTheme.offset().left;
					var width = $autoTheme.outerWidth();
					var height = $autoTheme.outerHeight();
					var topCenter = top + height / 2;
					var leftCenter = left + width / 2;
					$toggleTheme.each(function () {
						var theme = $(this).data("toggle-theme");
						var top = $(this).offset().top;
						var left = $(this).offset().left;
						var width = $(this).outerWidth();
						var height = $(this).outerHeight();
						var right = left + width;
						var bottom = top + height;
						if (top <= topCenter && bottom >= topCenter && left <= leftCenter && right >= leftCenter) {
							$autoTheme.attr("data-auto-theme", theme);
							if ($autoTheme.hasClass("logo-container")) $(".nav-header").attr("data-nav", theme);
						}
					});
				});
			}
		}
		autoTheme();
		$(window).resize(autoTheme);
		$(window).scroll(autoTheme);
	}
	{
		$(".main-menu > .item.has-dropdown:not(.show) .sub-menu").stop().slideUp();
		$(".main-menu > .item.has-dropdown").each(function () {
			var $container = $(this);
			$container.children(".item-link").click(function () {
				var isShow = !$container.hasClass("show");
				$(".main-menu > .item.has-dropdown").removeClass("show");
				$(".main-menu > .item.has-dropdown .sub-menu").stop().slideUp();
				if (isShow) $container.addClass("show").find(".sub-menu").stop().slideDown();
				return false;
			});
		});
		$(".toggle-menu").click(function () {
			$(".overlay-menu").toggleClass("open");
			$(".nav-header").toggleClass("open");
		});
	}
	{
		$(".banner-slider").each(function () {
			var $slider = $(this);
			var delay = $(this).data("time") ? $(this).data("time") : 7000;
			var swiper = new Swiper($slider, {
				effect: "fade",
				loop: true,
				speed: 600,
				autoplay: {
					delay: delay,
				},
				pagination: {
					el: $slider.find(".swiper-pagination"),
					clickable: true,
				},
			});
		});
	}
	{
		$(".project-slider").each(function () {
			new Swiper(this, {
				slidesPerView: 2,
				spaceBetween: 15,
				loop: true,
				pagination: {
					el: $(this).find(".swiper-pagination"),
					clickable: true,
				},
				navigation: {
					nextEl: $(this).find(".slide-next"),
					prevEl: $(this).find(".slide-prev"),
				},
				breakpoints: {
					768: {
						slidesPerView: 4,
						spaceBetween: 22,
					},
					576: {
						slidesPerView: 3,
						spaceBetween: 15,
					},
				},
			});
		});
	}
	{
		var breakpoints = {
			xs: 320,
			sm: 576,
			md: 768,
			lg: 992,
			xl: 1200,
		};
		var $separate = $(".separate");
		$separate.each(function (index, el) {
			var $sep = $(this);
			var data = $sep.data();
			data.sm = data.sm ? data.sm : data.xs;
			data.md = data.md ? data.md : data.sm;
			data.lg = data.lg ? data.lg : data.md;
			data.xl = data.xl ? data.xl : data.lg;
			function setPadding() {
				var windowWidth = $(window).width();
				if (windowWidth >= breakpoints.xs) $sep.css("padding-top", data.xs ? data.xs : "");
				if (windowWidth >= breakpoints.sm) $sep.css("padding-top", data.sm ? data.sm : "");
				if (windowWidth >= breakpoints.md) $sep.css("padding-top", data.md ? data.md : "");
				if (windowWidth >= breakpoints.lg) $sep.css("padding-top", data.lg ? data.lg : "");
				if (windowWidth >= breakpoints.xl) $sep.css("padding-top", data.xl ? data.xl : "");
			}
			setPadding();
			$(window).on("resize", setPadding);
		});
	}
	{
		var $milestones = $(".milestones");
		$milestones.each(function () {
			var $this = $(this);
			var number = $this.data("show") ? parseInt($this.data("show")) : 3;
			var height = 0;
			var totalHeight = 0;
			function findHeight() {
				height = 0;
				totalHeight = 0;
				$($this[0])
					.find(".milestone")
					.each(function (index, el) {
						if (index <= number - 1) height += $(this).outerHeight(true);
						totalHeight += $(this).outerHeight(true);
					});
				if ($(window).width() >= 767) $this.css("height", height);
				else $this.css("height", "auto");
			}
			findHeight();
			$(window).on("resize", findHeight);
			$("#milestones-tab").on("shown.bs.tab", findHeight);
			$(".milestone-more-btn").click(function () {
				findHeight();
				if (!$this.hasClass("active")) {
					$this.addClass("active");
					$this.css("height", totalHeight);
					$(this).addClass("active");
				} else {
					$this.removeClass("active");
					$this.css("height", height);
					$(this).removeClass("active");
				}
			});
			if ($(window).width() < 768) {
				$this.find(".milestone-break").click(function () {
					var $break = $(this);
					$($break.parent()).siblings().find(".milestone-btn").removeClass("active");
					$break.find(".milestone-btn").toggleClass("active");
					$($break.parent()).siblings().find(".milestone-content").slideUp(300).removeClass("active");
					$break.parent().find(".milestone-content").slideToggle(300).toggleClass("active");
					findHeight();
				});
			}
		});
	}
	{
		var $awards = $(".awards");
		$awards.each(function () {
			var $this = $(this);
			var $award = $this.find(".awards-container");
			var $awards_select = $this.find("#awards-select");

			var options = {
				thumbs: {
					swiper: {
						el: $this.find(".awards-thumb-container"),
						slidesPerView: 5,
						spaceBetween: 70,
						slideToClickedSlide: true,
						breakpoints: {
							320: {
								slidesPerView: 4,
								spaceBetween: 20,
							},
							575: {
								slidesPerView: 5,
								spaceBetween: 50,
							},
						},
					},
				},
				effect: "fade",
				fadeEffect: {
					crossFade: true,
				},
				navigation: {
					prevEl: $this.find(".swiper-prev"),
					nextEl: $this.find(".swiper-next"),
				},
			};
			var award = new Swiper($award, options);

			$awards_select.on("change", function () {
				var filter = $(this).val();
				if (filter == "*") {
					$this.find("[data-filter]").removeClass("non-swiper-slide").addClass("swiper-slide").attr("style", null).show();
				} else {
					$(".swiper-slide")
						.not("[data-filter='" + filter + "']")
						.addClass("non-swiper-slide")
						.removeClass("swiper-slide")
						.hide();
					$("[data-filter='" + filter + "']")
						.removeClass("non-swiper-slide")
						.addClass("swiper-slide")
						.attr("style", null)
						.show();
				}
				award.destroy();
				award = new Swiper($award, options);
				award.thumbs.swiper.slides.each(function (index, el) {
					$(el).click(function () {
						award.slideTo(index);
					});
				});
			});
			$("#awards-tab").on("shown.bs.tab", function () {
				var $awardContent = $("#" + $(this).attr("aria-controls"));
				if ($awardContent.find(".awards-thumb-container")[0].swiper) $awardContent.find(".awards-thumb-container")[0].swiper.update();
				if ($awardContent.find(".awards-container")[0].swiper) $awardContent.find(".awards-container")[0].swiper.update();
			});
		});
	}
	{
		var $articles_container = $(".articles-container");
		$articles_container.each(function () {
			var $this = $(this);
			var articles_swiper = new Swiper($this, {
				breakpoints: {
					320: {
						slidesPerView: 1,
						spaceBetween: 15,
					},
					767: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
				},
				pagination: {
					el: $this.find(".swiper-pagination"),
					clickable: true,
					dynamicBullets: true,
				},
			});
			$(window).on("resize", function () {
				articles_swiper.update();
			});
		});
	}
	$(".member-item[data-fancybox]").fancybox({
		touch: false,
		afterShow: function (instance, current) {
			var $parent = current.$content.parent();
			var offsetTop = $parent.find(".image-container").height();
			var offsetHeader = $parent.find(".member-detail-header").outerHeight();
			$parent.on("scroll", function () {
				var scrollTop = $(this).scrollTop();
				if (scrollTop >= offsetTop - offsetHeader) {
					$(this).find(".member-detail-header").addClass("active");
				} else {
					$(this).find(".member-detail-header").removeClass("active");
				}
			});
		},
	});
	$(".filter").each(function () {
		var $this = $(this);
		var $btn_show = $(this).find(".btn-show-filter");
		$btn_show.click(function () {
			$this.toggleClass("active");
		});
		$(window).on("click", function (e) {
			var target = e.target;
			if ((!$(target).closest(".filter").length && $this.hasClass("active")) || $(target).hasClass("btn-show-filter")) {
				$this.removeClass("active");
			}
			return;
		});
	});
	// projects filter;
	{
		var $projects_filter = $(".projects-filter");
		$projects_filter.each(function () {
			var $this = $(this);
			var $projects = $this.find(".projects");
			var $projects_more = $this.find(".projects-more-btn");
			var $grid = $this.find(".projects");
			var $gridSelect = $this.find(".grid-select");
			if ($(window).width() < 768) $grid.attr("data-grid-layout", $grid.data("grid-layout-mobile"));
			$gridSelect.click(function () {
				$gridSelect.removeClass("active");
				$(this).addClass("active");
				$grid.attr("data-grid-layout", $(this).data("grid-value"));
			});

			$this.find("#status").on("change", start_project);
			$this.find("#location").on("change", start_project);
			$projects_more.click(function () {
				start = paged++;
				end = start + posts_per_page;
				get_project(start, end);
			});

			function start_project() {
				paged = 1;
				get_project();
			}

			function get_project(start = 0, end = posts_per_page) {
				var status = $this.find("#status").val();
				var location = $this.find("#location").val();
				get_project_loading();
				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: {
						action: "get_project",
						status: status,
						location: location,
					},
					dataType: "JSON",
					success: function (response) {
						setTimeout(function () {
							render_project(response, start, end);
							get_project_loading();
						}, 400);
					},
				});
			}

			get_project();

			function get_project_loading() {
				$this.toggleClass("loading");
			}

			function render_project(data, start = 0, end = posts_per_page) {
				var html = [];
				if (data.length) {
					if (start == 0) $projects.html("");
					if (data.length < end) end = data.length;
					for (i = start; i < end; i++) {
						html.push($('<li class="project">' + data[i].html + "</li>"));
					}
					if (typeof data[end] === "undefined") $projects_more.hide();
					else $projects_more.show();
					$projects.append(html);
				} else {
					$projects.html('<h3 class="projects-not-found">Not Found Projects</h3>');
					$projects_more.hide();
				}
			}
		});
	}

	$(".page-feature-slides").each(function () {
		var $this = $(this);
		new Swiper($this, {
			speed: 1000,
			effect: "fade",
			fadeEffect: {
				crossFade: true,
			},
			pagination: {
				el: $this.find(".swiper-pagination"),
				clickable: true,
			},
		});
	});

	$(".around-project").each(function () {
		var isFull = $(this).hasClass("around-project-full");
		var $this = $(this);
		var around_project = new Swiper($this.find(".around-slides"), {
			spaceBetween: 20,
			slidesPerView: isFull ? 1 : "auto",
			loop: true,
			centeredSlides: true,
			slideToClickedSlide: true,
			pagination: {
				el: $this.find(".around-pagination"),
				type: "fraction",
			},
			navigation: {
				prevEl: $this.find(".around-prev"),
				nextEl: $this.find(".around-next"),
			},
			thumbs: {
				swiper: {
					el: $this.find(".around-slides-thumb"),
					effect: "fade",
					fadeEffect: {
						crossFade: true,
					},
					simulateTouch: false,
				},
			},
		});
	});
	{
		var $data_collapse = $("[data-collapse]");
		$data_collapse.each(function (index, el) {
			var $this = $(this);

			var collapse = parseInt($this.data("collapse"));
			var collapsedTxt = $this.data("msg-collapsed");
			var expandedTxt = $this.data("msg-expanded");

			var $target = $this.find($this.data("target"));
			var $targetItem = $this.find($this.data("target-item"));

			if ($target.length && $targetItem.length && collapse < $targetItem.length) {
				var $button = $("<a></a>");
				$button.addClass("btn-data-collapse").text(collapsedTxt).attr("href", "#showmore").css("transition", ".4s all ease");
				$target.parent().append($button);

				var heightCollapsed = 0;
				var heightTotal = 0;
				function setHeight() {
					heightCollapsed = 0;
					heightTotal = 0;
					$this.find($this.data("target-item")).each(function (index, el) {
						if (index <= collapse - 1) heightCollapsed += $(this).outerHeight(true);
						heightTotal += $(this).outerHeight(true);
					});
					$target.css({
						overflow: "hidden",
						transition: "0.4s all ease",
						height: heightCollapsed,
					});
				}
				setHeight();
				$(window).resize(function () {
					setTimeout(setHeight, 400);
				});
				$button.click(function () {
					if ($target.hasClass("show")) {
						$(this).text(collapsedTxt).removeClass("active");
						$target.css("height", heightCollapsed).removeClass("show");
						return false;
					}
					$(this).text(expandedTxt).addClass("active");
					$target.css("height", heightTotal).addClass("show");
				});
			}
		});
	}
	{
		var $project_gallery = $(".project-gallery");
		$project_gallery.each(function (index, el) {
			var $gallery = $(this).find(".gallery-container");
			$gallery.each(function () {
				var $this = $(this);
				new Swiper($this, {
					speed: speed,
					loop: true,
					slidesPerView: "auto",
					spaceBetween: 20,
					slideToClickedSlide: true,
					pagination: {
						el: $this.find(".swiper-paginations"),
						type: "fraction",
					},
					navigation: {
						prevEl: $this.find(".swiper-prev"),
						nextEl: $this.find(".swiper-next"),
					},
					scrollbar: {
						el: $this.find(".swiper-scrollbar"),
						hide: false,
						draggable: true,
					},
				});
			});
			var $gallery_tab = $(this).find("[data-toggle]");
			$gallery_tab.on("shown.bs.tab", function (e) {
				var $tab_pane = $("#" + $(e.currentTarget).attr("aria-controls"));
				if ($tab_pane.length) {
					var $gallery = $tab_pane.find(".gallery-container");
					if ($gallery.length) $gallery[0].swiper.update();
				}
			});
		});
	}
	$(".project-related-slides").each(function (index, el) {
		var $this = $(this);
		new Swiper($this, {
			spaceBetween: 20,
			slidesPerView: "auto",
			pagination: {
				el: $this.find(".swiper-paginations"),
				clickable: true,
			},
			navigation: {
				prevEl: $this.find(".swiper-prev"),
				nextEl: $this.find(".swiper-next"),
			},
			scrollbar: {
				el: $this.find(".swiper-scrollbar"),
				hide: false,
				draggable: true,
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 20,
				},
				767: {
					slidesPerView: "auto",
					spaceBetween: 20,
				},
			},
		});
	});
	{
		if ($(".article-col").length)
			$(".article-col").matchHeight({
				property: "height",
			});

		$(".form-search").each(function (index, el) {
			var $this = $(this);
			var $search_show = $this.find(".search-btn");
			$search_show.click(function () {
				if ($this.find(".input-text").length) {
					$this.find(".input-text")[0].focus();

					console.log($this.find(".input-text"));
				}
				$(this).toggleClass("active");
				$this.toggleClass("active");
			});
			$(window).click(function (e) {
				var target = e.target;
				if ((!$(target).closest(".form-search").length && $this.hasClass("active")) || $(target).hasClass("form-search")) {
					$this.removeClass("active");
					$this.find(".news-category").removeClass("active");
				}
				return;
			});
		});
	}
	{
		$("#slidebox")
			.find(".close-btn")
			.click(function () {
				$("#slidebox").removeClass("open");
			});
		$("body").on("click", "[data-slidebox]", function () {
			var el_clicked = this;
			var $slidebox = $("#slidebox");

			var slidebox = $(el_clicked).data("slidebox");
			var currentIndex = 0;
			// Render new slider
			var $sliderContainer = $(
				'<div class="slider-container">\
					<div class="swiper-container">\
						<div class="swiper-wrapper">\
						</div>\
					</div>\
					<div class="controls">\
						<div class="control-prev"><i class="mdi mdi-chevron-left icon"></i></div>\
						<div class="control-pagination"></div>\
						<div class="control-next"><i class="mdi mdi-chevron-right icon"></i></div>\
					</div>\
				</div>'
			);
			var $slider = $sliderContainer.find(".swiper-container");
			// Get all slidebox
			$("[data-slidebox='" + slidebox + "']").each(function (index) {
				var image = $(this).attr("href");
				if (el_clicked == this) currentIndex = index;
				$slider.find(".swiper-wrapper").append('\
					<div class="swiper-slide">\
						<img src="' + image + '" alt="" />\
					</div>\
				');
			});
			// Destroy old slider
			$slidebox.find(".slidebox-body").html($sliderContainer);
			$slidebox.addClass("open");

			// Biến
			var $pagination = $sliderContainer.find(".control-pagination");
			var $prev = $sliderContainer.find(".control-prev");
			var $next = $sliderContainer.find(".control-next");

			new Swiper($slider, {
				loop: true,
				slidesPerView: "auto",
				spaceBetween: 8,
				centeredSlides: true,
				slideToClickedSlide: true,
				pagination: {
					el: $pagination,
					type: "fraction",
				},
				navigation: {
					nextEl: $next,
					prevEl: $prev,
				},
				initialSlide: currentIndex,
				breakpoints: {
					768: {
						spaceBetween: 20,
					},
				},
			});

			return false;
		});
	}
	{
		$(".section-gallery-top .search-form .close-btn").click(function () {
			$(".section-gallery-top .search-form input").val("");
			$(".section-gallery-top .search-form input").blur();
		});
	}
	{
		$(".section-gallery-content .tabs-group .tab input").change(function () {
			var href = $(".section-gallery-content .tabs-group .tab input:checked").val();
			if (href) window.location.href = href;
		});
	}
	{
		var downloadBrochure = false;
		var brochure = false;
		$(".project-brochure-download").click(function () {
			brochure = $(this).data("src");
			$(".popup-brochure").addClass("open");
			return false;
		});
		$(".popup-brochure .toggle-popup").click(function () {
			$(".popup-brochure").toggleClass("open");
			return false;
		});
		$(".scroll-to-section").click(function () {
			downloadBrochure = brochure;
			$("html, body")
				.stop()
				.animate({ scrollTop: $($(this).attr("href")).offset().top - $(".nav-header").height() }, 500);
		});
		document.addEventListener(
			"wpcf7mailsent",
			function (event) {
				if (!downloadBrochure) return;
				var ext = downloadBrochure.split(".");
				ext = ext[ext.length - 1];
				var $link = $("<a>");
				$link.attr("download", "Brochure." + ext);
				$link.attr("href", downloadBrochure);
				$link[0].click();
			},
			false
		);
	}
	{
		$(".career-form-link").click(function () {
			var href = $(this).attr("href");
			if ($(href).length) $("body, html").animate({ scrollTop: $(href).offset().top - $("header").outerHeight() }, 1000);
		});
	}
	{
		$(".play-video").click(function () {
			var $this = $(this);
			$this.next()[0].play();
			$this.next().addClass("active");
		});
	}
	{
		$(".articles-more-btn").click(function () {
			var $this = $(this);
			$this.parent().addClass("loading");
			if (the_next.length) {
				if ($(".articles").length) {
					render_articles(the_next);
				}
			}
			function render_articles(the_next) {
				paged++;
				var start = paged * posts_per_page - posts_per_page;
				var end = start + posts_per_page;
				if (end > the_next.length) end = the_next.length;
				for (i = start; i < end; i++) {
					$(".articles").append(the_next[i]);
					if (typeof the_next[i + 1] == "undefined") $this.parent().hide();
					else $this.parent().show();
				}
				setTimeout(function () {
					$this.parent().removeClass("loading");
				}, 400);
				AOS.init();
			}
		});
	}

	{
		$(".career-filter .dropdown-item").click(function () {
			var activeText = $(this).find("span:last-child").text();
			if ($(".career-filter .dropdown-toggle").length) $(".career-filter .dropdown-toggle").text(activeText);
		});
	}
	{
		$(".input-group-file").each(function () {
			var $value = $(this).find(".input-text");
			var $file = $(this).find("[type='file']");
			$file.change(function () {
				var name = $file.val().split("\\");
				name = name.length ? name : [""];
				$value.text(name[name.length - 1]);
			});
		});
	}
	{
		$(window).scroll(function() {
			if ($(window).scrollTop() > 10) {
				if (!$("#header").hasClass("sticky")) $("#header").addClass("sticky");
			} else {
				if ($("#header").hasClass("sticky")) $("#header").removeClass("sticky");
			}
		})
	}
	{
		function autoScroll() {
			if ($(window).scrollTop() >100) {
				if (!$(".nice-feature .mouse-scroll").hasClass("hide")) $(".nice-feature .mouse-scroll").addClass("hide");
			} else {
				if ($(".nice-feature .mouse-scroll").hasClass("hide")) $(".nice-feature .mouse-scroll").removeClass("hide");
			}
		}
		autoScroll()
		$(window).scroll(autoScroll)
	}
});
