@extends('ypp::layout')

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('ypp::includes.breadcrumbs')
        <div class="container clearfix">
            
            @if($show_filter)
            <!-- Portfolio Filter
            ============================================= -->
            <ul id="portfolio-filter" class="clearfix">

                <li class="activeFilter"><a href="#" data-filter="*">Show All Updates</a></li>
                <li><a href="#" data-filter=".pf-photos">Updates with Photos</a></li>
                <li><a href="#" data-filter=".pf-videos">Updates with Videos</a></li>

            </ul><!-- #portfolio-filter end -->

            <div id="portfolio-shuffle">
                <i class="icon-random"></i>
            </div>

            <div class="clear"></div>
            @endif

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($contents as $key => $content)
                    @include('ypp::includes.content_thumb')
                @endforeach
                

            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $contents->render() !!}
            </div>

            <!-- Portfolio Script
            ============================================= -->
            <script type="text/javascript">

                jQuery(window).load(function(){

                    var $container = $('#portfolio');

                    $container.isotope({ transitionDuration: '0.65s' });

                    $('#portfolio-filter a').click(function(){
                        $('#portfolio-filter li').removeClass('activeFilter');
                        $(this).parent('li').addClass('activeFilter');
                        var selector = $(this).attr('data-filter');
                        $container.isotope({ filter: selector });
                        return false;
                    });

                    $('#portfolio-shuffle').click(function(){
                        $container.isotope('updateSortData').isotope({
                            sortBy: 'random'
                        });
                    });

                    $(window).resize(function() {
                        $container.isotope('layout');
                    });

                });

            </script><!-- Portfolio Script End -->

        </div>

    </div>

</section><!-- #content end -->

@stop
