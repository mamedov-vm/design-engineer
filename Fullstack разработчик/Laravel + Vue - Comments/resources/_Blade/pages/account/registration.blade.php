@extends('_layouts.promo.index')

{{-- Параметры страницы --}}
@section('page.title', 'Регистрация аккаунта')
@section('page.desc', 'Зарегистрируйтесь на сайте '.config('app.name').', чтобы получить доступ ко всем возможностям ресурса!')
@section('page.keywords', 'Личный кабинет, вход, логин, '.config('app.name'))

@section('content')
	 <div class="promo__container-row star">
			<section class="promo__container-wrapper">
				 <div class="promo-content">
						<div
						 class="auth container"
						 style="flex: 1;"
						>
							 <div class="auth__left-side">
									<div class="auth__label">
										 Мы Вас ждали!
									</div>
									<div class="auth__image">
										 <img
											src="/assets/blade/img/pages/account/icons/login.svg"
											alt="Войти в аккаунт"
											aria-hidden="true"
										 >
									</div>
									<div class="auth__description">
										 Есть аккаунт? <a
											class="a-white-link"
											href="/account/login/"
										 >Войдите</a>.
									</div>
							 </div>
							 <div
								class="auth__right-side"
							 >
									<form
									 class="auth__form"
									 method="post"
									 action=""
									 @submit.prevent
									>
										 <account-form/>
									</form>
							 </div>
						</div>
				 </div>
			</section>
	 </div>
@endsection

@section('vuePageComponent')
	 @verbatim
			<template id="accountForm">
				 <div>
						<account-input
						 name="login"
						 :type="fields.login.type"
						 :icon="fields.login.icon"
						 :tip="fields.login.info"
						 :label="fields.login.label"
						 :pattern="fields.login.pattern"
						 hint="Введите желаемый логин"
						 v-model="login"
						/>
				 </div>
				 <div>
						<account-input
						 name="password"
						 :type="fields.password.type"
						 :icon="fields.password.icon"
						 :tip="fields.password.info"
						 :label="fields.password.label"
						 hint="Пароль должен содержать как минимум одну цифру, одну заглавную и строчную букву, быть не короче 8 символов и не длиннее 20"
						 :pattern="fields.password.pattern"
						 v-model="password"
						/>
				 </div>
				 <div>
						<account-input
						 name="password_confirmation"
						 :type="fields.password.type"
						 :icon="fields.password.icon"
						 :tip="fields.password.info"
						 :label="'Повторите ' + fields.password.label.toLowerCase()"
						 hint="Пароль должен содержать как минимум одну цифру, одну заглавную и строчную букву, быть не короче 8 символов и не длиннее 20"
						 :pattern="fields.password.pattern"
						 v-model="password_confirmation"
						/>
				 </div>
				 <div>
						<account-input
						 name="email"
						 :type="fields.email.type"
						 :icon="fields.email.icon"
						 :tip="fields.email.info"
						 :label="fields.email.label"
						 hint="Введите Ваш email-адрес"
						 :pattern="fields.email.pattern"
						 v-model="email"
						/>
				 </div>
				 <input
					type="hidden"
					name="_token"
					:value="csrf"
				 >
				 <div
					class="auth__form-error"
					v-if="errorsInFields.length !==0 "
				 >
						Некорректно заполнены поля:
						<ul>
							 <li
								v-for="(error, index) in errorsInFields"
								v-html="error + (index === Object.keys(errorsInFields).length - 1 ? '.' : ';')"
							 ></li>
						</ul>
				 </div>
				 <div
					class="auth__form-description"
					style="margin: 16px 0"
				 >
						Изменить e-mail и логин после регистрации нельзя. Чтобы увидеть рекомендации по заполнению поля, наведите
						курсор на иконку слева.
				 </div>
				 <button
					class="auth__form-submit"
					title="Зарегистрировать новый аккаунт"
					@click="submit"
					style="margin: 0"
				 >
						Зарегистрироваться
				 </button>
			</template>
	 @endverbatim
	 
	 @include('pages.account.vue.accountInput')
	 
	 <script type="module">
     (
         function () {
           window.app.component(
               'accountForm',
               {
                 template: document.querySelector('#accountForm').innerHTML,
                 data() {
                   return {
                     login: {
                       valid: {!! (count($errors->get('login')) === 0) && (old('login', '') !== '' ) ? 'true' : 'false' !!},
                       value: '{!! old('login', '') !!}',
                     },
                     email: {
                       valid: {!! (count($errors->get('email')) === 0) && (old('email', '') !== '' ) ? 'true' : 'false' !!},
                       value: '{!! old('email', '') !!}',
                     },
                     password: {
                       valid: false,
                       value: '',
                     },
                     password_confirmation: {
                       valid: false,
                       value: '',
                     },
                     csrf: document.querySelector('meta[name="app:csrf"]').getAttribute('content'),
                     fields: {!! $fields !!},
                     errorsInFields: {!! json_encode(Arr::flatten($errors->toArray()) ?? [], JSON_UNESCAPED_UNICODE) !!}
                   }
                 },
                 methods: {
                   submit() {
                     if (this.login.valid
                         && this.email.valid
                         && this.password.valid
                         && this.password_confirmation.valid
                         && this.password.value === this.password_confirmation.value) {
                       this.$el.parentElement.submit();
                     } else {
                       window.app.newNoty(this.magic.incorrectData, 2);
                     }
                   },
                 },
               },
           );

           window.app.mount('#app');
         }()
     );
	 </script>

@endsection