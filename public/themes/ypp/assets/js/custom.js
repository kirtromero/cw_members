(function($, window, document) {
	"use strict";

	var searchWrap = $("#top-search"),
	    input = searchWrap.find("input"),
	    results = searchWrap.find(".search-ajax-results"),
	    timer;

	input.on("keyup", function(event) {
		event.preventDefault();

		var $this = $(this),
		    data = {
			    q: $this.val()
		    },
		    items = "";

		if (timer) {
			clearTimeout(timer);
		}

		results.html("");

		if ($this.val().length <= 3) {
			return;
		}

		timer = setTimeout(function() {
			$.ajax({method: "POST", url: input.data("preview-url"), data: data}).done(function(response) {
				if (response.length) {
					$.each(response, function(i, item) {
						items += "<div class='result-item'><a href='" + item.url + "' class='clearfix'><img src='" + item.thumb + "'/> " + item.title + " <span>" + item.type + "</span></a></div>";
					});
				}

				results.html(items);
			});
		}, 1500);
	});
})(jQuery, window, document);

(function($, window, document) {
	"use strict";
	var doingAjax = false;

	$('.add-to-favorites').on('click', function(event) {
		event.preventDefault();

		if (doingAjax) {
			return;
		}

		var $this = $(this),
		    isFavorite = $this.data('is-favorite'),
			options = $this.data('options'),
			type = options.type.charAt(0).toUpperCase() + options.type.slice(1);

		if (isFavorite) {
			return;
		}

		doingAjax = true;

		$.ajax({method: 'POST', url: options.url, data: {type: type, id: options.id}}).done(function(response) {
			if (response.success) {
				$this.text('Added to Favorites');
			}

			if (response.message) {
				window.alert(response.message);
			}
			doingAjax = false;
		});
	});
})(jQuery, window, document);