<!-- Header
============================================= -->
<header id="header" class="dark transparent-header no-sticky">
    <div id="header-wrap" class="dark">


            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="style-2 dark">
                <div class="container clearfix">
                    <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
                    <ul style="display:none">
                        <li><span>NETWORK SITES:</span></li>

                        <li><a href="#">Wankz</a></li>

                        <li class="current"><a href="#">Lethal Hardcore</a></li>

                        <li><a href="#">Mega DVD Site</a></li>

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
<div class="clearfix"></div>
<div id="page-menu" class="no-sticky clearfix">

    <div id="page-menu-wrap">

        <div class="container clearfix">

            <div class="menu-title"><a href="/"><img src="{{ \Theme::asset('img/logo.svg') }}"></a></div>

            <nav>
                <ul>

                    <li class="pull-left logo"><a href="/"><img src="{{ \Theme::asset('img/logo.svg') }}"></a></li>
                    <li @if(Request::is('updates*')) class="current" @endif><a href="/updates/videos">HD Videos</a></li>
                    <li @if(Request::is('models*')) class="current" @endif><a href="/models">Pornstars</a></li>
                    <li @if(Request::is('tags*')) class="current" @endif><a href="/tags">Categories</a></li>
                    <li @if(Request::is('dvds*')) class="current" @endif><a href="/dvds">DVDs</a></li>
                    <!--<li @if(Request::is('live*')) class="current" @endif><a href="/live">Live Girls</a></li>-->
                    <li><a href="http://store.lethalhardcore.com/">Store</a></li>
                    <li class="pull-right">
                        <a href="#drop" class="members account-trigger">
                            <img src="http://images.lethalhardcore.com/profile/default/profile_small.jpg"> {{ isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : "Guest"  }} <i class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="account-opts ddn" style="display: block;">
                            <li><a href="/account">My account</a></li>
                            <li><a href="/account/videos">My favorites</a></li>
                            <li><a href="/account/my-playlists">My playlists</a></li>
                            <li><a href="/account/history">My history</a></li>
                            <li><a href="/logout">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        <div id="page-submenu-trigger"><i class="icon-reorder"></i></div>

        </div>

    </div>

</div><!-- #page-menu end -->
<div class="clearfix"></div>
@if(!Request::is('/'))
@include('lh::includes.breadcrumbs')
@endif
<div class="clearfix"></div>
