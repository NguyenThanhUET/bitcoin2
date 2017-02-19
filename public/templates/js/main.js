jQuery(document).ready(function($) {
	$("#yt-totop").hide();
	$(function() {
		var wh = $(window).height();
		var whtml = $(document).height();
		$(window).scroll(function() {
			if ($(this).scrollTop() > whtml / 10) {
				$('#yt-totop').fadeIn();
			} else {
				$('#yt-totop').fadeOut();
			}
		});
		$('#yt-totop').click(function() {
			$('body,html').animate({
				scrollTop : 0
			}, 800);
			return false;
		});
	});
});
jQuery(document).on(
		'click',
		function(e) {
			var elem = $(e.target).closest('#trigger-overlay'), box = $(
					e.target).closest('.field');

			if (elem.length) {
				if (elem.hasClass('fa-search')) {
					elem.removeClass('fa-search').addClass('fa-close');
				} else {
					elem.removeClass('fa-close').addClass('fa-search');
				}
				e.preventDefault();
				$('.field').toggle();
			} else if (!box.length) {
				$('.field').hide();
				$('#trigger-overlay').removeClass('fa-close').addClass(
						'fa-search');
			}
		});

jQuery(window).bind('scroll', function() {
	if (jQuery(window).scrollTop() > 50) {
		jQuery('nav.navbar').addClass('fixed');
	} else {
		jQuery('nav.navbar').removeClass('fixed');
	}
});
$('.carousel').carousel({
	interval : 5000 // changes the speed
});
$('.product-slider').owlCarousel({
			loop : true,
			margin : 25,
			navText : [ "<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>" ],
			nav : true,
			autoplay : 2000,
			responsive : {
				0 : {
					items : 1
				},
				600 : {
					items : 3
				},
				1000 : {
					items : 5
				}
			}
		});

$('.more-view').owlCarousel(
		{
			loop : true,
			margin : 20,
			navText : [ "<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>" ],
			nav : true,
			responsive : {
				0 : {
					items : 3
				},
				600 : {
					items : 3
				},
				1000 : {
					items : 4
				}
			}
		});

$(".more-view .item").click(function() {
	var eleId = $(this).attr('id');
	// alert(eleId);
	if (!$(this).hasClass('active')) {
		$('div.more-view .owl-item > .item').removeClass("active");
		$(".main-image .item-show").removeClass("active");
		$(this).addClass("active");
		$('#' + eleId + '-show').addClass("active");
	} else {
		return false;
	}
});