@extends('_layouts.promo.index')

{{-- Параметры страницы --}}
@section('page.title', 'Комментарии')
@section('page.desc', 'Оставьте свой комментарий!')
@section('page.keywords', 'Комментарии, отзыв, пост, '.config('app.name'))

@section('content')
	 <div class="promo__container-row star">
			<section class="promo__container-wrapper">
				 <div class="promo-content">
						<div
						 class="auth container"
						 style="flex: 1;"
						>
							 <div
								class="comments"
								style="width: 100%;"
							 >
									<comments/>
							 </div>
						</div>
				 </div>
			</section>
	 </div>
@endsection

@section('vuePageComponent')
	 @verbatim
			<template id="comments">
				 <div class="comments__post-template content">
						<h2>Оцените новый вариант Captcha!</h2>
						<div>
							 <c-captcha
								style="margin: 30px;"
								v-model="captcha"
							 />
						</div>
						<h2>Комментарии к разделу</h2>
				 </div>
				 <div
					class="comments__list"
				 >
						<div
						 class="comments__list-empty"
						 v-if="!hasOneVariant"
						>
							 Нет комментариев этого автора!
						</div>
						<div class="comments__list-data">
							 <transition-group name="comments">
									<div
									 class="comments__content-wrapper"
									 v-for="comment in displayedComments"
									 :key="comment.id"
									 v-show="comment.isActive"
									>
										 <div class="comments__content-title">
												<div class="comments__content-user">
													 {{ comment.user?.login}} <span>
															оставил комментарий ({{ comment.id }})
													 </span>
												</div>
												<div class="comments__content-date">
													 {{ $filters.date(comment.created_at, 'd.m.y в h:i') }}
												</div>
										 </div>
										 <div class="comments__content-content">
												{{ comment.content }}
										 </div>
									</div>
							 </transition-group>
						</div>
				 </div>
				 <div
					class="comments__load-more"
				 >
						<c-button
						 :disabled="isLoadMoreButtonBlocked"
						 @click="loadMore"
						>
							 Загрузить еще
						</c-button>
				 </div>
				 <div
					class="comments__sort"
				 >
						<div>
							 <c-input
								name="loginInput"
								id="loginInput"
								label="Сортировка по автору"
								helper="На подсказку с логином можно нажать"
								v-model="loginInput"
								pattert=""
							 />
						</div>
						<div
						 class="comments__sort-helper"
						>
							 <div v-if="this.loginVariants.length !== 0">
									Возможно вы имели в виду: <span
									 v-for="login in loginVariants"
									 class="comments__sort-variant"
									 @click="selectLoginVariant(login)"
									>{{ login }}</span>
							 </div>
							 <div v-else>
									Ничего не найдено. Введите другой логин...
							 </div>
						</div>
				 </div>
				 <div
					class="comments__new"
					v-if="serverData.isAuth"
				 >
						<div>
							 <c-textarea
								name="newCommentContent"
								id="newCommentContent"
								label="Введите Ваш комментарий"
								error=""
								helper="Он будет сразу добавлен к посту"
								placeholder="До 200 символов..."
								
								v-model="newCommentContent"
								
								counter
								maxlength="200"
							 />
						</div>
						<div class="comments__new-button">
							 <c-button
								@click="newComment"
							 >
									Добавить комментарий
							 </c-button>
						</div>
						<div class="comments__auth">
							 Добро пожаловать, {{ serverData.user.login }}.
							 <a
								href="/account/logout"
								v-if="serverData.isAuth"
							 >
									Выйти.
							 </a>
						</div>
				 </div>
				 <div
					class="comments__auth"
					v-else
				 >
						Чтобы оставить комментарий, <a href="/account/login">войдите</a> или <a href="/account/registration">
							 зарегистрируйтесь</a>.
				 </div>
			</template>
	 @endverbatim
	 
	 <script type="module">
     (
         function () {
           window.app.component(
               'comments',
               {
                 template: document.querySelector('#comments').innerHTML,
                 data() {
                   return {
                     first: 0,
                     last: 0,
                     offset: 0,
                     //
                     displayedComments: {},
                     //
                     newCommentContent: '',
                     //
                     isAllComments: false,
                     isLoadMoreButtonBlocked: false,
                     //
                     captcha: '',
                     //
                     loginInput: {
                       valid: true,
                       value: '',
                     },
                     loginVariants: [],
                     hasOneVariant: true,
                     //
                     serverData: {!! json_encode($data, JSON_UNESCAPED_UNICODE) !!}
                   }
                 },
                 created() {
                   this.displayedComments = this.serverData.comments;

                   this.setNewComments(this.serverData.comments);


                   this.last = +Object.keys(this.displayedComments)[0];
                   this.first = this.last + 2;
                 },
                 watch: {
                   loginInput() {
                     this.sort();
                   },
                 },
                 methods: {
                   selectLoginVariant(login) {
                     this.loginInput.value = login;
                     this.sort();
                   },
                   loadMore() {
                     if (this.isAllComments) {
                       window.app.newNoty(this.magic.loadAll, 2);
                       return;
                     }

                     if (this.isLoadMoreButtonBlocked) {
                       window.app.newNoty(this.magic.wait, 2);
                       return;
                     }

                     this.axios
                         .post(
                             '/comment/nextComments',
                             {
                               offset: this.first - this.last + 1,
                             },
                         )
                         .then(response => {
                           if (response.status === 200 && response.data.status) {
                             this.getMoreComments(response.data.page);
                           } else {
                             window.app.newNoty(response.data.textStatus, 2);
                           }
                         })
                         .catch(() => {
                           window.app.newNoty(this.magic.incorrectData, 2);
                         });
                   },
                   getMoreComments(comments) {
                     if (Object.keys(comments).length !== 3) {
                       this.isAllComments = true;
                     }

                     if (Object.keys(comments).length === 0) {
                       window.app.newNoty(this.magic.loadAll, 2);
                     }

                     this.setNewComments(comments);

                     this.last = +Object.keys(comments)[0];

                     this.loginInput.value = this.loginInput.value + '';
                   },
                   setNewComments(comments) {
                     Object.keys(comments).map((obj) => {
                           this.displayedComments[obj] = comments[obj];
                           this.displayedComments[obj].isActive = true;
                         },
                     );

                     this.sort();
                   },
                   newComment() {
                     if (this.newCommentContent === '') {
                       window.app.newNoty('Уведомление|Введите комментарий', 2);
                       return;
                     }

                     this.axios
                         .post(
                             '/comment/newComment',
                             {
                               content: this.newCommentContent,
                             },
                         )
                         .then(response => {
                           if (response.status === 200 && response.data.status) {
                             this.setNewComment(response.data.comment);
                           } else {
                             window.app.newNoty(response.data.textStatus, 2);
                           }
                         })
                         .catch(() => {
                           window.app.newNoty(this.magic.incorrectData, 2);
                         });
                   },
                   setNewComment(comment) {
                     this.first = comment.id;

                     this.displayedComments[comment.id] = comment;
                     this.displayedComments[comment.id] = {
                       ...comment,
                       user: {
                         login: this.serverData.user.login,
                       },
                       created_at: Date.now(),
                       isActive: true,
                     }

                     this.sort();
                   },
                   getLoginVariants() {
                     this.axios
                         .post(
                             '/comment/loginVariants',
                             {
                               login: this.loginInput.value,
                             },
                         )
                         .then(response => {
                           if (response.status === 200 && response.data.status) {
                             this.loginVariants = Object.keys(response.data.logins).reduce((obj, key) => {
                               obj[key] = response.data.logins[key].login;
                               return obj;
                             }, []);
                           } else {
                             window.app.newNoty(response.data.textStatus, 2);
                           }
                         })
                         .catch(() => {
                           window.app.newNoty(this.magic.incorrectData, 2);
                         });
                   },
                   sortByLogin() {
                     this.hasOneVariant = false;

                     Object.keys(this.displayedComments).map((obj) => {
                       if (!this.displayedComments[obj].user.login.includes(this.loginInput.value)) {
                         this.displayedComments[obj].isActive = false;
                       } else {
                         this.hasOneVariant = true;
                       }
                     });
                   },
                   resetSort() {
                     Object.keys(this.displayedComments).map((obj) => {
                       this.displayedComments[obj].isActive = true;
                     });
                   },
                   sort() {
                     this.resetSort()
                     if (this.loginInput.value.length > 2) {
                       this.getLoginVariants();
                       this.sortByLogin();
                     } else {
                       this.hasOneVariant = true;
                       this.loginVariants = [];
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