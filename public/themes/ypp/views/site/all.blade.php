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
                @foreach($sites as $site)
                <article class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="{{ $site->link }}">
                            <img src="{{ $site->top_thumb }}" alt="{{ $site->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $site->link }}">{{ $site->name }}</a></h3>
                        <span>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-film"></i> {{ $site->video_duration }}</li>
                                <li><i class="icon-picture"></i> {{ $site->photo_count }}</li>
                            </ul>
                        </span>
                    </div>
                </article>
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
