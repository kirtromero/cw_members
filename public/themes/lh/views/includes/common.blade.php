<link rel="icon" href="{{ \Theme::asset('img/favicon.ico') }}" type="image/x-icon"/>
<link rel="shortcut icon" href="{{ \Theme::asset('img/favicon.ico') }}" type="image/x-icon"/>

<!-- Stylesheets
============================================= -->
<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,300,500,700' rel='stylesheet' type='text/css'>
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/bootstrap.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('style.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/dark.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/font-icons.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/animate.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/magnific-popup.css') }}" type="text/css" />

<link rel="stylesheet" href="{{ \Theme::asset('css/responsive.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/colors.css') }}" type="text/css" />
<!-- Site Specific Style test -->
<link rel="stylesheet" href="{{ \Theme::asset('css/main.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ \Theme::asset('css/custom.css') }}" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="{{ \Theme::asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ \Theme::asset('js/plugins.js') }}"></script>
<script type="text/javascript">

    jQuery(window).load(function(){

        $('.flexslider-custom').flexslider({
            selector: ".slider-wrap > .slide",
            controlNav: false,
            directionNav: false,
            animation: "slide",
            slideshowSpeed: 1000,
            start: function(slider) {
                slider.pause();
                slider.manualPause = true;
                slider.mouseover(function() {
                    slider.manualPause = false;
                    slider.play();
                });
                slider.mouseout(function() {
                    slider.manualPause = true;
                    slider.pause();
                });
          }
        });

        //$('.flexslider-custom').pause();
        $(".slide").each(function(){
            $(this).hover(function(){
                $(this).find(".play-button").show();
            },function(){
                $(this).find(".play-button").hide();
            });
        });

        $(".btndropdown").each(function(){
            $(this).click(function(e){
                e.preventDefault();
                var item = $(this).attr("href");
                console.log(item);
                $(item).toggle();
            });
        });
    });

</script>
