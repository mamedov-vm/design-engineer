<template>
	<div class="input-inline">
		<div class="input-inline__col input-inline__col--label">
			<div class="input-inline__row input-inline__row--label">
				<label
						:for="id ?? name"
						class="input-inline__label"
				>
					{{ label }}
				</label>
			</div>
			<div class="input-inline__row input-inline__row--helper">
				<div
						class="input-inline__helper"
						v-if="isError || helper"
				>
					<transition
							name="flip"
							mode="out-in"
					>
						<div
								class="input-inline__error"
								v-if="(isError || !modelValue.valid) && !disabled"
								v-html="`<i class='fas fa-times-circle'></i> ` + errorMessage"
						></div>
						<div
								class="input-inline__clue"
								v-else
								v-html="helper"
						></div>
					</transition>
				</div>
			</div>
		</div>
		<div
				class="input-inline__col"
				v-bind:style="inputStyle"
		>
			<div class="input-inline__row input-inline__row--control">
				<input
						:id="id ?? name"
						:name="name"
						type="text"
						spellcheck="false"
						:disabled="disabled"
						autocomplete="off"

						class="input-inline__control"
						:class="{'with-validator': isPattern, 'with-error': (isPattern && !modelValue.valid) || isError, 'disabled': disabled}"
						ref="control"

						:value="modelValue.value"
						@input="updateControl"
				>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'cInlineInput',
	inheritAttrs: false,
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
		error: {
			type: String,
			default: '',
		},
		helper: {
			type: String,
			default: null,
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
		inputWidth: {
			type: String,
			default: '40px',
		},
	},
	data: function () {
		return {
			isError: this.error !== '',
			isInfo: this.info && this.info !== '',
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
			errorMessage: this.error ? this.error : 'Введенные данные некорректны',

			inputStyle: {
				width: this.inputWidth,
			},
		}
	},
	methods: {
		updateControl: function (event) {
			this.$emit(
					'update:modelValue',
					{
						value: event.target.value,
						valid: this.regExp.test(event.target.value.toString())
					},
			);

			this.isError = false;

			this.errorMessage = this.errorMessageDefault;
		},
	},
	mounted() {
		if (this.maxlength) {
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

.input-inline {
	display: flex;
	justify-content: space-between;
	align-items: center;

	width: 100%;

	padding: 8px 0 8px 0;

	&__col {
		display: flex;
		flex-direction: column;

		&--label {
			flex: 1;

			overflow: hidden;
		}
	}

	&__row {
		font-size: 1em;
		color: $c_90;

		&--label {

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

			margin-top: 4px;
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

		text-align: center;

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
			outline: $r_60 solid 1px;

			&:focus-visible {
				border-color: $r_60;
				outline: $r_60 solid 2px;
			}

			&:focus {
				border-color: $r_60;
				outline: $r_60 solid 2px;
			}
		}
	}

	&__helper {
		flex: 1;
	}

	&__error {
		color: $r_70;
	}
}
</style>