@extends('ypp::layout')

@section('content')

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">
                @include('ypp::includes.breadcrumbs')
                <div class="container clearfix">

                <div>
                    <h3>My Playlists</h3>
                </div>

                @foreach($playlists as $playlist)
                    <h4>Playlist: {{ $playlist->name }}</h4>

                    <div class="clearfix portfolio">
                        @foreach($playlist->contents()->get() as $content)
                            <article class="portfolio-item @if($content->has_photos) pf-photos @endif @if($content->has_videos) pf-videos @endif">
                                <div class="portfolio-image">
                                    <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                        <div class="flexslider-custom">
                                            <div class="slider-wrap">
                                                <div class="slide"><a href="{{ $content->link }}?pl=member:{{ $playlist->id }}"><img src="{{ $content->thumb }}"></a></div>
                                                @foreach($content->thumbs as $thumb)
                                                <div class="slide"><a href="{{ $content->link }}?pl=member:{{ $playlist->id }}"><img src="{{ $thumb }}"></a></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{ $content->link }}?pl=member:{{ $playlist->id }}">{{ $content->title }}</a></h3>
                                    <span>
                                        <ul class="entry-meta clearfix">
                                            @foreach($content->sites()->ofNetwork($network->id)->get() as $content_site)
                                            <li>
                                                <i class="icon-folder-open-alt"></i> <a href="{{ $content_site->link }}">{{ $content_site->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </span>
                                    <span>
                                        <ul class="entry-meta clearfix">
                                            <li><i class="icon-calendar3"></i> {{ $content->formatted_date }}</li>
                                            <li><a href="{{ $content->link }}#comments"><i class="icon-comments"></i> {{ $content->comments()->count() }}</a></li>
                                        </ul>
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <a href="{{ $playlist->contents()->first()->link }}?pl=member:{{ $playlist->id }}" class="btn btn-default">Play all videos in this playlist</a>

                    <div class="divider divider-center"><i class="icon-circle"></i></div>
                @endforeach
            </div>

            <script type="text/javascript">

                jQuery(window).load(function(){

                    var $container = $('.portfolio');

                    $container.isotope({ transitionDuration: '0.65s' });

                    $(window).resize(function() {
                        $container.isotope('layout');
                    });

                });

            </script>

        </section><!-- #content end -->

@stop
