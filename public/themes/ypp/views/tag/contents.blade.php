@extends('ypp::layout')

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('ypp::includes.breadcrumbs')
        <div class="container clearfix">

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($contents as $content)
                    @include('ypp::includes.content_thumb')
                @endforeach
                

            </div><!-- #portfolio end -->

            <!-- Portfolio Script
            ============================================= -->
            <script type="text/javascript">

                jQuery(window).load(function(){

                    var $container = $('#portfolio');

                    $container.isotope({ transitionDuration: '0.65s' });

                    $(window).resize(function() {
                        $container.isotope('layout');
                    });

                });

            </script><!-- Portfolio Script End -->

        </div>

    </div>

</section><!-- #content end -->

@stop
