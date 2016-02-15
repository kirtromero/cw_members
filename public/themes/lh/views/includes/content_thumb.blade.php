<article class="portfolio-item @if($content->has_photos) pf-photos @endif @if($content->has_videos) pf-videos @endif">

    <div class="portfolio-image">
        <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
            <a href="{{ $content->link }}">
                <div class="flexslider-custom">
                    <span class="exclusive">New</span>
                    <span class="hd">HD</span>
                    <div class="slider-wrap">
                        <div class="slide">
                            <a href="{{ $content->link }}">
                            <img class="play-button" src="{{ \Theme::asset('img/icon-play.svg') }}" alt="">
                            <img src="{{ $content->thumb }}">
                        </a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="portfolio-desc">
        <h3><a href="{{ $content->link }}">{{ $content->title }}</a></h3>
        <span>
            <ul class="entry-meta clearfix">
                @foreach($content->sites()->ofNetwork($network->id)->get() as $content_site)
                <li>
                    <i class="icon-folder-open-alt"></i> Series: <a href="{{ $content_site->link }}">{{ $content_site->name }}</a>
                </li>
                @endforeach
            </ul>
        </span>
        <div class="clearfix"></div>
        <span>
            <ul class="entry-meta clearfix item-basic-info">
                <li><i class="icon-calendar3"></i> {{ $content->formatted_date }}</li>
                <li class="text-center"><a href="{{ $content->link }}#comments"><i class="icon-comments"></i> {{ $content->comments()->count() }}</a></li>
                @if($content->has_videos)
                <li class="text-right"><a href="{{ $content->link }}#video-content"><i class="icon-film"></i> {{ $content->videos_duration }}</a></li>
                @endif
                @if($content->has_photos)
                <li class="text-right"><a href="{{ $content->link }}#photo-content"><i class="icon-picture"></i> {{ $content->photos_count }}</a></li>
                @endif
            </ul>
        </span>
        <div class="clearfix"></div>
    </div>
</article>
