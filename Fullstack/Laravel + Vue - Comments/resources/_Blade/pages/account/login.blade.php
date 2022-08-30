@extends('_layouts.promo.index')

{{-- Параметры страницы --}}
@section('page.title', 'Вход в личный кабинет')
@section('page.desc', 'Войдите в аккаунт на сайте '.config('app.name').', чтобы получить доступ ко всем возможностям ресурса!')
@section('page.keywords', 'Личный кабинет, вход, логин, залогиниться, сервис, авторизация, аутентификация, '.config('app.name'))

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
										 Мы знакомы?
									</div>
									<div class="auth__image">
										 <img
											src="/assets/blade/img/pages/account/icons/login.svg"
											alt="Войти в аккаунт"
											aria-hidden="true"
										 >
									</div>
									<div class="auth__description">
										 Нет аккаунта?
										 <a
											class="a-white-link o-w"
											title="Зарегистрировать новый аккаунт"
											href="/account/registration"
										 >Зарегистрируйтесь</a>.
									</div>
							 </div>
							 <div
								class="auth__right-side"
							 >
									<form
									 class="auth__form"
									 method="POST"
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
						Введите email-адрес и пароль, которые Вы указали при регистрации.
				 </div>
				 <button
					class="auth__form-submit"
					title="Войти в аккаунт"
					@click="submit"
					style="margin: 0"
				 >
						Войти
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
                     email: {
                       valid: true,
                       value: 'admin@admin.ru',
                     },
                     password: {
                       valid: true,
                       value: 'qQ@22222',
                     },
                     csrf: document.querySelector('meta[name="app:csrf"]').getAttribute('content'),
                     fields: {!! $fields !!},
                     errorsInFields: {!! json_encode(Arr::flatten($errors->toArray()) ?? [], JSON_UNESCAPED_UNICODE) !!}
                   }
                 },
                 methods: {
                   submit() {
                     if (this.email.valid
                         && this.password.valid) {
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