@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
.portfolio-item {
    width: 14.25%
}
.site-banner {
    margin-top: -36px;
    border-top: 0px;
    padding-top: 0px;
    -webkit-border-bottom-right-radius: .25em;
    -webkit-border-bottom-left-radius: .25em;
    -moz-border-radius-bottomright: .25em;
    -moz-border-radius-bottomleft: .25em;
    border-bottom-right-radius: .25em;
    border-bottom-left-radius: .25em;
    border-top-right-radius: 0px;
    border-top-left-radius: 0px;
}
</style>
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        <div class="container clearfix notopmargin">
            <div class="item-container site-banner">
                <img src="{{ \Theme::asset('img/img-header-dvds-large.jpg') }}" class="img-responsive center-block">
            </div>

            <div class="content-sub-header content-wrapper">
                <div class="inner">
                    <div class="heading"><h1>{{ $page_title }}</h1></div>
                    <div class="sorting">
                        <div class="level-1-sorts">
                            <a class="btn primary btndropdown" href="#dropsort">{{ $sortname }}<i class="icon-arrow-circle-down"></i></a>
                            <ul style="display: none" id="dropsort" class="ddn">
                                <li><a href="/dvds" @if(!Request::has('o'))class="active"@endif>Newest</a></li>
                                <li><a href="/dvds?o=r" @if(Request::get('o') == 'r')class="active"@endif>Top Rated</a></li>
                                <li><a href="/dvds?o=v" @if(Request::get('o') == 'v')class="active"@endif>Most Viewed</a></li>
                                <li><a href="/dvds?o=f" @if(Request::get('o') == 'f')class="active"@endif>Most Popular</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Items
            ============================================= -->
            <section class="content-wrapper">
                <aside class="no-category">
                    <div class="toggle-wrapper">
                        <div class="content-toggle categories">
                            <a class="option" href="#cats">Categories</a>
                        </div>
                    </div>
                    <span class="categories-label">Categories</span>
                    <ul class="category-box">
                        @foreach($tags as $tag)
                        <li><a href="{{ $tag->link }}">{{ $tag->name }} <span>({{ $tag->dvd_count}})</span></a></li>
                        @endforeach
                    </ul>
                </aside>
                <main>
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
                </main>

                <div class="clearfix text-center">
                    {!! $dvds->render() !!}
                </div>

            </section>

        </div>

    </div>

</section><!-- #content end -->

@stop
