@extends('ypp::layout')

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('ypp::includes.breadcrumbs')
        <div class="container clearfix">

            <div class="clearfix">
                <div class="entry-title">
                    <h2>{{ $model->name }}</h2>
                </div><!-- .entry-title end -->

                <ul class="entry-meta clearfix">
                    <li><button class="add-to-favorites btn btn-default" data-options="{{ json_encode(['url'=>url('favorites'),'type'=>'model','id'=>$model->id]) }}" data-is-favorite="{{$is_favorite}}">@if($is_favorite) Added to Favorites @else Add to Favorites @endif</button></li>
                </ul><!-- .entry-meta end -->
            </div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="clearfix">
                @foreach($contents as $content)
                    @include('ypp::includes.content_thumb')
                @endforeach
            </div><!-- #portfolio end -->

            <!-- Portfolio Script
            ============================================= -->
            <script type="text/javascript">

                jQuery(window).load(function(){

                    var $container = $('#portfolio');

                    $container.isotope({ transitionDuration: '0.65s' });

                    $(window).resize(function() {
                        $container.isotope('layout');
                    });
                    
                });

            </script><!-- Portfolio Script End -->

        </div>

    </div>

</section><!-- #content end -->

@stop
