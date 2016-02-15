(function($, window, document) {
	"use strict";

		$('.heading-action').each(function(){
			$(this).click(function(){
				$(this).next('.text').toggle();
			});
		});

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
