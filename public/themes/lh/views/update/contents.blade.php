@extends('lh::layout')

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('lh::includes.breadcrumbs')
        <div class="container clearfix">

            @if($show_filter)
            <!-- Portfolio Filter
            ============================================= -->
            <ul id="portfolio-filter" class="clearfix">

                <li class="activeFilter"><a href="#" data-filter="*">Show All Updates</a></li>
                <li><a href="#" data-filter=".pf-photos">Updates with Photos</a></li>
                <li><a href="#" data-filter=".pf-videos">Updates with Videos</a></li>

            </ul><!-- #portfolio-filter end -->

            <div id="portfolio-shuffle">
                <i class="icon-random"></i>
            </div>

            <div class="clear"></div>
            @endif

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($contents as $key => $content)
                    @include('lh::includes.content_thumb')
                @endforeach


            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $contents->render() !!}
            </div>

        </div>

    </div>

</section><!-- #content end -->

@stop
