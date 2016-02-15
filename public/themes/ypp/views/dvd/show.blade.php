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
                            <h2>{{ $dvd->title }}</h2>
                        </div><!-- .entry-title end -->
                    </div>

                    <div class="col_one_third nobottommargin">

                        <!-- Portfolio Single - Meta
                        ============================================= -->
                        <div class="panel panel-default events-meta">
                            <div class="panel-body">
                                <ul class="portfolio-meta nobottommargin">
                                    <li>
                                        <span><i class="icon-star"></i>Rating:</span>
                                        <input id="rating" value="{{ $dvd->rating }}" />
                                    </li>
                                    <li><span><i class="icon-users"></i>Models:</span>
                                        @foreach($models as $model)
                                            <a href="{{ $model->link }}">{{ $model->name }}</a> /
                                        @endforeach
                                    </li>
                                    <li><span><i class="icon-folder"></i>Series:</span>
                                        @foreach($series as $item)
                                            <a href="{{ $item->link }}">{{ $item->title }}</a> /
                                        @endforeach
                                    </li>
									<li><span><i class="icon-picture"></i>Pictures:</span>
										{{ $total_pics }}
									</li>
									<li><span><i class="icon-video"></i>Videos:</span>
										{{ $total_vids }}
									</li>
									<li><span><i class="icon-time"></i>Video Duration:</span>
										{{ $total_video_duration }}
									</li>
									<li><button class="add-to-favorites btn btn-default" data-options="{{ json_encode(['url'=>url('favorites'),'type'=>'dvd','id'=>$dvd->id]) }}" data-is-favorite="{{$is_favorite}}">@if($is_favorite) Added to Favorites @else Add to Favorites @endif</button></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Portfolio Single - Meta End -->

                    </div>

                    <!-- Portfolio Single Content
                    ============================================= -->
                    <div class="col_two_third portfolio-single-content col_last nobottommargin">

                        <!-- Portfolio Single - Description
                        ============================================= -->
                        <div class="fancy-title title-dotted-border">
                            <h2>Description:</h2>
                        </div>

                        <div class="col_full nobottommargin">
                            {!! $dvd->description !!}
                            <div class="clear"></div>
                        </div>


                        <!-- Portfolio Single - Description End -->

                    </div><!-- .portfolio-single-content end -->

                    <div class="clear"></div>

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    <h3>DVD Cover</h3>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Front</label>
                            <p><img src="{{ $dvd->front_cover }}" width="100%" height="auto"></p>
                        </div>
                        <div class="col-lg-6">
                            <label>Back</label>
                            <p><img src="{{ $dvd->back_cover }}" width="100%" height="auto"></p>
                        </div>
                    </div>

                    <div class="clear"></div>

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    <div class="col_full nobottommargin clearfix">

                        <div>
                            <h3>Photo Sets / Scenes</h3>
                        </div>

                        @foreach($contents as $key => $content)
                        <div class="col_one_third @if(($key+1)%3 == 0) col_last @endif">
                            <div class="ipost clearfix">
                                <div class="entry-image">
                                    <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                        <div class="flexslider-custom">
                                            <div class="slider-wrap">
                                                <div class="slide"><a href="{{ $content->link }}?pl=dvd:{{ $dvd->id }}"><img src="{{ $content->thumb }}"></a></div>
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
                                @if ($content->has_videos)
                                <span class="play-scene-wrap">
                                    <a href="{{ $content->link }}?pl=dvd:{{ $dvd->id }}" class="btn btn-default">Play Scene</a>
                                </span>
                                @endif
                                <span>
                                    <ul class="entry-meta clearfix">
                                        @foreach($content->sites as $content_site)
                                        <li>
                                            <i class="icon-folder-open-alt"></i> <a href="{{ $content_site->link }}?pl=dvd:{{ $dvd->id }}">{{ $content_site->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </span>
                                <span>
                                <ul class="entry-meta clearfix">
                                    <li>
                                    <i class="icon-folder"></i>
                                    @foreach($dvd->series as $series)
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

					@if($contents->first())
                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    <div class="col_full portfolio-single-content clearfix text-center">
                        <a href="{{ $contents->first()->link }}?pl=dvd:{{ $dvd->id }}" class="button">Watch The Full DVD</a>
                    </div>
                    @endif

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    @if(count($similar) > 0)
                    <!-- Related Portfolio Items
                    ============================================= -->
                    <h4>More From This Series:</h4>

                    <div id="related-portfolio" class="owl-carousel portfolio-carousel">
                        @foreach($similar as $similar)
                        <div class="oc-item">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="{{ $similar->link }}">
                                        <img src="{{ $similar->front_cover_thumb }}">
                                    </a>

                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{ url('view/'.$similar->id) }}">{{ $similar->title }}</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div><!-- .portfolio-carousel end -->

                    <script type="text/javascript">

                        jQuery(document).ready(function($) {

                            var relatedPortfolio = $("#related-portfolio");

                            relatedPortfolio.owlCarousel({
                                margin: 30,
                                nav: true,
                                dots:true,
                                autoplay: true,
                                autoplayHoverPause: true,
                                responsive:{
                                    0:{ items:1 },
                                    480:{ items:2 },
                                    768:{ items:3 },
                                    992:{ items:4 }
                                }
                            });

                        });

                    </script>
                    @endif


                    <script type="text/javascript">

                        jQuery(document).ready(function($) {

                            $("#rating").rating({
                                glyphicon: false,
                                ratingClass: "rating-fa",
                                showClear: false,
                                showCaption: false,
                                size: "xs",
                                readonly: true
                            });

                        });

                    </script>

                </div>

            </div>

        </section><!-- #content end -->

@stop