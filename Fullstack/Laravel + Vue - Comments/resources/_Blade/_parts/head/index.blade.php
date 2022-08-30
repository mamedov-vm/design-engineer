{{-- Основной head --}}
{{--
    Устанавливаемые параметры:
    1. page.desc
    2. page.keywords
    3. page.title
--}}
<head>
	 <meta charset="UTF-8">
	 <meta
		name='viewport'
		content='width=500, initial-scale=0.72, maximum-scale=3.0, minimum-scale=0.72'
	 >
	 <meta
		http-equiv='X-UA-Compatible'
		content='IE=edge'
	 >
	 <meta
		name='theme-color'
		content='#{{config('app.color')}}'
	 >
	 <title>
			@yield('page.title', config('app.name'))
	 </title>
	 {{--Иконки--}}
	 <link
		rel='shortcut icon'
		href='/assets/blade/img/_parts/head/favicon/favicon.ico?v2'
		type='image/x-icon'
	 >
	 <link
		sizes='192x192'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-192x192.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='180x180'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-180x180.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='152x152'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-152x152.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='144x144'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-144x144.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='120x120'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-120x120.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='114x114'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-114x114.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='76x76'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-76x76.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		sizes='72x72'
		href='/assets/blade/img/_parts/head/favicon/apple-touch-icon-72x72.png'
		type='image/png'
	 >
	 <link
		rel='apple-touch-icon-precomposed'
		href='/assets/blade/img/_parts/head/favicon/favicon.png'
		type='image/png'
	 >
	 {{--Метаданные--}}
	 <meta
		name='description'
		content='@yield('page.desc', '')'
	 >
	 <meta
		name='keywords'
		content='@yield('page.keywords', '')'
	 >
	 <meta
		property='og:description'
		content='@yield('page.desc', '')'
	 >
	 <meta
		name='twitter:description'
		content='@yield('page.desc', '')'
	 >
	 {{--Open Graph--}}
	 <meta
		property='og:url'
		content='/'
	 >
	 <meta
		property='og:title'
		content='{{config('app.tagline')}}'
	 >
	 <meta
		property='og:site_name'
		content='{{config('app.name')}}'
	 >
	 <meta
		property='og:image'
		content='/assets/blade/img/_parts/head/favicon/favicon.png'
	 >
	 <meta
		property='og:type'
		content='website'
	 >
	 {{--Twitter--}}
	 <meta
		name='twitter:title'
		content='{{config('app.tagline')}}'
	 >
	 <meta
		name='twitter:card'
		content='summary'
	 >
	 <meta
		name='twitter:domain'
		content='{{config('app.name')}}'
	 >
	 <meta
		name='twitter:image'
		content='/assets/blade/img/_parts/head/favicon/favicon.png'
	 >
	 <meta
		name='twitter:site'
		content='{{config('app.twitter_tag')}}'
	 >
	 {{-- TODO Настроить кеш --}}
	 {{--    <meta http-equiv='Cache-Control' content='max-age=31557600, must-revalidate' />--}}
	 
	 {{--CSS LIBS--}}
	 <link
		rel="stylesheet"
		href="/libs/fontawesome/css/all.css"
	 >
	 
	 {{--CUSTOM CSS--}}
	 <link
		rel="stylesheet"
		href="/assets/blade/css/style.blade.min.css"
	 >
	 
	 @stack('style')
	 
	 {{--CUSTOM Meta--}}
	 <meta
		name='app:csrf'
		content='{{csrf_token()}}'
	 >
	 @stack('meta')
</head>