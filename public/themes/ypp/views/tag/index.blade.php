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
                @foreach($tags as $tag)
                <article class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="{{ $tag->link }}">
                            <img src="{{ $tag->top_thumb }}" alt="{{ $tag->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $tag->link }}">{{ $tag->name }}</a></h3>
                        <span>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-film"></i> {{ $tag->video_duration }}</li>
                                <li><i class="icon-picture"></i> {{ $tag->photo_count }}</li>
                            </ul>
                        </span>
                    </div>
                </article>
                @endforeach


            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $tags->render() !!}
            </div>

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
