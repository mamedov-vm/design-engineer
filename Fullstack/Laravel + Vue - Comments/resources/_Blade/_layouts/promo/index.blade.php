{{--
   Основной шаблон-структура
--}}

@push('meta')
	 {{-- Указатель на тип шаблона --}}
	 <meta
		name='app:template'
		content='promo'
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
		class="body body--promo"
		data-focus="1"
	 >
			{{-- Подключение Vue --}}
			<script src="{{mix('js/app.js')}}"></script>
			
			{{-- Контейнер Vue --}}
			<div
			 class="body__wrapper body__wrapper--promo"
			 id="app"
			 style="width: 100%; height: 100%"
			>
				 {{--
						 Компоненты, загружаемые на всех страницах:
							 - <c-btn-to-top/>
							 - <c-notys/>
							 - <c-tooltip/>
				 --}}
				 @include('_parts.components.index')
				 
				 <main class="promo">
						<div class=promo__container">
							 @yield('content')
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