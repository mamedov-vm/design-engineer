<template>
	<div class="select">
		<div class="select__row select__row--label">
			<label
					class="select__label"
					:for="id ?? name"
			>
				{{ label }}
			</label>
		</div>
		<div class="select__row select__row--control">
			<!--suppress JSUnresolvedVariable -->
			<input
					class="select__control"

					readonly=""
					type="text"
					:id="id ?? name"
					:name="name"
					:disabled="disabled"

					:class="{ 'disabled': disabled }"

					ref="control"
					@keydown.space.enter="toggleListVisible"
			>
			<div
					class="select__info"
					role="button"
					v-if="isTip"
			>
				<i
						class="fas fa-info-circle"
						v-tooltip="{tip: tip, dir: tipDir}"
						aria-hidden="true"
				></i>
			</div>
			<label
					class="select__facade"
					:class="{'with-error': isError}"
					:for="id ?? name"

					ref="facade"
					@click="toggleListVisible"
			>
				{{ selectedOption.label }}
				<i
						class="fas fa-chevron-down select__arrow"
						:class="{'up' : isListShow}"
				></i>
			</label>
			<transition
					name="flip"
					mode="in-out"
			>
				<div
						class="select__list"
						v-show="isListShow"
				>
					<div v-for="option in options">
						<!--suppress JSUnresolvedVariable -->
						<div
								class='select__list-item'
								:class="{'selected': currentOption.value === option.value || selectedOption.value === option.value}"
								tabindex="0"
								@click="currentOption = option"
								@keydown.space.enter="currentOption = option"
						>
							<i
									class="far fa-check"
									v-show="currentOption.value === option.value || selectedOption.value === option.value"
							></i>
							{{ option.label }}
						</div>
					</div>
				</div>
			</transition>
		</div>
		<div class="select__row select__row--helper">
			<div class="select__helper">
				<transition
						name="flip"
						mode="out-in"
				>
					<div
							class="select__error"
							v-if="isError && !disabled"
					>
						<i class="fas fa-times-circle" aria-hidden="true"></i> {{ errorMessage }}
					</div>
					<div
							class="select__clue"
							v-else
					>{{ helper }}
					</div>
				</transition>
			</div>
		</div>
	</div>
</template>

<script>
import directiveTooltip from '../Tools/cTooltip/directiveTooltip';

export default {
	name: 'cSelect',
	inheritAttrs: false,
	directives: {tooltip: directiveTooltip},
	props: {
		modelValue: {
			type: [String, Number],
		},
		currentOption: {
			type: Object,
			default: {
				label: 'Выберите из списка',
				value: null,
			},
		},
		label: {
			type: String,
			default: '',
		},
		id: {
			type: String,
		},
		name: {
			type: String,
			required: true,
		},
		error: {
			type: String,
			default: '',
		},
		helper: {
			type: String,
			default: null,
		},
		tip: {
			type: String,
			default: null,
		},
		tipDir: {
			type: String,
			default: 'l',
		},
		options: {
			type: Array,
			default: [],
		},
		disabled: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			isTip: this.tip && this.tip !== '',
			isError: this.error !== '',
			errorMessage: this.error ? this.error : '',

			isListShow: false,
		}
	},
	computed: {
		selectedOption() {
			if (!this.currentOption.value) {
				let selectedOption = this.options.find(option => option.selected);
				if (selectedOption) {
					this.$emit(
							'update:modelValue',
							selectedOption.value,
					);
					return selectedOption;
				}
			}
			return this.currentOption;
		},
	},
	methods: {
		hideList(e) {
			if (e.target !== this.$refs.facade && e.target !== this.$refs.control) {
				this.isListShow = false;
			}
		},
		toggleListVisible() {
			if (!this.disabled) {
				this.isListShow = !this.isListShow;
			}

			this.isError = false;
		},
	},
	watch: {
		currentOption() {
			if (this.isListShow) {
				this.$refs.control.focus();
			}
			this.isListShow = false;

			this.$emit(
					'update:modelValue',
					this.currentOption.value,
			);
		},
	},
	mounted() {
		document.addEventListener(
				'click',
				this.hideList,
				true,
		);
	},
	beforeDestroy() {
		document.removeEventListener(
				'click',
				this.hideList,
				true,
		);
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.select {
	display: flex;
	flex-direction: column;

	width: 100%;

	margin-bottom: 8px;

	&__row {
		font-size: 1em;
		color: $c_90;

		&--label {
			margin: 6px 0 4px 0;
		}

		&--control {
			position: relative;

			width: 100%;
		}

		&--helper {
			display: flex;
			flex-wrap: nowrap;

			font-size: 0.8em;
			line-height: 1.2rem;
			font-weight: 400;
			color: $gr_60;
		}
	}

	&__label {
		font-weight: 500;

		&-required {
			color: $o_50;
			font-size: 1.1em;

			margin-left: -0.1em;
		}
	}

	&__control {
		position: absolute;

		width: 0;
		height: 0;

		opacity: 0;
	}

	&__control:focus ~ &__facade {
		border-color: $o_50;
		outline: 2px solid $o_50;
	}

	&__control:focus-visible ~ &__facade {
		border-color: $o_50;
		outline: 2px solid $o_50;
	}

	&__control.disabled ~ &__facade {
		color: $gr_60;

		border: 1px solid $gr_50 !important;
		outline-color: transparent !important;
		background-color: $gr_09;
		box-shadow: 0 0 4px $gr_30;
		cursor: not-allowed;

		&:hover {
			border: 1px solid $gr_50;
			outline: none;
			box-shadow: 0 0 4px $gr_50;
		}
	}

	&.with-error {
		border-color: $r_60;
		outline: 1px solid $r_60;

		&:focus-visible {
			border-color: $r_60;
			outline: 2px solid $r_60;
		}

		&:focus {
			border-color: $r_60;
			outline: 2px solid $r_60;
		}
	}

	&__facade {
		display: block;
		position: relative;

		width: 100%;

		text-overflow: ellipsis;
		white-space: nowrap;

		cursor: pointer;
		overflow: hidden;

		padding: 5px 30px 5px 5px;

		font-size: 0.9em;
		line-height: 1.4em;
		letter-spacing: 0.04em;

		background-color: $w;
		border: 1px solid $gr_50;
		border-radius: 2px;
		box-shadow: 0 0 4px $gr_30;

		transition: 0.1s;

		&::-moz-selection {
			color: $w;
			background-color: $o_50;
		}

		&::selection {
			color: $w;
			background-color: $o_50;
		}

		&::placeholder {
			font-size: 0.9em;
			color: $gr_50;
		}

		&:hover {
			border-color: $gr_80;
			outline: $gr_80 solid 1px;
		}

		&:focus-visible {
			border-color: $o_50;
			outline: $o_50 solid 2px;
		}

		&:focus, &.focus:hover, &.focus {
			border-color: $o_50;
			outline: $o_50 solid 2px;
		}

		&:active, &.active:active {
			border-color: $c_90;
			outline: $gr_90 solid 1px;
			box-shadow: 0 0 4px $gr_50;
		}

		&:disabled, &.disable {
			color: $gr_60;

			border: 1px solid $gr_50 !important;
			outline-color: transparent !important;
			background-color: $gr_09;
			box-shadow: 0 0 4px $gr_30;
			cursor: not-allowed;

			&:hover {
				border: 1px solid $gr_50;
				outline: none;
				box-shadow: 0 0 4px $gr_50;
			}
		}

		&.with-error {
			border-color: $r_60;
			outline: 1px solid $r_60;

			&:focus-visible {
				border-color: $r_60;
				outline: 2px solid $r_60;
			}

			&:focus {
				border-color: $r_60;
				outline: 2px solid $r_60;
			}
		}
	}

	&__arrow {
		position: absolute;
		top: 50%;
		right: 8px;

		transform: translateY(-50%);

		width: 16px;
		height: 16px;

		font-size: 18px;
		line-height: 16px;
		text-align: center;

		transition: .2s all;

		&.up {
			transform: translateY(-50%) rotateZ(180deg);
		}
	}

	&__list {
		display: flex;
		flex-direction: column;

		position: absolute;
		right: 0;
		bottom: 0;

		transform: translateY(calc(100% + 6px));

		max-height: 130px;
		width: 100%;


		background-color: $w;
		border: 1px solid $gr_50;
		border-radius: 2px;
		box-shadow: 0 0 4px $gr_30;

		//noinspection CssOverwrittenProperties
		overflow-y: auto;
		//noinspection CssInvalidPropertyValue,CssOverwrittenProperties
		overflow-y: overlay;
		overflow-x: hidden;
		z-index: 6;

		margin-top: 4px;

		&-item {
			width: 100%;
			height: 32px;

			font-size: 14px;
			text-overflow: ellipsis;
			white-space: nowrap;

			overflow: hidden;
			cursor: pointer;
			transition: 0.05s;

			padding: 4px 10px 4px 28px;

			&.selected {
				position: relative;

				transition: .1s all;

				& i {
					position: absolute;
					top: 50%;
					left: 32px;

					transform: translateY(-50%);

					color: $o_50;

					margin-left: -24px;
				}
			}

			&:hover {
				background-color: $gr_09;
			}


			&:focus-visible {
				background-color: $gr_15;
			}

			&.selected:focus-visible {
				color: $c_90;

				background-color: $gr_15;
			}
		}
	}

	&__info {
		position: absolute;
		right: 0;
		top: -1.5em;

		width: 16px;
		height: 16px;

		font-size: 16px;
		text-align: center;
		color: $o_50;
		line-height: 16px;
	}

	&__helper {
		flex: 1;

		margin-top: 8px;
	}

	&__error {
		color: $r_70;
	}
}
</style>