@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
</style>
<!-- Content
============================================= -->
<section id="content sites">

    <div class="content-wrap">
        <div class="container clearfix">
            <div class="item-container site-banner top-banner">
                <img src="{{ \Theme::asset('img/img-header-sites-large.jpg') }}" class="img-responsive center-block">
            </div>

            <h2 class="box-title">Exclusive Lethal Sites</h2>
            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($sites as $site)
                <article class="portfolio-item">
                    <div class="slide portfolio-image">
                        <a href="{{ $site->link }}">
                            <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                            <img src="{{ Theme::asset('img/site_thumbs/' . $site->id .'.jpg' ) }}" alt="{{ $site->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $site->link }}">{{ $site->name }}</a></h3>
                        <div class="clearfix"></div>
                        <span>
                            <ul class="entry-meta clearfix item-basic-info">
                                <li class="text-left"><i class="fa fa-film"></i> {{ $site->video_duration }}</li>
                                <li class="text-center"><i class="fa fa-file-image-o"></i> {{ $site->photo_count }}</li>
                                <li class="text-right"><i class="fa fa-thumbs-o-up"></i> {{ ($site->rating / 5) * 100 }}%</li>
                            </ul>
                        </span>
                        <div class="clearfix"></div>
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
