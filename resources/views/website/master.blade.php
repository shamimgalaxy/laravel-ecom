<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>MY Shop - @yield('title')</title>
@include('website.includes.style')
@stack('styles')
</head>

<body>

@include('website.includes.header')

@yield('body')

@include('website.includes.footer')

@include('website.includes.script')

@stack('scripts')

<script src="https://js.pusher.com/8.4/pusher.min.js"></script>

@include('partials.chat-widget')

</body>
</html>