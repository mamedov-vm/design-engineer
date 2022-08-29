{{-- Слайдер --}}
{{--
	Устанавливаемые параметры:
			1. $id 				- селектор (id) слайдера для ининциализации в плагине slider
			2. $items 		- массив с параметрами слайдов ('src' - путь к картинке, 'alt' - описание, 'width' - ширина картинки [100%])
			3. $dotsType	- класс иконки fontawesome для точек навигации ['fas fa-star']
			4. $timeSet		- время показа одного слайда [6000 мс]
--}}

{{-- Ининциализация слайдер --}}
{{--
    Устанавливаемые параметры: $id
    Плагин: jQuery - slider
--}}
@push('jsOnLoad')
	 $('#{{$id}}').slider({
	 @isset($dotsType)
			dotsType:'{{$dotsType}}'
	 @endisset
	 @isset($timeSet)
			, timeSet:{{$timeSet}}
	 @endisset
	 });
@endpush

<section class="slider" id="{{$id}}">
	 <div class="slider__block">
			{{-- Изображения --}}
			@foreach ($items as $item)
				 <div class="slider__item">
						<img src="{{$item['scr']}}"
								 alt="{{$item['alt']}}"
								 style="width: {{$item['width'] ?? '100%'}}"
						>
				 </div>
			@endforeach
			{{-- Стрелки --}}
			<div class="slider__arrow slider__prev"></div>
			<div class="slider__arrow slider__next"></div>
	 </div>
	 {{-- Точки для переключения слайдов --}}
	 <div class="slider__stars"></div>
</section>