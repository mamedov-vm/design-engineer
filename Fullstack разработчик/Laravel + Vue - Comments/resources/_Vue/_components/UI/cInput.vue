<template>
	<div class="input">
		<div class="input__row input__row--label">
			<label
					:for="id ?? name"
					class="input__label"
			>
				{{ label }}
			</label>
		</div>
		<div class="input__row input__row--control">
			<input
					:id="id ?? name"
					:name="name"
					type="text"
					:placeholder="placeholder"
					spellcheck="false"
					:disabled="disabled"
					autocomplete="off"

					class="input__control"
					:class="{'with-validator': isPattern, 'with-error': (isPattern && !modelValue.valid && errorMessage !== '') || isError, 'disabled': disabled}"
					ref="control"

					:value="modelValue.value"
					@input="updateControl"
			>
			<div
					class="input__info"
					role="button"
					v-if="isTip"
			>
				<i
						class="fa fa-info-circle"
						v-tooltip="{tip: tip, dir: tipDir}"
						aria-hidden="true"
				></i>
			</div>
			<transition
					name="flip"
					mode="out-in"
			>
				<svg
						v-if="isPattern"
						class="input__validator"
						:class="{'valid': modelValue.valid}"
						width="14px"
						height="12px"
						viewBox="0 0 14 12"
				>
					<path d="M1 7 5.5 11 L13 1"></path>
				</svg>
			</transition>
		</div>
		<div class="input__row input__row--helper">
			<div
					class="input__helper"
					v-if="isError || helper"
			>
				<transition
						name="flip"
						mode="out-in"
				>
					<div
							class="input__error"
							v-if="isError && !disabled"
							v-html="`<i class='fas fa-times-circle'></i> ` + errorMessage"
					></div>
					<div
							class="input__error"
							v-else-if="!modelValue.valid && errorMessage !== '' && !disabled"
							v-html="`<i class='fas fa-times-circle'></i> ` + errorMessage"
					></div>
					<div
							class="input__clue"
							v-else
							v-html="helper"
					>
					</div>
				</transition>
			</div>
			<div
					class="input__counter"
					v-if="counter"
			>{{ currentCount }}{{ maxlength ? '/' + maxlength : '' }}
			</div>
		</div>
	</div>
</template>

<script>
import directiveTooltip from '../Tools/cTooltip/directiveTooltip';

export default {
	name: 'cInput',
	inheritAttrs: false,
	directives: {tooltip: directiveTooltip},
	props: {
		modelValue: {
			type: Object,
			default: {
				value: '',
				valid: false,
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
		placeholder: {
			type: String,
			default: '',
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
		counter: {
			type: Boolean,
			default: false,
		},
		maxlength: {
			type: String,
			default: null,
		},
		pattern: {
			type: String,
			default: null,
		},
		disabled: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			isError: this.error !== '',
			isTip: this.tip && this.tip !== '',
			isPattern: this.pattern && this.pattern !== '',
			isLimited: this.maxlength && this.maxlength !== '',

			regExp: (
									this.pattern && this.pattern !== ''
							) ?
							new RegExp(
									'^' + this.pattern + '$',
									'',
							)
								: null,
			errorMessageDefault: 'Введенные данные некорректны',
			errorMessage: this.error ? this.error : '',
		}
	},
	methods: {
		updateControl: function (event) {
			this.$emit(
					'update:modelValue',
					{
						value: event.target.value,
						valid: this.regExp ? this.regExp.test(event.target.value.toString()) : true,
					},
			);

			this.isError = false;

			this.errorMessage = this.errorMessageDefault;
		},
	},
	computed: {
		currentCount: function () {
			return this.modelValue.value.length;
		},
	},
	mounted() {
		if (this.counter) {
			this.$refs.control.setAttribute(
					'maxlength',
					this.maxlength,
			);
		}
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.flip-enter-active,
.flip-leave-active {
	transition: all 0.2s;
}

.flip-enter-from,
.flip-leave-to {
	transform: translateZ(30px);
	opacity: 0;
}

.input {
	display: flex;
	flex-direction: column;

	width: 100%;

	margin-bottom: 8px;

	&__row {
		font-size: 1em;
		color: $c_90;

		&--label {
			margin: 6px 0 6px 0;
		}

		&--control {
			position: relative;

			width: 100%;
		}

		&--helper {
			display: flex;
			flex-wrap: nowrap;

			font-size: 0.8em;
			line-height: 1.2em;
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
		width: 100%;

		padding: 5px;

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

		&.with-validator {
			padding-right: 26px;
		}

		&.with-validator ~ .input__validator {
			right: 8px;
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

	&__validator {
		position: absolute;
		top: 50%;

		fill: none;
		transform: translate(0, 0) scale(0);
		transition: all 0.15s ease;

		& path {
			stroke: $o_50;
			stroke-width: 2;
		}

		&.valid {
			transform: translate(0, -50%) scale(1);
		}
	}

	&__helper {
		flex: 1;

		margin-top: 8px;
	}

	&__error {
		color: $r_70;
	}

	&__counter {
		line-height: 1.2em;
		letter-spacing: 0.1em;

		margin: 8px 1px 0 14px;
	}
}
</style>