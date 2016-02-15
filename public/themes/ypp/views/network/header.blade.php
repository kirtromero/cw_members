<!-- Header
============================================= -->
<header id="header" class="sticky-stlye-2 dark transparent-header">
@if(isset($show_network_header) && $show_network_header == true)
        <img src="{{ \Theme::asset('img/header.jpg') }}" class="img-responsive">
@endif
    <div id="header-wrap" class="dark">
        

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="style-2 dark">
                <div class="container clearfix">
                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                    <ul>
                        <li class="current"><a href="{{ url('/') }}"><div>Home</div></a></li>

                        <li><a href="{{ url('updates') }}"><div>Updates</div></a>
                            <ul>
                                <li><a href="{{ url('updates/photos') }}"><div>Updates with Photos</div></a></li>
                                <li><a href="{{ url('updates/videos') }}"><div>Updates with Videos</div></a></li>
                            </ul>
                        </li>
                        
                        <li><a href="{{ url('all-sites') }}"><div>Sites</div></a>
                            <ul>
                            @foreach($network_sites as $key => $site)

                                <li><a href="{{ $site->link }}"><div>{{ $site->name }}</div></a></li>
                            
                            @endforeach
                            </ul>
                        </li>

                        <li><a href="{{ url('tags') }}"><div>Popular Tags</div></a>
                            <ul>
                            @foreach($most_used_tags_in_network as $key => $tag)

                                <li><a href="{{ $tag->link }}"><div>{{ $tag->name }} ({{ $tag->C }})</div></a></li>
                            
                            @endforeach
                            </ul>
                        </li>

                        <li><a href="{{ url('models') }}"><div>Popular Models</div></a>
                            <ul>
                            @foreach($most_used_models_in_network as $key => $model)

                                <li><a href="{{ $model->link }}"><div>{{ $model->name }} ({{ $model->C }})</div></a></li>
                            
                            @endforeach
                            </ul>
                        </li>

                        <li><a href="{{ url('favorites') }}"><div>Favorites</div></a></li>

                        <li><a href="{{ url('playlists') }}"><div>My Playlists</div></a></li>

                        <li><a href="{{ url('dvds') }}"><div>DVDs</div></a></li>
                        
                    </ul>

                    <!-- Top Search
                    ============================================= -->
                    <div id="top-search">
                        <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                        <form action="{{ url('search') }}" method="get">
                            <input type="text" name="q" class="form-control" autocomplete="off" placeholder="Type &amp; Hit Enter.." data-preview-url="{{ url('search-preview') }}">
                            <div class="search-ajax-results">
                            </div>
                        </form>
                    </div><!-- #top-search end -->

                </div>
                 

            </nav><!-- #primary-menu end -->
        
        </div>

</header><!-- #header end -->
