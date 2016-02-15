@extends('lh::layout')

@section('content')
<style type="text/css">
.breadcrumb-container {
    display: none;
}
.portfolio-item {
    width: 14.25%
}
</style>
<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        <div class="container clearfix">

            <div class="content-sub-header content-wrapper">
                <div class="inner">
                    <div class="heading"><h1>All Lethal Categories</h1></div>
                </div>
            </div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($tags as $tag)
                <article class="portfolio-item">
                    <div class="portfolio-image">
                        <a href="{{ $tag->link }}">
                            <img src="{{ $tag->top_thumb }}" alt="{{ $tag->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <div class="clearfix"></div>
                        <h3><a href="{{ $tag->link }}">{{ $tag->name }} <span>({{ $tag->dvd_count}})</span></a></h3>
                        <span>
                            <ul class="entry-meta clearfix">
                                <li><i class="icon-film"></i> {{ $tag->video_count }}</li>
                                <li class="text-right"><i class="icon-picture"></i> {{ $tag->photo_count }}</li>
                            </ul>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </article>
                @endforeach


            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $tags->render() !!}
            </div>

        </div>

    </div>

</section><!-- #content end -->

@stop
