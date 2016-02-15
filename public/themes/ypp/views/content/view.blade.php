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
                            <h2>{{ $content->title }}</h2>
                        </div><!-- .entry-title end -->

                        <ul class="entry-meta clearfix">
                            @if($content->has_videos)
                            <li><a href="#video-content" data-scrollto="#video-content"><i class="icon-film"></i> {{ $content->videos_duration }}</a></li>
                            @endif
                            @if($content->has_photos)
                            <li><a href="#photo-content" data-scrollto="#photo-content"><i class="icon-picture"></i> {{ $content->photos_count }}</a></li>
                            @endif
                            <li><a href="#comments" data-scrollto="#comments"><i class="icon-comments"></i> {{ $content->comments()->count() }}</a></li>
                        </ul><!-- .entry-meta end -->
                    </div>
                    <div class="col_one_third nobottommargin">

                        <!-- Portfolio Single - Meta
                        ============================================= -->
                        <div class="panel panel-default events-meta">
                            <div class="panel-body">
                                <ul class="portfolio-meta nobottommargin">
                                    <li>
                                        <span><i class="icon-star"></i>Rating:</span>
                                        <input id="rating" value="{{ $content->rating }}" />
                                    </li>
                                    <li><span><i class="icon-calendar3"></i>Published:</span> {{ $content->formatted_date }}</li>
                                    <li><span><i class="icon-bookmark"></i>Site:</span> 
                                        @foreach($content_sites as $site)
                                            <a href="{{ url('site/'.$site->domain) }}">{{ $site->name }}</a> /
                                        @endforeach
                                    </li>
                                    <li><span><i class="icon-users"></i>Models:</span>
                                        @foreach($content_models as $model)
                                            <a href="{{ $model->link }}">{{ $model->name }}</a> /
                                        @endforeach
                                    </li>
                                    <li><span><i class="icon-line-disc"></i>DVDs:</span>
                                        @foreach($content_dvds as $dvd)
                                            <a href="{{ $dvd->link }}">{{ $dvd->title }}</a> /
                                        @endforeach
                                    </li>
                                    <li>
                                        <button class="add-to-favorites btn btn-default" data-options="{{ json_encode(['url'=>url('favorites'),'type'=>'content','id'=>$content->id]) }}" data-is-favorite="{{$is_favorite}}">@if($is_favorite) Added to Favorites @else Add to Favorites @endif</button>
                                        @if($content->has_videos)
                                        <button class="add-to-playlist btn btn-default" data-options="{{ json_encode(['url'=>url('playlist'),'id'=>$content->id]) }}">Add to Playlist</button>
                                        @endif
                                    </li>
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
                            {!! $content->description !!}
                            <!-- Tag Cloud
                            ============================================= -->
                            <div class="tagcloud clearfix bottommargin">
                                @foreach($content_tags as $tag)
                                    <a href="{{ $tag->link }}"><i class="icon-tag"></i> {{ $tag->name }}</a>
                                @endforeach
                            </div><!-- .tagcloud end -->

                            <div class="clear"></div>
                        </div>


                        <!-- Portfolio Single - Description End -->

                    </div><!-- .portfolio-single-content end -->

                    <div class="clear"></div>

                    @if($content->has_videos)
                    <div class="col_full">
                        <form id="playlist-control">
                            <div class="current-list-wrap form-inline">
                                <input type="radio" name="in_playlist" value="playlist" checked>
                                <select class="form-control" name="current_list">
                                    <option value="">Select a Playlist</option>
                                    @foreach($playlists as $list_item)
                                    <option value="{{ $list_item->id }}">{{ $list_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="new-list-wrap form-inline">
                                <label><input type="radio" name="in_playlist" value="new-list"> Create a New List</label>
                                <input type="text" class="form-control" name="new_list_name" placeholder="New Playlist Name">
                                <span class="visibility-wrap">
                                    Visibility
                                    <select class="form-control" name="new_list_visibility">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
                                </span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-default add">Add this to the selected list</button>
                            </div>
                        </form>

                        <script type="text/javascript">
                            jQuery(document).ready(function($){

                                var form = $("#playlist-control"),
                                    doingAjax = false;

                                $(".add-to-playlist").on("click", function(){
                                    form.toggleClass("show");
                                });

                                form
                                    .on("click", ".add", function(event) {
                                        event.preventDefault();

                                        if (doingAjax) {
                                            return;
                                        }

                                        var data = {
                                            type: form.find("input[name='in_playlist']").filter(":checked").val(),
                                            current_list: form.find("select[name='current_list']").val(),
                                            new_list_name: form.find("input[name='new_list_name']").val(),
                                            list_visibility: form.find("select[name='new_list_visibility']").val(),
                                            _token: '{{ csrf_token() }}',
                                            content_id: '{{ $content->id }}'
                                        };

                                        doingAjax = true;

                                        $.ajax({method: 'POST', url: '{{ url('playlists') }}', data: data}).done(function(response) {
                                            if (response.success) {
                                                form.toggleClass("show");
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
                    @endif

                    <div class="divider divider-center" id="video-content"><i class="icon-circle"></i></div>

                    @foreach($videos as $video)
                    <div class="col_full portfolio-single-content clearfix">
                        @include('ypp::content.videoplayer')
                    </div>
                    <div class="divider divider-center" id="photo-content"><i class="icon-circle"></i></div>
                    @endforeach

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


                    <div class="divider divider-center"><i class="icon-circle"></i></div>
                    @endif

                    <div class="col_full portfolio-single-content clearfix text-center">
                        @if(count($videos) > 0)
                            @foreach($videos as $video)
                                @foreach($video->downloads as $download)
                                    
                                    <a href="{{ url('download/'.$content->id.'/'.$video->id.'/'.$download) }}" class="button piwik_download">Download {{ $download }} Video</a>&nbsp;
                                    
                                @endforeach
                            @endforeach
                        @endif

                        @if(count($photos) > 0)
                            @foreach($photos as $photo)
                            <a href="{{ url('download-zip/'.$content->id.'/'.$photo->id) }}" class="button piwik_download">Download Photos Zip</a>&nbsp;
                            @endforeach
                        @endif
                    </div>

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    @if(!empty($on_dvd))
                    <!-- Related Portfolio Items
                    ============================================= -->
                    <h4>DVD : <a href="{{ $dvd->link }}">{{ $dvd->title }}</a></h4>

					<div class="row">
						<div class="col-lg-3">
							<p><img src="{{ $dvd->front_cover }}" width="100%" height="auto"></p>
						</div>
						<div class="col-lg-9">
							<ul class="portfolio-meta nobottommargin">
                                <li>
                                    <span><i class="icon-star"></i>Rating:</span>
                                    <input id="dvd-rating" value="{{ $dvd->rating }}" />
                                </li>
                                <li><span><i class="icon-users"></i>Models:</span>
                                    @foreach($dvd->models()->get() as $model)
                                        <a href="{{ $model->link }}">{{ $model->name }}</a> /
                                    @endforeach
                                </li>
                                <li><span><i class="icon-folder"></i>Series:</span>
                                    @foreach($dvd->series()->get() as $item)
                                        {{ $item->title }} /
                                    @endforeach
                                </li>
								<li><span><i class="icon-time"></i>Video Duration:</span>
									{{ $dvd->video_duration }}
								</li>
                            </ul>
						</div>
					</div>

                    <h5>More from this DVD:</h5>

                    <div id="from-dvd" class="owl-carousel portfolio-carousel">
                        @foreach($dvd_contents as $dvd_content)
                        <div class="oc-item @if ($dvd_content->id == $content->id) active @endif">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="{{ $dvd_content->link }}?pl=dvd:{{ $dvd->id }}">
                                        <img src="{{ $dvd_content->thumb }}">
                                    </a>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{ $dvd_content->link }}?pl=dvd:{{ $dvd->id }}">{{ $dvd_content->title }}</a></h3>
                                    <span>
	                                    <ul class="entry-meta clearfix">
	                                        @if($dvd_content->has_videos)
	                                        <li><a href="{{ $dvd_content->link }}#video-content"><i class="icon-film"></i> {{ $dvd_content->videos_duration }}</a></li>
	                                        @endif
	                                    </ul>
	                                </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- .portfolio-carousel end -->

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    <script type="text/javascript">

                        jQuery(document).ready(function($) {

                            var fromDVD = $("#from-dvd"),
                                player = jwplayer("mediaplayer{{ $type }}");

                            fromDVD.owlCarousel({
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

                            $("#dvd-rating").rating({
                                glyphicon: false,
                                ratingClass: "rating-fa",
                                showClear: false,
                                showCaption: false,
                                size: "xs",
                                readonly: true
                            });

                            player.play();
                            player.onPlaylistComplete(function() {
                                var nextScene = fromDVD.find(".oc-item").filter(".active").closest(".owl-item").next(".owl-item");

                                if(nextScene.length) {
                                    window.location = nextScene.find("a").first().attr("href");
                                }
                            });

                            window.location.hash = "#video-content";
                        });

                    </script>
                    @endif

                    @if(!empty($on_playlist))
                    <!-- Related Portfolio Items
                    ============================================= -->
                    <h4>{{ $playlist->name }} Playlist</h4>

                    <h5>More from this Playlist:</h5>

                    <div id="from-playlist" class="owl-carousel portfolio-carousel">
                        @foreach($playlist_contents as $palylist_content)
                        <div class="oc-item @if ($palylist_content->id == $content->id) active @endif">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="{{ $palylist_content->link }}?pl=member:{{ $playlist->id }}">
                                        <img src="{{ $palylist_content->thumb }}">
                                    </a>
                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{ $palylist_content->link }}?pl=member:{{ $playlist->id }}">{{ $palylist_content->title }}</a></h3>
                                    <span>
                                        <ul class="entry-meta clearfix">
                                            @if($palylist_content->has_videos)
                                            <li><a href="{{ $palylist_content->link }}#video-content"><i class="icon-film"></i> {{ $palylist_content->videos_duration }}</a></li>
                                            @endif
                                        </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- .portfolio-carousel end -->

                    <div class="divider divider-center"><i class="icon-circle"></i></div>

                    <script type="text/javascript">

                        jQuery(document).ready(function($) {

                            var fromPlaylist = $("#from-playlist"),
                                player = jwplayer("mediaplayer{{ $type }}");

                            fromPlaylist.owlCarousel({
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

                            player.play();
                            player.onPlaylistComplete(function() {
                                var nextScene = fromPlaylist.find(".oc-item").filter(".active").closest(".owl-item").next(".owl-item");

                                if(nextScene.length) {
                                    window.location = nextScene.find("a").first().attr("href");
                                }
                            });

                            window.location.hash = "#video-content";
                        });

                    </script>
                    @endif

                    <!-- Comments
                    ============================================= -->
                    <div id="comments" class="clearfix">

                        <h3 id="comments-title"><span>{{ $content->comments()->count() }}</span> Comments</h3>
                        
                         <!-- Comments List
                        ============================================= -->
                        <ol id="commentslist" class="commentlist clearfix">
                        @include('ypp::content.comments_list')
                        </ol><!-- .commentlist end -->

                        <div class="clear"></div>

                        <!-- Comment Form
                        ============================================= -->
                        <div id="respond" class="clearfix">

                            <h3>Leave a <span>Comment</span></h3>

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

                    </div><!-- #comments end -->

                    <div class="divider divider-center" id="photo-content"><i class="icon-circle"></i></div>

                    @if(count($similar) > 0)
                    <!-- Related Portfolio Items
                    ============================================= -->
                    <h4>Related Content:</h4>

                    <div id="related-portfolio" class="owl-carousel portfolio-carousel">
                        @foreach($similar as $similar)
                        <div class="oc-item">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="{{ $similar->link }}">
                                        <img src="{{ $similar->thumb }}">
                                    </a>

                                </div>
                                <div class="portfolio-desc">
                                    <h3><a href="{{ url('view/'.$similar->id) }}">{{ $similar->title }}</a></h3>
                                    @include('ypp::ratings.'.$similar->rating_view)
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

                        });

                    </script>

                </div>

            </div>

        </section><!-- #content end -->

@stop
