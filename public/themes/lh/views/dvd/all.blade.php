@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
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
<section id="content sites">

    <div class="content-wrap">
        <div class="container clearfix">
            <div class="item-container site-banner">
                <img src="{{ \Theme::asset('img/img-header-sites-large.jpg') }}" class="img-responsive center-block">
            </div>

            <h2 class="box-title">Exclusive Lethal Sites</h2>
            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($sites as $site)
                <article class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="{{ $site->link }}">
                            <img src="{{ $site->top_thumb }}" alt="{{ $site->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $site->link }}">{{ $site->name }}</a></h3>
                        <span>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-film"></i> {{ $site->video_duration }}</li>
                                <li><i class="icon-picture"></i> {{ $site->photo_count }}</li>
                            </ul>
                        </span>
                    </div>
                </article>
                @endforeach


            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $sites->render() !!}
            </div>

        </div>

    </div>

</section><!-- #content end -->

@stop
