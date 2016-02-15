@extends('lh::layout')

@section('content')

<!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">
            <div class="container clearfix notopmargin">

                <div class="widget clearfix">
                    @component_advertisement('sidebar')
                </div>

                <div class="content-sub-header content-wrapper">
                    <div class="inner">
                        <div class="heading"><h1>New Exclusive High Definition Videos</h1></div>
                        <div class="sorting">
                            <div class="level-1-sorts">
                                <a class="btn primary" href="{{ url('videos') }}">View All<i class="icon-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

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
                </div>

                <h2 class="box-title">Newest DVDs <a href="#" class="btn btn-primary pull-right">VIEW ALL <i class="fa fa-arrow-circle-o-right"></i></a></h2>

                <div class="row dvd-list">
                    @foreach($dvds as $key => $dvd)
                    <div class="dvd">
                        <div class="inner">
                            <div class="thumb-wrapper">
                                <a href="{{ $dvd->link }}">
                                    <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                                    <div class="thumb">
                                        <img src="{{ Theme::asset('img/thumb-dvd-trans.png') }}" alt="">
                                        <span class="cover" style="background-image:url('{{ $dvd->front_cover }}')"></span>
                                    </div>
                                    <div class="extra-thumbs">

                                        @foreach($dvd->contents as $key => $content)
                                            @if($key <= 1)
                                            <span class="thumb-sml">
                                                <img src="{{ $content->thumb }}">
                                            </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </a>
                            </div>
                            <div class="main-meta">
                                <div class="title-wrapper">
                                    <a href="{{ $dvd->link }}" class="title">{{ $dvd->title }}</a>
                                    @if(isset($dvd->series->first()->title))
                                    <span class="series"><i class="icon-folder-open"></i> Series: <a href="{{ $dvd->series->first()->link }}">{{ $dvd->series->first()->title }}</a>
                                    @endif
                                </div>
                                <div class="extra-meta">
                                    <div class="inner">
                                        <span class="time"><i class="icon-time"></i> {{ $dvd->video_duration }}</span>
                                        <span class="views"><i class="icon-views"></i> {{ $dvd->views }}</span>
                                        <span class="rating"><i class="icon-thumbs-up"></i> {{ ($dvd->rating / 5) * 100 }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="widget clearfix">
                    @component_advertisement('sidebar')
                </div>

            </div>
        </div>
    </section>
    @stop
