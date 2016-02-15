<article class="portfolio-item @if($content->has_photos) pf-photos @endif @if($content->has_videos) pf-videos @endif">

    <div class="portfolio-image">
        <div class="fxslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="slide" data-pagi="false" data-hover="true">
            <div class="flexslider-custom">
                <div class="slider-wrap">
                    <div class="slide"><a href="{{ $content->link }}"><img src="{{ $content->thumb }}"></a></div>
                    @foreach($content->thumbs as $thumb)
                    <div class="slide"><a href="{{ $content->link }}"><img src="{{ $thumb }}"></a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-desc">
        <h3><a href="{{ $content->link }}">{{ $content->title }}</a></h3>
        <span>
            <ul class="entry-meta clearfix">
                @foreach($content->sites()->ofNetwork($network->id)->get() as $content_site)
                <li>
                    <i class="icon-folder-open-alt"></i> <a href="{{ $content_site->link }}">{{ $content_site->name }}</a>
                </li>
                @endforeach
            </ul>
        </span>
        <span>
            <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i> {{ $content->formatted_date }}</li>
                <li><a href="{{ $content->link }}#comments"><i class="icon-comments"></i> {{ $content->comments()->count() }}</a></li>
            </ul>
        </span>
        <span>
            <ul class="entry-meta clearfix">
                <li>
                <i class="icon-folder"></i>
                @foreach($content->dvd_series as $series)
                    <a href="{{ $series->link }}">{{ $series->title }}</a> /
                @endforeach
                </li>
                @if($content->has_videos)
                <li><a href="{{ $content->link }}#video-content"><i class="icon-film"></i> {{ $content->videos_duration }}</a></li>
                @endif
                @if($content->has_photos)
                <li><a href="{{ $content->link }}#photo-content"><i class="icon-picture"></i> {{ $content->photos_count }}</a></li>
                @endif
            </ul>
        </span>
    </div>
</article>