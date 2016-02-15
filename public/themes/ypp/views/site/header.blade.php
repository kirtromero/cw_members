<img src="{{ \Theme::asset('img/header.jpg') }}" class="img-responsive" />
<!-- Page Sub Menu
============================================= -->
<div id="page-menu" class="no-sticky">

    <div id="page-menu-wrap">

        <div class="container clearfix">

            <div class="menu-title"></div>

            <nav>
                <ul>
                    <li @if($selected_nav =='home') class="current" @endif><a href="{{ $site->link }}">Welcome</a></li>
                    <li @if($selected_nav =='photos') class="current" @endif><a href="{{ $site->link }}/photos">Photos</a></li>
                    <li @if($selected_nav =='videos') class="current" @endif><a href="{{ $site->link }}/videos">Videos</a></li>
                    <li @if($selected_nav =='tags') class="current" @endif><a href="{{ $site->link }}/tags">Tags</a></li>
                    <li @if($selected_nav =='models') class="current" @endif><a href="{{ $site->link }}/models">Models</a></li>
                </ul>
            </nav>

        <div id="page-submenu-trigger"><i class="icon-reorder"></i></div>

        </div>

    </div>

</div><!-- #page-menu end -->
