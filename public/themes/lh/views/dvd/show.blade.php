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

                <h3 class="box-title">{{ $dvd->title }}</h3>

                <div class="content-wrapper dvd-page-wrapper">
                   <div class="scenes-list row"> <h3>All scenes</h3>
                      @foreach($contents as $key => $content)
                      <div class="dvd-scene">
                        <div class="thumb-wrapper">
                           <a href="{{ $content->link }}">
                              <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                              <img src="{{ $content->thumb }}" class="thumb" >
                          </a>
                      </div>
                      <div class="meta">
                       <a href="{{ $content->link }}" class="title">{{ $content->title }}</a> <span class="label">Actors</span>
                       @foreach($content->models as $model)
                       <a class="actor" href="/model/{{ $model->id }}/{{ str_slug($model->name) }}">{{ $model->name }}</a>.
                       @endforeach

                       <hr class="separator">
                       <span class="time"><i class="fa fa-clock"></i> {{ $content->video_duration }}</span>
                       <span class="views"><i class="fa fa-eye"></i> {{ $content->fake_views }}</span>
                       <span class="rating"><i class="fa fa-thumbs-up"></i> {{ ($content->rating / 5) * 100}}</span>
                   </div>
               </div>
               @endforeach
               <div class="center">
                <a class="btn primary" href="#tg-playlist">Add these to your playlist</a>
            </div>
            <div id="tab-playlist" class="tabContent addPlaylist" style="display: none" data-id="1165140,1165142,1165144,1165146">
                <h3>Add to playlist</h3>
                <p>Click on an existing playlist to add this scene, or create a new playlist below.</p>
                <ul>
                   <li><a href="#add" data-id="593662"><i class="icon-checkmark"></i> My Playlist (<span>2</span>)</a><a href="{{ $dvd->link }}" class="play-link"><i class="icon-play"></i></a></li>
               </ul>
               <h3>New Playlist</h3>
               <form>
                   <input type="text" name="name" placeholder="Playlist name" autocomplete="off">
                   <input type="submit" value="New Playlist"><span class="msg main"></span>
               </form>
           </div>
       </div>
       <div class="dvd-box" data-id="1:896056">
         <div class="thumb">
            <a class="covers" href="{{ $dvd->link }}">
               <img class="front cover" src="{{ $dvd->front_cover }}">
               <img class="back cover" src="{{ $dvd->back_cover }}">
           </a>
           <hr class="separator">
       </div>
       <div class="meta">
        <span class="label text-left">Series</span>
        @foreach($series as $item)
        <a href="{{ $item->link }}" class="actor">{{ $item->title }}</a>
        @endforeach
        <span class="label text-left">Actors</span>
        @foreach($models as $model)
        <a href="{{ $model->link }}" class="actor">{{ $model->name }}</a>,
        @endforeach
        <span class="label text-left">Categories</span>
        @foreach($dvd->tags as $tag)
        <a href="{{ $tag->link }}" class="actor">{{ $tag->name }}</a>,
        @endforeach

        <span class="label text-left">Added</span><span class="date">{{ date("d M Y", strtotime($dvd->publish_date)) }}</span>
        <hr class="separator">
        <span class="time"><i class="icon-time"></i> {{ $dvd->duration }}</span>
        <span class="views"><i class="icon-views"></i> {{ $dvd->views }}</span>
        <span class="rating"><i class="icon-thumbs-up"></i> {{ ($dvd->rating / 5 ) * 100 }}</span>
        <hr class="separator">
        <div class="row">
           <div class="voting-wrapper">
               <div class="voting" data-id="1:896056">
                  <div class="vote-bar-wrapper">
                     <span class="vote-bar" style="width: 100%;"></span>
                 </div>
                 <div class="actions">
                     <a class="up" href="#"><i class="fa fa-thumbs-up"></i></a>
                     <a class="down" href="#"><i class="fa fa-thumbs-down"></i></a>
                 </div>
             </div>
         </div>
         <a href="#" class="favorite add-to-favorites"><i class="fa fa-heart"></i></a>
     </div>
     <hr class="separator">

 </div>
</div>
<div class="dvd-more small">
  <h3>More from this series</h3>

  @if(count($similar) > 0)

  <div class="row dvd-list">
    @foreach($similar as $similar)
    <div class="dvd">
        <div class="inner">
           <div class="thumb-wrapper">
              <a href="{{ $similar->link }}">
                 <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                  <div class="thumb">
                      <img src="{{ Theme::asset('img/thumb-dvd-trans.png') }}" alt="">
                      <span class="cover" style="background-image:url('{{ $dvd->front_cover }}')"></span>
                  </div>
                <div class="extra-thumbs">
                    @foreach($similar->contents as $key => $content)
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
             <a href="{{ $similar->link }}" class="title">{{ $similar->title }}</a>
             @if($series->first())
             <span class="series"><i class="icon-folder-open"></i> Series:
                <a href="{{ $series->first()->link }}">{{ $series->first()->title }}</a>
            </span>
            @endif
        </div>
        <div class="extra-meta">
         <div class="inner">
            <span class="time"><i class="fa fa-clock"></i> {{ $similar->video_duration }} </span>
        </div>
    </div>
</div>
</div>
</div>
@endforeach
@endif
</div>
<div class="row">
</div>
@if($series->first())
<div class="center">
    <a class="btn primary" href="{{ $series->first()->link }}">Browse All Series Titles</a>
</div>
@endif
</div>
</div>

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

        </script><!-- Portfolio Script End -->

    </div>

</div>

</section><!-- #content end -->

@stop
