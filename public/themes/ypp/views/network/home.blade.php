@extends('ypp::layout')

@section('content')
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="row">

                <div class="col-md-8 bottommargin">

                    <div class="col_full bottommargin-lg">
                        <div class="fslider flex-thumb-grid grid-6" data-animation="fade" data-arrows="true" data-thumbs="true">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                	@foreach($sliders as $slider)
                                	<div class="slide" data-thumb="{{ $slider->thumb }}">
                                        <a href="{{ $slider->link }}">
                                            <img src="{{ $slider->thumb }}" alt="">
                                            <div class="overlay">
                                                <div class="text-overlay">
                                                    <div class="text-overlay-title">
                                                        <h3>{{ $slider->title }}</h3>
                                                    </div>
                                                    <div class="text-overlay-meta">
                                                        @include('ypp::ratings.'.$slider->rating_view)
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                	@endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="bottommargin-lg">
                        @component_advertisement('below-sliders','1')
                    </div>

                    <div class="col_full nobottommargin clearfix">

                        <div>
                            <h3>Latest Updates</h3>
                        </div>

                        @foreach($contents as $key => $content)
                        <div class="col_one_third @if(($key+1)%3 == 0) col_last @endif">
                            <div class="ipost clearfix">
                                <div class="entry-image">
                                    <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                        <div class="flexslider-custom">
                                            <div class="slider-wrap">
                                                <div class="slide"><a href="{{ $content->link }}"><img src="{{ $content->thumb }}"></a></div>
                                                @foreach($content->thumbs as $thumb)
                                                <div class="slide"><a href="{{ $content->link }}"><img src="{{ $thumb }}"></a></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="entry-title">
                                    <h3><a href="{{ $content->link }}">{{ $content->title }}</a></h3>
                                </div>
                                <span>
                                    <ul class="entry-meta clearfix">
                                        @foreach($content->sites as $content_site)
                                        <li>
                                            <i class="icon-folder-open-alt"></i> <a href="{{ $content_site->link }}">{{ $content_site->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </span>
                                <span>
                                <ul class="entry-meta clearfix">
                                    <li>
                                    <i class="icon-folder"></i>
                                    @foreach($content->dvd_series as $series)
                                        <a href="{{ $series->link }}">{{ $series->title }}</a> /
                                    @endforeach
                                    </li>
                                    <li><i class="icon-calendar3"></i> {{ $content->formatted_date }}</li>
                                    <li><a href="{{ $content->link }}#comments"><i class="icon-comments"></i> {{ $content->comments()->count() }}</a></li>
                                </ul>
                                </span>
                                <div class="entry-content">
                                    {!! $content->description !!}
                                </div>
                            </div>
                        </div>
                        @if(($key+1)%3 == 0) <div class="clearfix"></div> @endif
                        @endforeach


                    </div>

                    <div class="col_full nobottommargin clearfix">

                        <div>
                            <h3>Latest DVDs</h3>
                        </div>

                        @foreach($dvds as $key => $dvd)
                        <div class="col_one_third @if(($key+1)%3 == 0) col_last @endif">
                            <div class="ipost clearfix">
                                <div class="entry-image">
                                    <a href="{{ $dvd->link }}">
                                        <img src="{{ $dvd->front_cover_thumb }}" alt="{{ $dvd->title }}">
                                    </a>
                                </div>
                                <div class="entry-title">
                                    <h3><a href="{{ $dvd->link }}">{{ $dvd->title }}</a></h3>
                                </div>
                                <span>
                                    <ul class="entry-meta clearfix">
                                    <li>
                                        <i class="icon-folder"></i>
                                        @foreach($dvd->series as $series)
                                            <a href="{{ $series->link }}">{{ $series->title }}</a> /
                                        @endforeach
                                    </li>
                                    <li><i class="icon-film"></i> {{ $dvd->video_duration }}</li>
                                    <li><i class="icon-picture"></i> {{ $dvd->photo_count }}</li>
                                    </ul>
                                </span>
                            </div>
                        </div>
                        @if(($key+1)%3 == 0) <div class="clearfix"></div> @endif
                        @endforeach

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="line hidden-lg hidden-md"></div>

                    <div class="sidebar-widgets-wrap clearfix">

                        <div class="widget clearfix">
                            @component_advertisement('sidebar')
                        </div>

                        <div class="widget widget_links clearfix">

                            <h4>Popular Tags</h4>
                            <div class="col_half nobottommargin">
                                <ul>
                                    @foreach($most_used_tags as $key => $tag)
                                    <li><a href="{{ $tag->link }}">{{ $tag->name }}</a></li>
                                    @if(($key + 1)%7 == 0)
                                </ul>
                            </div>
                            <div class="col_half nobottommargin col_last">
                                <ul>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <div class="widget clearfix">

                            <div class="tabs nobottommargin clearfix" id="sidebar-tabs">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1">Most Viewed</a></li>
                                    <li><a href="#tabs-2">Top Rated</a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix" id="tabs-1">
                                        <div id="popular-post-list-sidebar">
                                            @foreach($mostviews as $mostview)
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="{{ $mostview->link }}" class="nobg"><img class="img-circle" src="{{ $mostview->thumb }}" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="{{ $mostview->link }}">{{ $mostview->title }}</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li><i class="icon-eye"></i> {{ $mostview->views }} Views</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="tab-content clearfix" id="tabs-2">
                                        <div id="recent-post-list-sidebar">
                                            @foreach($toprateds as $toprated)
                                            <div class="spost clearfix">
                                                <div class="entry-image">
                                                    <a href="{{ $toprated->link }}" class="nobg"><img class="img-circle" src="{{ $toprated->thumb }}" alt=""></a>
                                                </div>
                                                <div class="entry-c">
                                                    <div class="entry-title">
                                                        <h4><a href="{{ $toprated->link }}">{{ $toprated->title }}</a></h4>
                                                    </div>
                                                    <ul class="entry-meta">
                                                        <li title="{{ $toprated->rating }}">@include('ypp::ratings.'.$toprated->rating_view)</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget clearfix">
                            @component_advertisement('sidebar')
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section><!-- #content end -->
@stop
