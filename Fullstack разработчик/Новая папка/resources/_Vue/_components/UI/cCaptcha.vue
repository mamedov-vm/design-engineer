<template>
	<div class="captcha">
		<div class="captcha__label">
			Проверим, что Вы не робот
			<span
					class="captcha__clear"
					@click="clear"
					v-tooltip="{tip: 'Нажмите, чтобы очистить блоки', dir: 't'}"
			><i class="fas fa-retweet"></i></span>
		</div>
		<transition
				name="flip"
				mode="out-in"
		>
			<div
					class="captcha__error"
					v-if="error !== ''"
			>
				<i class="fas fa-times-circle"></i> {{ error }}
			</div>
		</transition>
		<div class="captcha__wrapper">
			<div
					class="captcha__element"
					v-for="(element, index) in elements"
					:key="index"
			>
				<label
						:for="`captcha` + index"
						class="captcha__element-label"
				>
					<input
							type="checkbox"
							:id="`captcha` + index"
							class="captcha__element-control"
							@change="updateElement(index, element === 1)"
							:checked="element === 1"
							autocomplete="off"
					>
					<span class="captcha__element-content">
							<span class="site-icon dark"></span>
            </span>
				</label>
			</div>
		</div>
		<div class="captcha__description">
			Выберите блоки по
			<div
					class="captcha__description-demo"
					ref="demo"
			>
				<div
						class="captcha__demo"
						:class="{active: isDemoShow}"
						v-html="captcha"
				></div>
				<div
						class="captcha__demo-label top"
						:class="{active: isDemoShow}"
				></div>
				шаблону.
			</div>
		</div>
		<input
				type="hidden"
				name="captcha"
				:value="modelValue"
		>
	</div>
</template>

<script>
import directiveTooltip from '../Tools/cTooltip/directiveTooltip';

export default {
	name: 'cCaptcha',
	directives: {tooltip: directiveTooltip},
	props: {
		modelValue: {
			type: String,
			required: true,
		},
		error: {
			type: String,
			default: '',
		},
	},
	data() {
		return {
			elements: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
			captcha: '',
			isDemoShow: false,
		}
	},
	async mounted() {
		await this.updateCaptcha();
	},
	created() {
		document.addEventListener(
				'mouseover',
				(e) => {
					this.isDemoShow = e.target === this.$refs.demo;
				},
				true,
		);
	},
	methods: {
		updateCaptcha() {
			this.axios.post(
					'/captcha/update',
			).then((response) => {
				if (response.status === 200 && !response.data.error) {
					this.captcha = response.data.captcha;
				} else {
					this.captcha = response.data.error ?? this.magic.axiosError;
				}
			}).catch(() => {
				this.captcha = this.magic.axiosError;
			})
		},
		updateElement(index) {
			this.elements[index] = +!this.elements[index];

			this.$emit(
					'update:modelValue',
					this.elements.join(''),
			);

			this.$forceUpdate();
		},
		clear() {
			this.elements = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

			this.$emit(
					'update:modelValue',
					this.elements.join(''),
			);
		},
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.captcha {
	margin: 16px auto 0 auto;

	&__wrapper {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 5px;

		width: 220px;

		margin: 10px auto 0 auto;

		&.demo {
			margin: 0 auto 0 auto;
		}
	}

	&__label {
		font-size: 1em;
		color: $c_90;
		font-weight: 500;
	}

	&__description {
		position: relative;

		color: $gr_60;
		font-size: 0.8em;

		margin-top: 12px;

		&-demo {
			display: inline-block;
			position: relative;

			color: $o_50;
		}
	}

	&__element {
		position: relative;

		width: 35px;
		height: 35px;

		&-label {
			position: absolute;
			top: 50%;
			left: 50%;

			transform: translateY(-50%) translateX(-50%);
		}

		&-control {
			position: absolute;
			left: 0;
			top: 0;

			width: 0;
			height: 0;

			opacity: 0;
		}

		&-control:hover + &-content {
			background-color: $gr_02;
		}

		&-control:focus-visible + &-content {
			outline-color: $c_90;
		}

		&-control:checked + &-content {
			outline-color: $o_50;
		}

		&-content {
			width: 32px;
			height: 32px;

			outline: 2px solid $gr_20;
			background-color: $w;
			border-radius: 4px;
			cursor: pointer;

			padding: 6px;

			&.demo {
				cursor: default;
			}

			&.active {
				outline-color: $o_50;
			}
		}
	}

	&__demo {
		display: block;

		position: absolute;
		top: -12px;
		left: 50%;

		transform: translateY(-100%) translateX(-50%);

		min-width: 250px;
		width: fit-content;

		color: $w;
		font-size: 14px;
		line-height: 1.2rem;
		text-align: center;

		background-color: $c_90;
		border-radius: 6px;
		opacity: 0;
		transition: .3s;
		pointer-events: none;

		padding: 10px;

		&.active {
			height: auto;
			opacity: 1;
		}

		&-label {
			position: absolute;
			content: '';

			height: 0;

			border: 10px solid transparent;
			opacity: 0;
			transition: .3s;
			pointer-events: none;

			&.active {
				height: auto;
				opacity: 1;
			}

			&.top {
				left: calc(50% - 10px);
				top: -12px;

				border-top: 10px solid $c_90;
			}
		}
	}

	&__clear {
		color: $o_50;
		cursor: pointer;

		& i {
			pointer-events: none;
		}
	}

	&__error {
		color: $r_70;
		font-size: 0.8em;

		margin-top: 8px;
	}
}
</style>