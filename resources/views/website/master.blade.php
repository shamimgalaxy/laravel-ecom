<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>MY Shop - @yield('title')</title>
@include('website.includes.style')
</head>

<body>

@include('website.includes.header')

@yield('body')

@include('website.includes.footer')

@include('website.includes.script')

{{-- Pusher JS (after jQuery, before chat widget) --}}
<script src="https://js.pusher.com/8.4/pusher.min.js"></script>

{{-- Live Chat Widget --}}
@include('partials.chat-widget')

</body>
</html>