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

            <div class="container clearfix">

                <div class="item-container top-banner">
                    <img src="{{ \Theme::asset('img/img-header-stars-medium.jpg') }}" class="img-responsive center-block">
                </div>


                <div class="content-sub-header content-wrapper">
                    <div class="inner">
                        <div class="heading"><h1>Lethal Hardcore Porn Stars</h1></div>
                        <div class="sorting">
                            <div class="level-1-sorts">
                                <a class="btn primary btndropdown" href="#dropsort">Most Popular<i class="icon-arrow-circle-down"></i></a>
                                <ul style="display: none" id="dropsort" class="ddn">
                                    <li><a href="/pornstars?o=d">Newest</a></li>
                                    <li><a href="/pornstars?o=r">Top Rated</a></li>
                                    <li><a href="/pornstars?o=v">Most Viewed</a></li>
                                    <li><a href="/pornstars?o=f" class="active">Most Popular</a></li>
                                </ul>
                            </div>
                            <div class="level-1-sorts">
                                <a class="btn primary btndropdown" href="#dropsortdate">This Month<i class="arrow-down"></i></a>
                                <ul style="display: none"  id="dropsortdate"  class="ddn">
                                    <li><a href="/models?o=f1">Today</a></li>
                                    <li><a href="/models?o=f7">This Week</a></li>
                                    <li><a href="/models" class="active">This Month</a></li>
                                    <li><a href="/models?o=f">All Time</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alpha-sorter">
                    <ul>
                        <li><a href="/models" class="active">All</a></li>
                        <li><a href="/models?l=A">A</a></li>
                        <li><a href="/models?l=B">B</a></li>
                        <li><a href="/models?l=C">C</a></li>
                        <li><a href="/models?l=D">D</a></li>
                        <li><a href="/models?l=E">E</a></li>
                        <li><a href="/models?l=F">F</a></li>
                        <li><a href="/models?l=G">G</a></li>
                        <li><a href="/models?l=H">H</a></li>
                        <li><a href="/models?l=I">I</a></li>
                        <li><a href="/models?l=J">J</a></li>
                        <li><a href="/models?l=K">K</a></li>
                        <li><a href="/models?l=L">L</a></li>
                        <li><a href="/models?l=M">M</a></li>
                        <li><a href="/models?l=N">N</a></li>
                        <li><a href="/models?l=O">O</a></li>
                        <li><a href="/models?l=P">P</a></li>
                        <li><a href="/models?l=Q">Q</a></li>
                        <li><a href="/models?l=R">R</a></li>
                        <li><a href="/models?l=S">S</a></li>
                        <li><a href="/models?l=T">T</a></li>
                        <li><a href="/models?l=U">U</a></li>
                        <li><a href="/models?l=V">V</a></li>
                        <li><a href="/models?l=W">W</a></li>
                        <li><a href="/models?l=X">X</a></li>
                        <li><a href="/models?l=Y">Y</a></li>
                        <li><a href="/models?l=Z">Z</a></li>
                    </ul>
                </div>

            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="portfolio-masonry clearfix">
                @foreach($models as $model)
                <article class="portfolio-item">
                    <div class="slide portfolio-image">
                        <a href="{{ $model->link }}">
                            <img style="display:none" class="play-button" src="{{ Theme::asset('img/icon-play.svg') }}" alt="">
                            <img src="{{ $model->thumb }}" alt="{{ $model->name }}">
                        </a>
                    </div>
                    <div class="portfolio-desc">
                        <h3><a href="{{ $model->link }}">{{ $model->name }}</a></h3>
                        <div class="clearfix"></div>
                        <span>
                            <ul class="entry-meta clearfix item-basic-info">
                                <li class="text-left"><i class="icon-film"></i> {{ $model->video_duration }}</li>
                                <li class="text-left"><i class="fa fa-eye"></i> {{ $model->photo_count }}</li>
                                <li class="text-center"><i class="fa fa-thumbs-o-up"></i> {{ ($model->rating / 5) * 100 }}%</li>
                            </ul>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </article>
                @endforeach


            </div><!-- #portfolio end -->

            <div class="clearfix text-center">
                {!! $models->render() !!}
            </div>

    </div>

</div>

</section><!-- #content end -->

@stop
