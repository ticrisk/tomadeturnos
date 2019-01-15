// Gameforest lightbox plugin by yakuzi
// Author: https://yakuthemes.com
// Version: 1.1
(function($) {
	"use strict";

  $.fn.lightbox = function(light) {

	  var current,
				size,
	   		animation;

	  $(this).click(function(e) {
	    e.preventDefault();

			var option = $(this).data("lightbox"),
					comment = '';

	    if ($(this).data("animation")) {
	      animation = $(this).data("animation");
	    } else {
	      animation = 'fadeIn animate2';
	    }

	    if ( option.disqus == true ) {
	      comment = '<div class="lightbox-comment">' +
	      '<div id="disqus_thread"></div>' +
	      '<script>' +
	        "(function() { var d = document, s = d.createElement('script'); s.src = 'https://" + light.disqus + ".disqus.com/embed.js';s.setAttribute('data-timestamp', +new Date()); (d.head || d.body).appendChild(s); })();" +
	      '</script>' +
	      '<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>' +
	      '<script id="dsq-count-scr" src="https://' + light.disqus  + '.disqus.com/count.js" async></script>' +
	      '</div>';
	    }

	    if ( option.facebook == true ) {
	      comment = '<div id="fb-root"></div>' +
	      '<script>(function(d, s, id) {' +
	        'var js, fjs = d.getElementsByTagName(s)[0];'+
	        'if (d.getElementById(id)) return;'+
	        'js = d.createElement(s); js.id = id;'+
	        'js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";'+
	        'fjs.parentNode.insertBefore(js, fjs);'+
	      '}(document, \'script\', \'facebook-jssdk\'));</script>'+
	      '<div class="lightbox-comment">' +
	      '<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>' +
	      '</div>';
	    }

	    var slideNum = $("[data-lightbox*='\"gallery\": \"" + option.gallery + "\"']").index(this);
	    var lightbox = '<div class="lightbox">' +
	      '<div class="lightbox-overlay animated fadeIn fast"></div>' +
	        '<div>' +
	        '<a class="lightbox-close animated fadeIn fast" href="#"><i class="fa fa-times"></i></a>' +
	        '<div class="lightbox-block animated ' + animation + ' fast">' +
	          '<div class="lightbox-img">' +
	            '<ul></ul>' +
	          '</div>' +
	            comment +
	        '</div>' +
	      '</div>' +
	    '</div>';

	    $('body').append(lightbox);

	    if ( option.gallery ) {
	      $('.lightbox-img').append(
	        '<a class="lightbox-prev"><i class="fa fa-chevron-left"></i></a>' +
	        '<a class="lightbox-next"><i class="fa fa-chevron-right"></i></a>'
	      );
	      $('body').find("[data-lightbox*='\"gallery\": \"" + option.gallery + "\"']").each(function() {
	        $('.lightbox ul').append(
	          '<li>' +
	            '<img src="' + $(this).attr('href') + '">' +
	          '</li>'
	        );
	      });
	    }

	    var video = '',
					matches = '',
					source = $(this).attr('href');

			if (matches = source.match(/\/\/.*?youtube\.[a-z]+\/watch\?v=([^&\s]+)/) || source.match(/youtu\.be\/(.*)/)) {
	      video = 'https://www.youtube.com/embed/' + matches[1] + '?rel=0&amp;amp;autoplay=1&amp;amp;showinfo=0';
	    }

			if (matches = source.match(/\/\/.*?twitch\.[a-z]+\/\?channel=([^&\s]+)/)) {
				video = 'https://player.twitch.tv/?channel=' + matches[1];
			}

	    if ( video ) {
	      $('.lightbox ul').append(
	        '<li class="lightbox-video">' +
	          '<div class="embed-responsive embed-responsive-16by9">' +
	          '<iframe class="embed-responsive-item" src="' + video + '" allowfullscreen></iframe>' +
	          '</div>' +
	        '</li>'
	      );
	    }

	    if ( !(option.gallery) && !( video ) ) {
	      $('.lightbox ul').append(
	        '<li>' +
	          '<img src="' + $(this).attr('href') + '"">' +
	        '</li>'
	      );
	    }

	    size = $('.lightbox ul > li').length;

	    // hide all slide, then show the selected slide
	    $('.lightbox ul > li').hide();
	    $('.lightbox ul > li:eq(' + slideNum + ')').show();

	    // set current to selected slide
	    current = slideNum;
	  });


	  $('body').on('click', '.lightbox-overlay, .lightbox-close', function() {
	    if ($(this).data("animation")) {
	      animation = $(this).data("animation");
	    } else {
	      animation = 'fadeIn animate2';
	    }

	    $(this).removeClass('fadeIn');
	    $(this).addClass('fadeOut');
	    $(this).parent().find('.lightbox-block').removeClass(animation);
	    $(this).parent().find('.lightbox-block').addClass('fadeOut');
	    $(this).parent().find('.lightbox-close').removeClass('fadeIn');
	    $(this).parent().find('.lightbox-close').addClass('fadeOut');
	  	setTimeout(function(){
	      $('.lightbox').remove();
	  	}, 600);
	    return false;
	  });

	  // navigation prev/next
	  $('body').on('click', '.lightbox-next, .lightbox-prev', function(e) {
	    e.preventDefault();
	    e.stopPropagation();

	    var dest;

	    // looking for .prev
	    if ($(this).hasClass('lightbox-prev')) {
	      dest = current - 1;
	      if (dest < 0) {
	        dest = size - 1;
	      }
	    } else {
	      // in absence of .prev, assume .next
	      dest = current + 1;
	      if (dest > size - 1) {
	        dest = 0;
	      }
	    }

	    // fadeOut curent slide, FadeIn next/prev slide
	    $('.lightbox ul > li:eq(' + current + ')').hide();
	    $('.lightbox ul > li:eq(' + dest + ')').show();

	    // update current slide
	    current = dest;
	  });

	  return this;
	};
})(window.jQuery);
