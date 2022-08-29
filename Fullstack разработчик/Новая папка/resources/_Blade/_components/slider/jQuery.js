(function ($) {
	 /**
		* Инициализирует slider на странице
		*
		* Использование:
		*   ```
		*   1. Вызвать плагин на селекторе
		*      $('#selector').slider(options);
		*   ```
		*
		* Селекторы:
		*   ```
		*   Элемент блока slider-а		#slider
		*   ```
		*
		* @return void
		**/
	 $.fn.slider = function (options) {
			let slider = {
				 /**
					* Массив настроек плагина
					**/
				 _settings: $.extend(
					 {
							timeSet: 6000,
							dotsType: 'fas fa-star'
					 },
					 options
				 ),
				 /**
					* Объект slider-а
					*/
				 _slider: $(this),
				 /**
					* Время начала отсчета
					*/
				 _startTime: new Date(),
				 /**
					* Индекс текущего слайда
					*/
				 _currentSlideIndex: 0,
				 /**
					* Объект элементов slider-а
					*/
				 _objects: {
						/* Контейнер с точками навигации по слайдам */
						dotsContainer: $(this).children('.slider__stars'),
						/* Точки навигации */
						dots: null,
						/* Слайды */
						slides: $(this).children('.slider__block').children('.slider__item')
				 },
				 /**
					* Функция инициализации slider-а
					* @private
					*/
				 _init: function () {
						this._createDots();
						this._onDotsClick();
						this._onArrowsClick();

						this._setCurrentSlide(this._currentSlideIndex);
						this._autoSlideChange();
				 },
				 /**
					* Автоматическое переключение слайдов
					* @private
					*/
				 _autoSlideChange: function () {
						let bodeFocusStatus = $('body').attr('data-focus');
						if (bodeFocusStatus && bodeFocusStatus === '1') {
							 let curTime = new Date();
							 let delta = curTime.getTime() - this._startTime.getTime();
							 if (delta >= this._settings.timeSet) {
									this._setCurrentSlide(this._currentSlideIndex += 1);
							 }
						}
						setTimeout(this._autoSlideChange.bind(this), 1000);
				 },
				 /**
					* Функция создания точек навигации по слайдам
					* @private
					*/
				 _createDots: function () {
						let dotsType = this._settings.dotsType;
						let dots = '';
						/* Перебор слайдов и создание точек навигации */
						this._objects.slides.each(function (index) {
							 dots += `<span class='slider__stars-item ${dotsType}' data-id='${index}'></span>`;
							 /* Простановка индексов у слайдов */
							 $(this).attr('data-id', index);
						});
						/* Добавление точек в контейнер */
						this._objects.dotsContainer.append(dots);
						/* Инициализация точек навигации */
						this._objects.dots = this._objects.dotsContainer.children('.slider__stars-item');
				 },
				 /**
					* Установка слайда с индексом slideIndex текущим
					* @param {int|string} slideIndex - номер слайда, который станет текущим
					* @private
					*/
				 _setCurrentSlide: function (slideIndex) {
						this._startTime = new Date();
						this._showSlide(slideIndex);
				 },
				 /**
					* Отображает слайд с индексом slideIndex
					* @param {int|string} slideIndex - номер слайда для отображения
					* @private
					*/
				 _showSlide: function (slideIndex) {
						if (slideIndex > this._objects.slides.length - 1) {
							 this._currentSlideIndex = 0
						} else if (slideIndex < 0) {
							 this._currentSlideIndex = this._objects.slides.length - 1;
						} else {
							 this._currentSlideIndex = slideIndex;
						}

						this._deactivateAllSlidesAndDots();

						/* Отображение слайда и активация кнопки навигации */
						/* this._slider передается с селектором id */
						// noinspection JSValidateTypes
						this._slider.children('.slider__block').children(`.slider__item[data-id=${this._currentSlideIndex}]`).addClass('show');
						// noinspection JSValidateTypes
						this._slider.children('.slider__stars').children(`.slider__stars-item[data-id=${this._currentSlideIndex}]`).addClass('active');
				 },
				 /**
					* Переключение на следующий слайд
					* @private
					*/
				 _showNextSlide: function () {
						this._setCurrentSlide(this._currentSlideIndex += 1);
				 },
				 /**
					* Переключение на предыдущий слайд
					* @private
					*/
				 _showPreviousSlide: function () {
						this._setCurrentSlide(this._currentSlideIndex -= 1);
				 },
				 /**
					* Скрывает все слайды
					* @private
					*/
				 _deactivateAllSlidesAndDots: function () {
						/* Скрытие всех слайдов */
						this._objects.slides.each(function () {
							 $(this).removeClass('show');
						});
						/* Деактивация всех точек */
						this._objects.dots.each(function () {
							 $(this).removeClass('active');
						});
				 },
				 /**
					* Событие нажатия на точки навигации
					*/
				 _onDotsClick: function () {
						let that = this;
						this._objects.dots.on('click', function () {
							 that._setCurrentSlide($(this).data('id'));
						});
				 },
				 /**
					* Событие нажатие на кнопки (стрелки) навигации
					* @private
					*/
				 _onArrowsClick: function () {
						/* this._slider передается с селектором id */
						let that = this;
						// noinspection JSValidateTypes
						this._slider.children('.slider__block').children('.slider__prev').on('click', function () {
							 that._showPreviousSlide();
						});
						// noinspection JSValidateTypes
						this._slider.children('.slider__block').children('.slider__next').on('click', function () {
							 that._showNextSlide();
						});
				 }
			}

			slider._init();
	 };
})(jQuery);