@extends('lh::layout')

@section('page_header_includes')
<link href="{{ \Theme::asset('css/star-rating.min.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ \Theme::asset('js/star-rating.min.js') }}" type="text/javascript"></script>
@stop

@section('content')

@include('lh::site.header')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
</style>
<!-- Content  ============================================= -->
<section id="content" class="view-page">

    <div class="content-wrap">

        <div class="container clearfix">
         <div class="col-md-9">
            @if(Request::has('type'))
            <ul class="video-top">
                <li class="pull-left"><strong>Photos</strong></li>
                <li class="pull-right"><a href="{{ $content->link }}">Full Video</a></li>
            </ul>
            @if(count($photos) > 0)

            <div class="portfolio-container">
                            <!-- Portfolio Items
                            ============================================= -->
                            <div id="portfolio" class="portfolio-masonry clearfix" data-lightbox="gallery">
                                @foreach($photos as $photo)
                                @foreach($photo->full_photos as $key => $item)
                                <article class="portfolio-item pf-media pf-icons">
                                    <div class="portfolio-image">
                                        <a href="{{ config('yppcontent.photos_url') }}/{{ $photo->location }}/full/{{ $item }}" data-lightbox="gallery-item">
                                            <img src="{{ config('yppcontent.thumb_url') }}/{{ $photo->thumb_location }}/{{ $item }}">
                                        </a>
                                        <a href="{{ config('yppcontent.photos_url') }}/{{ $photo->location }}/{{ $item }}" target="_blank" class="text-center">
                                            View Hi-Res Photo
                                        </a>
                                    </div>
                                </article>
                                @endforeach
                                @endforeach

                            </div><!-- #portfolio end -->

                            <div class="pagination-container topmargin nobottommargin">

                                <ul class="pagination nomargin"></ul>

                            </div>
                        </div>
                        @endif
                        @else
                        @foreach($videos as $video)
                        <ul class="video-top">
                            <li class="pull-left"><strong>Full Video</strong></li>
                            <li class="pull-right"><a href="{{ $content->link }}?type=photos">Photos</a></li>
                        </ul>
                        <div class="col_full portfolio-single-content clearfix">
                            @include('lh::content.videoplayer')
                        </div>
                        @endforeach
                        @endif

                        <div class="clearfix">
                            <div class="entry-title">
                                <h2>{{ $content->title }} @if($content->has_videos) <small>({{ $content->videos_duration }} in 1080p)</small> @else <small>({{$content->photos_count}} HD Photos)</small> @endif</h2>
                            </div><!-- .entry-title end -->
                        </div>
                        <div class="left-box" id="playerDetail">
                            <div class="inner">

                                <div class="pdSRC">
                                    <p class="pull-left"> From DVD <a href="/dvds/{{ $content_dvds->first()->id }}">{{ $content_dvds->first()->title }}</a> </p>
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style pull-right">
                                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_google_plus"></a>
                                    </div>
                                    <script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
                                    <!-- AddToAny END -->
                                </div>
                                <div class="top">
                                    <div class="controls">
                                        <div class="pdLeft">
                                            <div class="rating">
                                                <div class="voting" data-id="5:2969312">
                                                    <div class="vote-bar-wrapper">
                                                        <span class="vote-bar" style="width: 0%;"></span>
                                                    </div>
                                                    <div class="row">
                                                        <a class="up" href="#"><i class="fa fa-thumbs-o-up"></i></a>
                                                        <a class="down" href="#"><i class="fa fa-thumbs-o-down"></i></a>
                                                    </div>
                                                </div> {{ ($content->rating / 5) * 100 }}% Like, {{ $content->views * 3 }} Votes
                                            </div>
                                            <div class="favor">
                                                <a href="#" class="favorite add-to-favorites" data-is-favorite="{{$is_favorite}}" @if($is_favorite)disabled @endif><i class="fa fa-heart"></i></a> 0 favorites
                                            </div>
                                        </div>
                                        <div class="views">{{ $content->fake_views}} views <span>Added {{ date('d F Y', strtotime($content->formatted_date) ) }}</span>
                                        </div>
                                    <div class="menu"><!--
                                        <a href="#flag"><i class="icon-flag"></i></a>
                                        <a href="#playlist">Playlists</a>
                                        <a href="#embed" class="mhide">Embed</a>-->
                                        <div class="dropWrap"> <a href="#drop" class="dl">Download <span></span></a>
                                            <div class="drop">
                                                <ul>
                                                    @if(count($videos) > 0)
                                                    @foreach($videos as $video)
                                                    @foreach($video->downloads as $download)
                                                    <li>
                                                        <a href="{{ url('download/'.$content->id.'/'.$video->id.'/'.$download) }}"><span class="desc">{{ $download }} Video</span>
                                                            <span class="quality">1080p HD</span>
                                                            <span class="size">502mb</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @endforeach
                                                    @endif

                                                    @if(count($photos) > 0)
                                                    @foreach($photos as $photo)
                                                    <li>
                                                        <a href="{{ url('download-zip/'.$content->id.'/'.$photo->id) }}"><span class="desc">Download Photos Zip</span>
                                                            <span class="quality">1080p HD</span>
                                                            <span class="size">502mb</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-playlist" class="tabContent addPlaylist">
                                        <h3>Add to playlist</h3>
                                        <p>Click on an existing playlist to add this scene, or create a new playlist below.</p>
                                        <ul>
                                            <li>
                                                <a href="#add" data-id="593662"><i class="icon-checkmark"></i> My Playlist (<span>1</span>)</a>
                                                <a href="/cute-teen-with-a-nice-smile-wants-to-show-off-her-dick-suckin-1493758?pl=593662" class="play-link"><i class="icon-play"></i></a>
                                            </li>
                                        </ul>
                                        <h3>New Playlist</h3>
                                        <form>
                                            <input type="text" name="name" placeholder="Playlist name" autocomplete="off">
                                            <input type="submit" value="New Playlist"><span class="msg main"></span>
                                        </form>
                                    </div>
                                    <div id="tab-flag" class="tabContent flag">
                                        <form action="/" method="post" class="row">
                                            <div class="radios"> <p>Flag or report this video:</p>

                                                <fieldset>
                                                    <div>
                                                        <input type="radio" name="reason_id" value="1">
                                                        <label for="inappropriate">Inappropriate</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="reason_id" value="2">
                                                        <label for="inappropriate">Underage</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="reason_id" value="3">
                                                        <label for="inappropriate">Copyrighted Material</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="reason_id" value="4">
                                                        <label for="inappropriate">Broken video / images</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="reason_id" value="5">
                                                        <label for="inappropriate">Other</label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="additional">
                                                <p>Additional information (optional):</p>
                                                <textarea name="reason"></textarea>
                                                <input type="submit" class="btn primary" value="Send">
                                            </div>
                                            <span class="msg main"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="description">
                                <a href="/dvds/{{ $content_dvds->first()->id }}" class="sitelogo dvd-cover">
                                    <img src="{{ $content_dvds->first()->front_cover }}" alt="{{ $content_dvds->first()->title }}"></a>
                                    <p>{!! $content->description !!}</p>
                                    <a class="trigger-text btn primary" href="#" style="display: none;">Read more</a>
                                </div>
                                <div class="information">
                                    <div class="data">
                                        <div class="models-wrapper actors">
                                            @foreach($content_models as $model)
                                            <a class="model" href="/model/{{ $model->id }}/{{ str_slug($model->name) }}"><img src="{{ $model->thumb }}" alt="{{ $model->name }}"><span>{{ $model->name }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="comments">
                                        <!-- Comments
                                        ============================================= -->
                                        <div id="comments" class="clearfix">

                                            <div class="clear"></div>

                                            <div id="respond" class="clearfix">

                                                <form class="clearfix" action="#" method="post" id="commentform">

                                                    <div class="col_full">
                                                        <label for="author">Username</label>
                                                        <input type="text" name="author" id="author" value="{{ \Request::server('PHP_AUTH_USER') }}" size="22" tabindex="1" class="sm-form-control"  readonly>
                                                    </div>

                                                    <div class="clear"></div>

                                                    <div class="col_full">
                                                        <label for="comment">Comment</label>
                                                        <textarea id="comment" name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                                                    </div>

                                                    <div class="col_full nobottommargin">
                                                        <button name="submit" type="button" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin">Submit Comment</button>
                                                    </div>

                                                </form>

                                            </div><!-- #respond end -->

                                            <ol id="commentslist" class="commentlist clearfix">
                                                @include('lh::content.comments_list')
                                            </ol><!-- .commentlist end -->

                                        </div><!-- #comments end -->
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-3">
                        @if(count($similar) > 0)
                        <!-- Related Portfolio Items -->
                        <h3 class="text-center">Related Videos</h3>
                        <div id="related-portfolio"  class="sidebar-list">
                            <div class="row scenes-list">
                                @foreach($similar as $similar)
                                <div class="col-md-6">
                                    <div class="inner">
                                        <div class="thumb-wrapper">
                                            <a href="{{ $similar->link }}">
                                                <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                                                <img class="thumb" src="{{ $similar->thumb }}" srcset="{{ $similar->thumb }} 165w, {{ $similar->thumb }} 340w, {{ $similar->thumb }} 680w" sizes="(max-width: 36em) 50vw, (min-width: 52em) 33vw, 25vw" alt="{{ $similar->title }}">
                                            </a>
                                        </div>
                                        <div class="main-meta">
                                            <div class="title-wrapper">
                                                <a href="{{ $similar->link }}" class="title">{{ $similar->title }}</a>
                                            </div>
                                            <div class="extra-meta">
                                                <div class="inner">
                                                    <span class="time"><i class="fa fa-time"></i> {{ $similar->duration }}</span>
                                                    <span class="views"><i class="fa fa-eyes"></i> {{ $similar->fake_views }}</span>
                                                    <span class="rating"><i class="fa fa-thumbs-up"></i> {{ ($similar->rate / 5) * 100 }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div><!-- .portfolio-carousel end -->
                        @endif
                    </div>

                </div>

            </section><!-- #content end -->

            <script type="text/javascript">

            jQuery(document).ready(function($) {

                $("#rating").rating({
                    glyphicon: false,
                    ratingClass: "rating-fa",
                    showClear: false,
                    showCaption: false,
                    size: "xs",
                    @if($has_rated)
                    readonly: true,
                    @endif
                });

                $('#rating').on('rating.change', function(event, value, caption) {
                    $.post("{{ url('rate') }}", { id: {{ $content->id }}, rating: value });
                });

                $('#submit-button').click(function(){
                    $.post("{{ url('comment') }}", { id: {{ $content->id }}, username: $('#author').val(), message: $('#comment').val() }, function(data){
                        $('#commentslist').html(data);
                        $('#comment').val('');
                    });
                });

                var doingAjax = false;

                $('.add-to-favorites').on('click', function(event) {
                    event.preventDefault();

                    if (doingAjax) {
                        return;
                    }

                    var $this = $(this),
                    isFavorite = $this.data('is-favorite');

                    if (isFavorite) {
                        return;
                    }

                    doingAjax = true;

                    $.ajax({ method: 'POST', url: '{{ url('favorites') }}', data: { content_id: '{{ $content->id }}' } }).done(function(response) {
                        if (response.success) {
                            $this.text('Added to Favorites');
                        }

                        if (response.message) {
                            window.alert(response.message);
                        }
                        doingAjax = false;
                    });
                });

            });

</script>
<script type="text/javascript">

jQuery(document).ready(function($){

    $('.portfolio-container').pajinate({
        items_per_page : 8,
        item_container_id : '#portfolio',
        nav_panel_id : '.pagination-container ul',
        show_first_last: false
    });

    $( '.pagination a' ).click(function() {
        var t=setTimeout(function(){ $( '.flexslider .slide' ).resize(); },1000);
    });

});

</script>
@stop
