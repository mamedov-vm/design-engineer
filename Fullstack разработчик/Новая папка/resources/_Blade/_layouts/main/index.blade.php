{{--
   Основной шаблон-структура
--}}

@push('meta')
	 {{-- Указатель на тип шаблона --}}
	 <meta
		name='app:template'
		content='main'
	 >
	 <meta
		name='app:notification'
		content='@if(session('notification')){{session('notification')}}@endif'
	 >
	 <meta
		name='app:notificationType'
		content='@if(session('notificationType')){{session('notificationType')}}@else {{ '2' }} @endif'
	 >
@endpush

{{-- Структура --}}
<!DOCTYPE html>
<html lang='ru'>
	 @include('_parts.head.index')
	 <body
		class="body body--main"
		data-focus="1"
	 >
			{{-- Подключение Vue --}}
			<script src="{{mix('js/app.js')}}"></script>
			
			{{-- Контейнер Vue --}}
			<div
			 class="body__wrapper"
			 id="app"
			 style="width: 100%;"
			>
				 {{--
						 Компоненты, загружаемые на всех страницах:
							 - <c-btn-to-top/>
							 - <c-notys/>
							 - <c-tooltip/>
				 --}}
				 @include('_parts.components.index')
				 
				 <main class="main">
						<div class="main__wrapper">
							 <aside class="main__aside">
									@yield('sidebar')
							 </aside>
							 <section class="main__content">
									@yield('content')
							 </section>
						</div>
				 </main>
			</div>
			
			{{-- -------------------- Скрипты -------------------- --}}
			{{-- Подключение дополнительных библиотек --}}
			@stack('jsLibs')
			{{-- -------------------! Скрипты !------------------- --}}
			
			{{-- Ининициализация Vue --}}
			@yield('vuePageComponent')
	 </body>
</html>