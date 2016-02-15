@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
</style>
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        <div class="container clearfix">

            <!-- Portfolio Items
            ============================================= -->
            <section class="section-sub-header" data-id="2:923050">
                <div class="content-wrapper">
                    <div class="section-wrap model">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="section-image">
                                    <img class="thumb" src="{{ $model->thumb }}" alt="{{ $model->name }}">
                                    <div class="voting">
                                        <div class="vote-bar-wrapper">
                                            <span class="vote-bar" style="width: 85.71%;"></span>
                                        </div>
                                        <div class="row">
                                            <a class="up" href="#"><i class="fa fa-thumbs-up"></i></a>
                                            <a class="down" href="#"><i class="fa fa-thumbs-down"></i></a>
                                        </div>
                                    </div>
                                </span>
                                <div class="section-info">
                                    <h1>{{ $model->name }}</h1>
                                    <span class="video-count">{{ $model->videoset_count }} Videos | {{ $content_views }} views</span>
                                    <ul class="tabs">
                                        <li><a href="#tg-comments" class="btn primary">Comments</a></li>
                                        <li><a href="#tg-share" class="btn primary">Share</a></li>
                                        <li><a href="#" class="favorite add-to-favorites" data-is-favorite="{{$is_favorite}}" @if($is_favorite)disabled @endif><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="item-container">
               @foreach($contents as $key => $content)
                    <div class="col_one_fourth @if(($key+1)%4 == 0) col_last @endif">
                        <div class="ipost clearfix">
                            <div class="entry-image">
                                <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                    <div class="flexslider-custom">
                                        <div class="slider-wrap">
                                            <div class="slide">
                                                @if( strtotime($content->formatted_date) > strtotime('-7 day') )
                                                <span class="exclusive">New</span>
                                                @endif
                                                <span class="hd">HD</span>
                                                <a href="{{ $content->link }}">
                                                    <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                                                    <img src="{{ $content->thumb }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-desc">
                                <h3><a href="{{ $content->link }}">{{ $content->title }}</a></h3>
                                @if($content->dvd_series->first())
                                <span>
                                    <ul class="entry-meta clearfix">
                                        <li>
                                            <i class="icon-folder-open-alt"></i> Series: <a href="{{ $content->dvd_series->first()->link }}">{{ $content->dvd_series->first()->title }}</a>
                                        </li>
                                    </ul>
                                </span>
                                @endif
                                <div class="clearfix"></div>
                                <span>
                                    <ul class="entry-meta clearfix item-basic-info">
                                        @if($content->has_videos)
                                        <li class="text-left"><i class="icon-film"></i> {{ $content->videos_duration }}</li>
                                        @elseif($content->has_photos)
                                        <li class="text-left"><i class="icon-picture"></i> {{ $content->photos_count }}</li>
                                        @endif
                                        <li class="text-left"><i class="fa fa-eye"></i> {{ $content->fake_views }}</li>
                                        <li class="text-center"><i class="fa fa-thumbs-o-up"></i> {{ ($content->rating / 5) * 100 }}%</li>
                                    </ul>
                                </span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    @if(($key+1)%4 == 0) <div class="clearfix"></div> @endif
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
