@extends('ypp::layout')

@section('page_header_includes')
<link href="{{ \Theme::asset('css/star-rating.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ \Theme::asset('js/star-rating.min.js') }}" type="text/javascript"></script>
@stop

@section('content')

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">
                @include('ypp::includes.breadcrumbs')

                <div class="container clearfix">

                    <div class="clearfix">
                        <div class="entry-title">
                            <h2>{{ $series->title }}</h2>
                        </div><!-- .entry-title end -->

                        <ul class="entry-meta clearfix">
                            <li><button class="add-to-favorites btn btn-default" data-options="{{ json_encode(['url'=>url('favorites'),'type'=>'dvdseries','id'=>$series->id]) }}" data-is-favorite="{{$is_favorite}}">@if($is_favorite) Added to Favorites @else Add to Favorites @endif</button></li>
                        </ul><!-- .entry-meta end -->
                    </div>

                    <!-- Portfolio Single Content
                    ============================================= -->
                    <div class="nobottommargin portfolio-single-content">

                        <!-- Portfolio Single - Description
                        ============================================= -->
                        <div class="fancy-title title-dotted-border">
                            <h2>Description:</h2>
                        </div>

                        <div class="col_full nobottommargin">
                            {!! $series->description !!}
                            <div class="clear"></div>
                        </div>


                        <!-- Portfolio Single - Description End -->

                    </div><!-- .portfolio-single-content end -->

                    <div class="clear"></div>

                    <div class="divider divider-center" id="video-content"><i class="icon-circle"></i></div>

                    <div class="col_full nobottommargin clearfix">

                        <div>
                            <h3>DVDs</h3>
                        </div>

                        <!-- Portfolio Items
                        ============================================= -->
                        <div id="portfolio" class="clearfix">
                            @foreach($dvds as $dvd)
                            <article class="portfolio-item">
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
										<li><i class="icon-film"></i> {{ $dvd->video_duration }}</li>
                                        <li><i class="icon-picture"></i> {{ $dvd->photo_count }}</li>
                                        </ul>
                                    </span>
                                </div>
                            </article>
                            @endforeach
                        </div><!-- #portfolio end -->

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