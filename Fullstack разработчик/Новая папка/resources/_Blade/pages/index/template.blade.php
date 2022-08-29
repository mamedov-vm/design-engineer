<!DOCTYPE html>
<html lang="ru">
	 <head>
			<meta charset="UTF-8">
			<meta
			 name="viewport"
			 content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
			>
			<meta
			 http-equiv="X-UA-Compatible"
			 content="ie=edge"
			>
			<title>Document</title>
			<link
			 rel="stylesheet"
			 href="/libs/fontawesome/css/all.css"
			>
			<link
			 rel="stylesheet"
			 href="/css/app.css"
			>
			<style>

        body {
          position: relative;

          width: 100vw;
          height: 100vh;

          overflow: hidden;
        }

        .app {

          overflow-y: auto;

          height: calc(100vh - 30px);

        }
			</style>
	 </head>
	 <body>
			<script src="{{mix('js/app.js')}}"></script>
			<div
			 class="app"
			 id="app"
			 style="position: relative"
			>
				 <div>
						<c-titlebar/>
				 </div>
				 <div>
						<c-tooltip/>
				 </div>
				 
				 <div style="width: 500px; margin: 20px auto;">
						<i
						 class="fas fa-allergies"
						 v-tooltip="{tip: 'Это всплывающая!', dir: 'b'}"
						></i>
						<update-password>
						</update-password>
				 </div>
			
			</div>
			
			
			<template id="updatePassword">
				 <div>Форма изменения пароля</div>
				 
				 <div>
						<c-inline-input
						 name="inputin1"
						 id="inputin1"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 error="Ошибка ввода пароля"
						 inputWidth="40px"
						 
						 v-model="inlineinput1"
						 
						 maxlength="2"
						 pattern="[0-9]{1,2}"
						/>
				 </div>
				 
				 <div>
						<c-inline-input
						 name="inputin2"
						 id="inputin2"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 error="Ошибка ввода пароля"
						 inputWidth="40px"
						 
						 v-model="inlineinput2"
						 
						 maxlength="2"
						 pattern="[0-9]{1,2}"
						 disabled
						/>
				 </div>
				 
				 <div>
						<c-inline-input
						 name="inputin3"
						 id="inputin3"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 inputWidth="40px"
						 
						 v-model="inlineinput3"
						 
						 maxlength="2"
						 pattern="[0-9]{1,2}"
						/>
				 </div>
				 
				 <div>
						<c-inline-input
						 name="inputin4"
						 id="inputin4"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 input-width="60px"
						 
						 v-model="inlineinput4"
						 
						 maxlength="2"
						 pattern="[0-9]{1,2}"
						/>
				 </div>
				 
				 <div>
						<c-input
						 name="input-1"
						 id="input-1"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 placeholder="Введите пароль"
						 error="Ошибка ввода пароля"
						 tip="Информация о поле ввода"
						 
						 v-model="input1"
						 
						 counter
						 maxlength="10"
						 pattern="[a-z]{2,10}"
						/>
				 </div>
				 <div>
						<c-input
						 name="input-2"
						 id="input-2"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 placeholder="Введите пароль"
						 error="Ошибка ввода пароля"
						 tip="Информация о поле ввода"
						 
						 v-model="input2"
						 
						 counter
						 maxlength="10"
						 pattern="[a-z]{2,10}"
						 disabled
						/>
				 </div>
				 
				 <div>
						<c-input
						 name="input-3"
						 id="input-3"
						 label="Поле ввода"
						 helper="Введите пароль, которые действует сейчас"
						 placeholder="Введите пароль"
						 tip="Информация о поле ввода"
						 
						 v-model="input3"
						 
						 counter
						 maxlength="20"
						 pattern="[a-z0-9]{2,20}"
						/>
				 </div>
				 
				 <div>
						<c-textarea
						 name="ta-1"
						 id="ta-1"
						 label="Тест"
						 error="Ошибка"
						 helper="Введите отзыв"
						 placeholder="ваа"
						 
						 v-model="ta1"
						 
						 counter
						 maxlength="50"
						/>
				 </div>
				 <div>
						<c-textarea
						 name="ta-2"
						 id="ta-2"
						 label="Тест"
						 helper="Введите отзыв"
						 placeholder="ваа"
						 error="Ошибка"
						 tip="Стоимость одной монеты <i>50</i> рублей ага га гагагага<dd>Стоимость одной монеты <i>50</i> рублей</dd>"
						 
						 v-model="ta2"
						 
						 disabled
						 counter
						 maxlength="50"
						/>
				 </div>
				 
				 
				 <div>
						<c-select
						 name="sel1"
						 id="sel1"
						 label="Пользовательский селект"
						 helper="Введите отзыв"
						 :options="[
						 {label: 'Элемент 1ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', value: '1'},
						 {label: 'Элемент 2', value: '2', selected: true},
						 {label: 'Элемент 3', value: '3'},
						 {label: 'Элемент 4', value: '4'}
					]"
						 v-model="select1"
						 tip="dsdsd"
						 error="dsds"
						/>
				 </div>
				 
				 <div>
						<c-select
						 name="sel2"
						 id="sel2"
						 label="Пользовательский селект"
						 helper="Введите отзыв"
						 :options="[
						 {label: 'Элемент 1ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', value: '1'},
						 {label: 'Элемент 2', value: '2', selected: true},
						 {label: 'Элемент 3', value: '3'},
						 {label: 'Элемент 4', value: '4'}
					]"
						 v-model="select2"
						 tip="sdsd"
						 error="dsds"
						 disabled
						/>
				 </div>
				 
				 
				 <div>
						<c-switch
						 name="switch"
						 label="Пользовательский селект"
						 helper="Введите отзыв"
						 v-model="cSwitch"
						/>
				 </div>
				 
				 <div>
						<c-switch
						 name="switch2"
						 label="Пользовательский селект"
						 helper="Введите отзыв"
						 v-model="cSwitch2"
						 disabled
						/>
				 </div>
				 <div>
						<c-radio-img
						 name="radioImg"
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						 card-width="calc(50% - 10px)"
						 v-model="cRadioImg"
						 :options="[
						 {
						 		label: 'Элемент 1',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'img1',
						 		img: 'https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg',
						 		alt: 'Привет',
						 		selected: false,
						 		disabled: true
						 },
						 {
						 		label: 'Элемент 2',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'img2',
						 		img: 'https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg',
						 		alt: 'Привет',
						 		selected: false,
						 		disabled: true
						 },
						 {
						 		label: 'Элемент 3',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'img3',
						 		img: 'https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg',
						 		alt: 'Привет',
						 		selected: true
						 },
						 {
						 		label: 'Элемент 4',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'img4',
						 		img: 'https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg',
						 		alt: 'Привет',
						 		selected: false
						 },
						]"
						/>
				 </div>
				 <div>
						<c-radio
						 name="radio"
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						 card-width="100%"
						 v-model="cRadio"
						 :options="[
						 {
						 		label: 'Элемент 1',
						 		description: 'dfffdfsd dsfsdfs',
						 		info: 'dddddd',
						 		value: 'el1',
						 		selected: false,
						 		disabled: true
						 },
						 {
						 		label: 'Элемент 2',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'el2',
						 		selected: true
						 },
						 {
						 		label: 'Элемент 3',
						 		description: 'dfffdfsd dsfsdfs',
						 		value: 'el3',
						 		selected: false
						 }
						]"
						/>
				 </div>
				 <div>
						<c-checkbox
						 name="checkboxdd"
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						 v-model="cCheckbox"
						/>
				 </div>
				 <div>
						<c-checkbox-title
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						/>
				 </div>
				 <div>
						<c-checkbox
						 name="checkboxdd2"
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						 v-model="cCheckbox2"
						 disabled
						/>
				 </div>
				 <div>
						<c-checkbox
						 name="checkboxdd3"
						 label="Пользовательский выбор"
						 helper="Выберите вариант"
						 v-model="cCheckbox3"
						 disabled
						/>
				 </div>
				 <a href="//google.com">fff</a>
			</template>
			
			<script type="module">
        (
            function () {
              window.app.component(
                  'updatePassword',
                  {
                    template: document.querySelector('#updatePassword').innerHTML,
                    data() {
                      return {
                        inlineinput1: '',
                        inlineinput2: '3',
                        inlineinput3: '21',
                        inlineinput4: '21',
                        input1: {
                          value: '',
												},
                        input2: {
                          value: '',
                        },
                        input3: {
                          value: '',
                        },
                        ta1: '111',
                        ta2: '333',
                        ta3: 'eeee',
                        select1: '',
                        select2: '',
                        cSwitch: false,
                        cSwitch2: true,
                        cRadioImg: '',
                        cRadio: '',
                        cCheckbox: true,
                        cCheckbox2: true,
                        cCheckbox3: false,
                      }
                    },
                    watch: {},
                    methods: {
                      async testtt() {
                        // let b = await window.myfunc('22eewewe');
                        // console.log(b);
                      },
                    },
                  },
              );

              window.app.mount('#app');
            }()
        );
			</script>
	 </body>
</html>