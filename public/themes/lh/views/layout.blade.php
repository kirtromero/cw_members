<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

    @include('lh::includes.common')

    @yield('page_header_includes')

    <!-- Document Title
    ============================================= -->
	<title>{{ $page_title }}</title>

</head>

<body class="stretched no-transition dark">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix dark">

        @include('lh::network.header')

        @yield('content')

        @include('lh::network.footer')

    </div><!-- #wrapper end -->

    @include('lh::includes.footer_scripts')

    @yield('page_footer_includes')

    @include('piwik_tracker')

</body>
</html>
