<template>
	<teleport
			to="body"
	>
		<transition name="modal">
			<div
					class="modal"
					v-if="show"
					ref="modal"
			>
				<div class="modal__wrapper">
					<div
							class="modal__window"
							v-if="show"
					>
						<div class="modal__header">
							<div class="modal__title">
								{{ title }}
							</div>
							<button
									class="modal__close-btn"
									@click="close"
									aria-label="Закрыть окно"
							>
								<i
										class="fal fa-times"
										aria-hidden="true"
								></i>
							</button>
						</div>
						<transition-group
								name="loader"
								appear
						>
							<div v-if="isLoaderShow">
								<c-loader
										:show="isLoaderShow"
								/>
							</div>
							<slot v-else></slot>
						</transition-group>
					</div>
				</div>
				<div
						class="modal__overlay"
						@click.stop="close"
				>
				</div>
			</div>
		</transition>
	</teleport>
</template>

<script>
import cLoader from '../cLoader';

export default {
	name: 'cModal',
	components: {
		cLoader,
	},
	props: {
		show: {
			type: Boolean,
			default: false,
		},
		title: {
			type: String,
			required: true,
		},
		isLoaderShow: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {}
	},
	methods: {
		close() {
			this.$emit(
					'update:show',
					false,
			)
		},
	},
	watch: {
		show(newValue) {
			if (newValue) {
				document.querySelector('body').style.overflowY = 'hidden';

				if (window.innerWidth > 1199) {
					document.body.style.padding = '0 16px 0 0';

					let logo = document.querySelector('.header__logo');
					let toolbar = document.querySelector('.header__toolbar');

					logo.style.margin = '0 0 0 12px';
					toolbar.style.margin = '0 8px 0 0';
				}
			} else {
				setTimeout(
						() => {

							document.querySelector('body').style.overflowY = 'auto';

							if (window.innerWidth > 1199) {
								document.body.style.padding = '';

								let logo = document.querySelector('.header__logo');
								let toolbar = document.querySelector('.header__toolbar');

								logo.style.margin = '';
								toolbar.style.margin = '';
							}
						},
						350,
				);
			}
		},
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.modal-enter-active,
.modal-leave-active {
	transition: opacity 0.5s ease;
}

.modal-enter-from,
.modal-leave-to {
	opacity: 0;
}

.loader-enter-active,
.loader-leave-active {
	transition: all 0.5s ease;
}

.loader-enter-from,
.loader-leave-to {
	opacity: 0;
	transform: scale(0);
}

.modal {
	position: fixed;
	top: 0;
	left: 0;

	width: 100%;
	height: 100%;

	z-index: 900;

	&__overlay {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;

		background: rgba(0, 0, 0, .5);
		z-index: 900;
	}

	&__wrapper {
		position: absolute;
		top: 50%;
		left: 50%;

		transform: translateX(-50%) translateY(-50%);

		display: flex;
		align-items: center;
		justify-content: center;

		min-width: 480px;
		width: 100%;
		max-width: 600px;
		min-height: 200px;
		max-height: 85vh;

		z-index: 901;

		padding: 8px;
	}

	&__window {
		display: flex;
		flex-direction: column;

		min-width: 480px;
		width: 100%;
		max-width: 600px;
		min-height: 200px;
		max-height: 85vh;

		border-radius: 6px;
		background: white;
	}

	&__header {
		display: flex;
		justify-content: space-between;

		font-size: 20px;

		border-bottom: 1px solid gray;

		padding: 4px;
	}

	&__title {
		font-weight: 500;

		padding: 6px;
	}

	&__close-btn {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 32px;
		height: 32px;

		font-size: 20px;
		font-weight: bold;
		text-align: center;

		cursor: pointer;
		border-radius: 50%;
		background-color: transparent;
		transition: background-color .4s;

		padding: 6px;

		&:hover {
			background-color: $gr_05;
		}

		&:focus-visible {
			outline: 2px solid $c_90;
		}
	}

	&__body {
		flex: 1;
	}

	&__content {
		max-height: calc(85vh - 90px);
		overflow-y: auto;

		padding: 8px;

		&-title {
			font-weight: 500;
			font-size: 1em;
			margin: 6px 0;

			&.bold{
				color: $o_50;
			}
		}

		&-center {
			display: flex;
			justify-content: center;
			align-items: center;
		}

		&-column {
			display: flex;
			flex-direction: column;

			width: 100%;
		}

		&-description {
			color: $gr_60;
			font-size: 14px;

			&.red {
				color: $r_60;
			}

			&.green {
				color: $g_80;
			}
		}
	}

	&__footer {
		display: flex;
		justify-content: flex-end;

		border-top: 1px solid gray;

		padding: 8px;
	}

	&__confirmation {
		display: flex;
		flex-direction: column;

		padding: 6px;


		&-row {
			display: flex;
			align-items: center;

			&--content {

			}
		}

		&-icon {
			font-size: 42px;
			color: $o_50;

			margin-right: 12px;
		}

		&-content {

		}

		&-question {
			font-size: 20px;
			line-height: 24px;
		}

		&-description {
			font-size: 13px;
			color: $gr_60;

			line-height: 20px;
		}
	}
}
</style>