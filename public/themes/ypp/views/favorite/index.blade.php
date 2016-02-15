@extends('ypp::layout')

@section('content')

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">
                @include('ypp::includes.breadcrumbs')
                <div class="container clearfix">

                <div>
                    <h3>My Favorites</h3>
                </div>

                <div class="clearfix">
                    <ul id="portfolio-filter" class="clearfix">
                        <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>
                        <li><a href="#" data-filter=".pf-Content">Contents</a></li>
                        <li><a href="#" data-filter=".pf-Dvd">DVDs</a></li>
                        <li><a href="#" data-filter=".pf-Dvdseries">DVD Series</a></li>
                        <li><a href="#" data-filter=".pf-Model">Models</a></li>
                    </ul><!-- #portfolio-filter end -->
                </div>

                <div id="portfolio" class="clearfix">
                @foreach($favorites as $key => $favorite)
                <article class="portfolio-item col_one_third pf-{{ class_basename($favorite) }}">
                    <?php $fav_type = class_basename($favorite); ?>
                    @if($fav_type == 'Content')
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                <div class="flexslider-custom">
                                    <div class="slider-wrap">
                                        <div class="slide"><a href="{{ $favorite->link }}"><img src="{{ $favorite->thumb }}"></a></div>
                                        @foreach($favorite->thumbs as $thumb)
                                        <div class="slide"><a href="{{ $favorite->link }}"><img src="{{ $thumb }}"></a></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ $favorite->link }}">{{ $favorite->title }}</a></h3>
                        </div>
                        <span>
                            <ul class="entry-meta clearfix">
                                @foreach($favorite->sites as $favorite_site)
                                <li>
                                    <i class="icon-folder-open-alt"></i> <a href="{{ $favorite_site->link }}">{{ $favorite_site->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </span>
                        <span>
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i> {{ $favorite->formatted_date }}</li>
                            <li><a href="{{ $favorite->link }}#comments"><i class="icon-comments"></i> {{ $favorite->comments()->count() }}</a></li>
                        </ul>
                        </span>
                        <div style="text-align: right"><button class="remove-favorite btn btn-default" data-fav-id="{{ $favorite->id }}" data-fav-type="{{ $fav_type }}">Remove</button></div>
                        <div class="entry-content">
                            {!! $favorite->description !!}
                        </div>
                    </div>
                    @elseif($fav_type == 'Dvd')
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                <div class="flexslider-custom">
                                    <div class="slider-wrap">
                                        <div class="slide"><a href="{{ $favorite->link }}"><img src="{{ $favorite->front_cover_thumb }}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ $favorite->link }}">{{ $favorite->title }}</a></h3>
                        </div>
                        <span>
                            <ul class="entry-meta clearfix">
                            <li>
                            <i class="icon-folder"></i>
                            @foreach($favorite->series as $series)
                                <a href="{{ $series->link }}">{{ $series->title }}</a> /
                            @endforeach
                            </li>
                            </ul>
                        </span>
                        <div style="text-align: right"><button class="remove-favorite btn btn-default" data-fav-id="{{ $favorite->id }}" data-fav-type="{{ $fav_type }}">Remove</button></div>
                    </div>
                    @elseif($fav_type == 'Model')
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                <div class="flexslider-custom">
                                    <div class="slider-wrap">
                                        <div class="slide"><a href="{{ $favorite->link }}"><img src="{{ $favorite->thumb }}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ $favorite->link }}">{{ $favorite->name }}</a></h3>
                        </div>
                        <div style="text-align: right"><button class="remove-favorite btn btn-default" data-fav-id="{{ $favorite->id }}" data-fav-type="{{ $fav_type }}">Remove</button></div>
                    </div>
                    @elseif($fav_type == 'Dvdseries')
                    <div class="ipost clearfix">
                        <div class="entry-image">
                            <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
                                <div class="flexslider-custom">
                                    <div class="slider-wrap">
                                        <div class="slide"><a href="{{ $favorite->link }}"><img src="{{ $favorite->thumb }}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry-title">
                            <h3><a href="{{ $favorite->link }}">{{ $favorite->title }}</a></h3>
                        </div>
                        <div style="text-align: right"><button class="remove-favorite btn btn-default" data-fav-id="{{ $favorite->id }}" data-fav-type="{{ $fav_type }}">Remove</button></div>
                    </div>
                    @endif
                </article>
                @endforeach
                </div>

            </div>

            <script type="text/javascript">

                jQuery(document).ready(function($) {

                    var $container = $('#portfolio'),
                        $filter = $('#portfolio-filter');

                    $container.isotope({ transitionDuration: '0.65s' });

                    $filter.on('click', 'a', function() {
                        $filter.find('li').removeClass('activeFilter');
                        $(this).parent('li').addClass('activeFilter');
                        var selector = $(this).attr('data-filter');
                        $container.isotope({ filter: selector });
                        return false;
                    });

                    var doingAjax = false;

                    $('.remove-favorite').on('click', function(event) {
                        event.preventDefault();

                        if (doingAjax) {
                            return;
                        }

                        var $this = $(this),
                            data = {
                                id: $this.data('fav-id'),
                                type: $this.data('fav-type'),
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            };

                        doingAjax = true;

                        $.ajax({ method: 'POST', url: '{{ url('favorites') }}/' + data.id, data: data }).done(function(response) {
                            if (response.success) {
                                $this.closest('.portfolio-item').fadeOut();
                            }

                            if (response.message) {
                                window.alert(response.message);
                            }
                            doingAjax = false;
                        });
                    });

                });

            </script>

            </div>

        </section><!-- #content end -->

@stop
