(function( root, $, undefined ) {
	"use strict";

	$(function () {
		// DOM ready, take it away

		var slider = $(".bnb_apartment-slider");

		var initSlick = function (s, isNew){

			if(isNew === undefined){
				isNew = true;
			}
			if(!isNew){
				s.find(".navbar").remove();
				s.slick("unslick");
			}

			var screenWidth = $(window).width();

			if (screenWidth > 480) {
				if(s.hasClass("fullscreen")){
					s.slick({
						arrows: true,
					  centerMode: true,
					  centerPadding: "60px",
					  slidesToShow: 3,
						easing: "ease",
						speed: 300,
						variableWidth: true
					});
				}else{
					s.slick({
						arrows: true,
					  centerMode: true,
					  centerPadding: "60px",
					  slidesToShow: 3,
						easing: "ease",
						speed: 300,
						variableWidth: true
					});
				}
			}else{
				if(s.hasClass("fullscreen")){
					s.slick({
						arrows: false,
						centerMode: false,
						centerPadding: "60px",
						slidesToShow: 1,
						easing: "ease",
						speed: 300,
						variableWidth: false
					});
				}else {
					s.slick({
						arrows: false,
						centerMode: false,
						centerPadding: "60px",
						slidesToShow: 1,
						easing: "ease",
						speed: 300,
						variableWidth: true
					});
				}

			}


			s.append("<div class='navbar navbar-maison'><button class='navbar-toggle toggle-fullscreen'><div class='rotate'><span class='icon-bar first-bar'></span><span class='icon-bar second-bar'></span></div></button></div>");

			$(".toggle-fullscreen").on("click", function(){
				unsetFullscreen(s);
			});

		};
		initSlick(slider);

		// s = slider
		var setFullscreen = function(s){
			if(!s.hasClass("fullscreen")){
				s.addClass("fullscreen");
				initSlick(s, false);

				window.scrollTo(0, 0);
				$("body").css("overflow", "hidden");

				window.setTimeout(function(){
					$(window).resize();
				}, 500);
			}
		};

		var unsetFullscreen = function(s){
			s.removeClass("fullscreen");
			initSlick(s, false);

			window.setTimeout(function(){
				$(window).resize();
			}, 500);
			$("body").css("overflow", "visible");
		};

		$(".slick-slide").on("click", function(){
			setFullscreen(slider);
		});


		// Daterange picker
		$(".daterange-checkin").attr("role", "check-in");
		$(".daterange-checkout").attr("role", "check-out");
		var rangeDatepicker = new window.TpDatepickerRange({
			legend: true,
			roles: ["check-in", "check-out"],
			offsets: {top: 0, left: 0}
		});
		rangeDatepicker;

	});

} ( this, jQuery));
