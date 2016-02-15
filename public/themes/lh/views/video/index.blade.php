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
                <img src="{{ \Theme::asset('img/img-header-hd_videos-large.jpg') }}" class="img-responsive center-block">
            </div>

            <div class="content-sub-header content-wrapper">
                <div class="inner">
                    <div class="heading"><h1>XXX Videos</h1></div>
                    <div class="sorting">
                        <div class="level-1-sorts">
                            <a class="btn primary btndropdown" href="#dropsort">{{ $sortname }}<i class="icon-arrow-circle-down"></i></a>
                            <ul style="display: none" id="dropsort" class="ddn">
                                <li><a href="/videos?o=d">Newest</a></li>
                                <li><a href="/videos?o=r">Top Rated</a></li>
                                <li><a href="/videos?o=v">Most Viewed</a></li>
                                <li><a href="/videos?o=f" class="active">Most Popular</a></li>
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
                        <li><a href="{{ $tag->link }}">{{ $tag->name }} <span class="count">({{ $tag->dvd_count }})</span></a></li>
                        @endforeach
                    </ul>
                </aside>
                <main>
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
                </main>
                 <div class="clearfix text-center">
	                {!! $contents->render() !!}
	            </div>
            </section>
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
