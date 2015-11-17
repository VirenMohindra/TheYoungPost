(function($) {

	var common = {
		init: function(){


		}
	}

	var header = {
		init: function(){
			// Check scroll position and add/remove class to resize header
			$(window).on('scroll', function(){
				header.headerScroll();
			});
			header.headerScroll();

			header.searchInit();

			header.menuInit();

			header.menuArtInit();
		},
		headerScroll: function(){
			if ($(window).scrollTop() == 0){
				$('.header').removeClass('is-scrolled');
			}else{
				$('.header').addClass('is-scrolled');
			}
		},
		searchInit: function(){
			$('.searchBar').css('top', $('.header').outerHeight());

			$('.searchBar-icon').on('click', function(e){
				header.searchAction();
				e.preventDefault();
			});

			$('.searchBar-bg').on('click', function(e){
				header.searchAction();
			});

			$(document).keydown(function(e) { 
			    if (e.keyCode == 27 && $('body').hasClass('is-searching')) { 
			        header.searchAction();
			    } 
			});
		},
		searchAction: function(){
			$('body').toggleClass('is-searching');
			header.allowScrollSearch = !header.allowScrollSearch;
			if (header.allowScrollSearch){
				header.enableScroll();
			}else{
				header.disableScroll();
			}
			$('.searchBar').slideToggle();
		},
		allowScrollSearch: true,
		allowScrollMap: true,
		disableScroll: function() {
			$(window).bind('scroll DOMMouseScroll touchmove mousewheel wheel', header.preventDefault);
			$(window).bind('keydown', header.preventDefaultForScrollKeys);
		},
		enableScroll: function() {
			$(window).unbind('scroll DOMMouseScroll touchmove mousewheel wheel', header.preventDefault);
			$(window).unbind('keydown', header.preventDefaultForScrollKeys);
		},
		keys: {37: 1, 38: 1, 39: 1, 40: 1},
		preventDefault: function(e) {
			if ($('.menu').is(':visible') && $('.menu').css('overflow-y') == 'scroll')
				return;
		  	e = e || window.event;
		  	if (e.preventDefault)
		    	e.preventDefault();
		  	e.returnValue = false;  
		},
		preventDefaultForScrollKeys: function(e) {
		    if (header.keys[e.keyCode]) {
		        header.preventDefault(e);
		        return false;
		    }
		},
		menuInit: function(){
			$('.menu-open, .menu-close').on('click', function(e){
				$('.menu').slideToggle();
				$('body').toggleClass('is-menuOpen')
				header.allowScrollMap = !header.allowScrollMap;
				if (header.allowScrollMap){
					header.enableScroll();
				}else{
					header.disableScroll();
				}
				e.preventDefault();
			});
		},
		menuArtInit: function(){
			$('[data-continent]').each(function(){
				$(this)
					.on('mouseenter', function(){
						$('.menuArt:not(.menuArt--' + $(this).data('continent') + ')').removeClass('is-hovering');
						$('.menuArt--' + $(this).data('continent')).addClass('is-hovering');
					})
					// .on('mouseleave', function(){
						// $('.menuArt--' + $(this).data('continent')).removeClass('is-hovering');
					// })
					.on('click', function(e){
						$('.menuArt--' + $(this).data('continent') + ' .menuArt-heading')[0].click();
					});
			});
		}
	}

	var featured = {
		init: function(){
			var scope = this;
			$(window).on('resize', function(){
				scope.setFeaturedHeight();
			});
			scope.setFeaturedHeight();

			$('.featured-arrow').on('click', function(e){
				var scrollToPosition = $('.featured').outerHeight();
				$("html, body").animate({ scrollTop: scrollToPosition });
				e.preventDefault();
			});
		},
		setFeaturedHeight: function(){
			var featuredHeight = $(window).height() - parseInt($('body').css('padding-top'));
			$('.featured:not(.sg-featured)').css('height', featuredHeight);
		}
	}

	var frontObj = {
		init: function(){
			$(window).resize(function(){
				frontObj.centerIt();
			});
			frontObj.centerIt();
		},
		centerIt: function(){
			$('.frontObj.has-center').each(function(){
				// Reset js styles
				$(this).attr('style', '');

				var targetOffsetTop = $(this).offset().top,
					maxHeight = 0,
					$rowElements = $(this);

				$('.frontObj').not(this).each(function(){
					if ($(this).offset().top == targetOffsetTop){
						$rowElements.add($(this));
						maxHeight =  (maxHeight < $(this).outerHeight()) ? $(this).outerHeight() : maxHeight;
					}
				})

				$(this).css({
					'min-height': $(this).outerHeight(),
					'height': maxHeight
				});
			})
		}
	}

	var latest = {
		init: function(){
			var offset = $('.footer').offset().top - 100;
			$('.latest-more').on('click', function(e){
				$("html, body").animate({ scrollTop: offset });
				e.preventDefault();
			});
		}
	}

	var single = {
		init: function(){
			if (!$('body').hasClass('single')){
				return;
			}
			var scope = this;
			scope.notMobile = !(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera);
			// Ugh, ALM sets the wrong page height and has no callback functions so we must use timeout
			setTimeout(function(){
				$('body').css('height', '');
			}, 10);
			if (scope.notMobile){
				scope.s = skrollr.init();
			}
			$.fn.almComplete = function(alm){
				scope.almCallback(alm);
			};
			// Get back/forward browser buttons working
			window.onpopstate = function(e){
			    if(e.state){
			    	window.location.href = e.state.url;
			    }
			};
			window.history.pushState({'title':$('article').data('title'), 'url':$('article').data('permalink')},"", $('article').data('permalink'));
			// Show/Hide Comments
			$('.header-icon.comment').on('click', function(e){
				$('#disqus_thread').toggleClass('is-visible');
				e.preventDefault();
			});
		},
		almCallback: function(alm){
			var scope = this;
			var nextPost = alm.el;
			var offset = nextPost.offset().top - $('.header').outerHeight() - parseInt(nextPost.css('margin-top'));
			var scrollCompleteOnce = false;
			$('#disqus_thread').removeClass('is-visible');
			$("html, body").animate({ scrollTop: offset }, function(){
				if (!scrollCompleteOnce){
					// Hacky!
					setTimeout(function(){
						// Hide old post
						var allPosts = $('.alm-reveal, .alm-preloaded');
						var oldPosts = allPosts.not(alm.el);
						allPosts.css('margin-top', 0);
						oldPosts.hide();
						// Get Parallax working again
						if (scope.notMobile){
							scope.s.refresh();
						}
						// Set height to be auto
						$('body').css('height', '');
						// Scroll to top of the page
						window.scrollTo(0, 0);
						// Make sure logo doesn't change (more hacky!)
						setTimeout(function(){
							$('.header').addClass('is-scrolled');
						},10);
						// Update disqus
						oldPosts.find('#disqus_thread').detach().insertAfter(alm.el.find('.disqus-wrap'))
						var articleData = alm.el.find('article').data();
						DISQUS.reset({
						  	reload: true,
						  	config: function () {  
						    	this.page.identifier = articleData.slug;  
						    	this.page.url = articleData.permalink;
						  	}
						});
						scope.setCommentCount(articleData.permalink);
						// Update URL/State
						document.title = articleData.title;
							window.history.pushState({'title':articleData.title, 'url':articleData.permalink},"", articleData.permalink);
					}, 10)
				}
				scrollCompleteOnce = true;
			});
		},
		setCommentCount: function(url){
			$.ajax({
               type: 'GET',
               url: "https://disqus.com/api/3.0/threads/set.jsonp",
               data: { api_key: disqus_api_key, forum : window.disqus_shortname, thread : 'link:' + url },
               cache: false,
               dataType: 'jsonp',
               success: function (result) {
               		var commentCount = result.response.length === 1 ? result.response[0].posts : 0;
               		$('.comment-count').show().text(commentCount);
               	},
               	error: function (result) {
               		$('.comment-count').hide();
               	},
			});
		}
	}

	// On Ready
	$(function(){
		var disqus_shortname = "theyoungpost";
		common.init();
		header.init();
		featured.init();
		frontObj.init();
		latest.init();
		single.init();
	});


})(jQuery);