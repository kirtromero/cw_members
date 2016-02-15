@extends('ypp::layout')

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('ypp::includes.breadcrumbs')
        <div class="container clearfix">

            <div class="clearfix">
            <ul id="portfolio-filter" class="clearfix">
            <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
            @foreach($tags as $key => $tag)
                <li><a href="#" data-filter=".pf-{{ $tag->id }}">{{ $tag->name }}</a></li>
            @endforeach
            </ul><!-- #portfolio-filter end -->
            </div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($dvds as $dvd)
                <article class="portfolio-item dvd-item {{ $dvd->tags_as_class }}">
                    <div class="portfolio-image">
                        <a href="{{ $dvd->link }}">
                            <img src="{{ $dvd->front_cover_thumb }}" alt="{{ $dvd->title }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $dvd->link }}">{{ $dvd->title }}</a></h3>
                        <span>
                            <ul class="entry-meta clearfix">
                            <li>
                            <i class="icon-folder"></i>
                            @foreach($dvd->series as $series)
                                <a href="{{ $series->link }}">{{ $series->title }}</a> /
                            @endforeach
                            </li>
                            </ul>
                        </span>
                    </div>
                </article>
                @endforeach

            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $dvds->render() !!}
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
