@extends('ypp::layout')

@section('page_header_includes')
<link rel="stylesheet" href="{{ \Theme::asset('css/daterangepicker.css') }}" type="text/css" />
@stop

@section('content')

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        @include('ypp::includes.breadcrumbs')
        <div class="container clearfix">
            
           <form class="form-inline">
            <!--
              <div class="form-group">
                <label>Published On:</label>
                <input type="text" name="daterange" class="form-control" />
              </div>
            -->
              <div class="form-group">
                <select name="site_id" class="form-control">
                    <option value="">All Sites</option>
                    @foreach($network_sites as $site)
                    <option value="{{ $site->id }}" @if(\Request::get('site_id','') == $site->id ) selected @endif >{{ $site->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="photos" @if(\Request::get('type','') == 'photos') selected @endif >Has Photos</option>
                    <option value="videos" @if(\Request::get('type','') == 'videos') selected @endif >Has Videos</option>
                </select>
              </div>

              <button type="submit" class="btn btn-default">Filter</button>
            </form>
            <div class="clear"></div>
            
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
                    @include('ypp::includes.content_thumb')
                @endforeach
                

            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $contents->render() !!}
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

                });

            </script><!-- Portfolio Script End -->

        </div>

    </div>

</section><!-- #content end -->

@stop

@section('page_footer_includes')
<script type="text/javascript" src="{{ \Theme::asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ \Theme::asset('js/daterangepicker.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('input[name="daterange"]').daterangepicker();
});
</script>
@stop
@stop
