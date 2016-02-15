@extends('lh::layout')

@section('content')

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">
                @include('lh::includes.breadcrumbs')

                <div class="container clearfix">

	            <div>
	                <h3>My Favorites</h3>
	            </div>

	            @foreach($favorites as $key => $favorite)
	            <div class="favorite-item col_one_third @if(($key+1)%3 == 0) col_last @endif">
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
	                    <div style="text-align: right"><button class="remove-favorite btn btn-default" data-fav-id="{{ $favorite->id }}" data-fav-type="{{ get_class($favorite) }}">Remove</button></div>
	                    <div class="entry-content">
	                        {!! $favorite->description !!}
	                    </div>
	                </div>
	            </div>
	            @if(($key+1)%3 == 0) <div class="clearfix"></div> @endif
	            @endforeach

	        </div>

            <script type="text/javascript">

                jQuery(document).ready(function($) {

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
                                $this.closest('.favorite-item').fadeOut();
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
