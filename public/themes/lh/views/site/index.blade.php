@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
</style>
<!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">
            <div class="container clearfix notopmargin">

                <div class="widget clearfix">
                    @component_advertisement('sidebar')
                </div>

                <h2 class="box-title">New Exclusive High Definition Videos </h2>

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

                <div class="widget clearfix">
                    @component_advertisement('sidebar')
                </div>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(".slide").each(function(){
            $(this).hover(function(){
                $(this).find(".play-button").show();
            },function(){
                $(this).find(".play-button").hide();
            });
        });

    </script>
    @stop
