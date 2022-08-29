<template>
	<div class="textarea">
		<div class="textarea__row textarea__row--label">
			<label
					:for="id ?? name"
					class="textarea__label"
			>
				{{ label }}
			</label>
		</div>
		<div class="textarea__row textarea__row--control">
			<!--suppress JSUnresolvedVariable -->
			<textarea
					:id="id ?? name"
					:name="name"
					:placeholder="placeholder"
					spellcheck="false"
					:rows="rows"
					:disabled="disabled"

					class="textarea__control"
					:class="{ 'with-error': isError, 'disabled': disabled }"
					ref="control"

					:value="modelValue"
					@input="updateControl"
			></textarea>
			<div
					class="textarea__info"
					role="button"
					v-if="isTip"
			>
				<i
						class="fas fa-info-circle"
						v-tooltip="{tip: tip, dir: tipDir}"
						aria-hidden="true"
				></i>
			</div>
		</div>
		<div class="textarea__row textarea__row--helper">
			<div class="textarea__helper">
				<transition
						name="flip"
						mode="out-in"
				>
					<div
							class="textarea__error"
							v-if="isError && !disabled"
					>
						<i class="fas fa-times-circle" aria-hidden="true"></i> {{ errorMessage }}
					</div>
					<div
							class="textarea__clue"
							v-else
					>{{ helper }}
					</div>
				</transition>
			</div>
			<div
					class="textarea__counter"
					v-if="counter"
			>{{ currentCount }}{{ maxlength ? '/' + maxlength : '' }}
			</div>
		</div>
	</div>
</template>

<script>
import directiveTooltip from '../Tools/cTooltip/directiveTooltip';

export default {
	name: 'cTextarea',
	inheritAttrs: false,
	directives: {tooltip: directiveTooltip},
	props: {
		modelValue: {
			type: [String, Number],
			default: '',
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
		rows: {
			type: String,
			default: '3',
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
			isLimited: this.maxlength && this.maxlength !== '',

			regExp: (
									this.pattern && this.pattern !== ''
							) ?
							new RegExp(
									'^' + this.pattern + '$',
									'gm',
							)
								: null,
			errorMessage: this.error ? this.error : '',
		}
	},
	methods: {
		updateControl: function (event) {
			this.$emit(
					'update:modelValue',
					event.target.value,
			);

			this.isError = false;
		},
	},
	computed: {
		currentCount: function () {
			return this.modelValue.length;
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

.textarea {
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

			margin-bottom: -7px;
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
		width: 100%;

		resize: none;

		font-size: 0.9em;
		line-height: 1.4em;
		letter-spacing: 0.04em;

		background-color: $w;
		border: 1px solid $gr_50;
		border-radius: 2px;
		box-shadow: 0 0 4px $gr_30;

		transition: 0.1s;

		padding: 10px 8px;

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

	&__clue {

	}

	&__counter {
		line-height: 1.2em;
		letter-spacing: 0.1em;

		margin: 8px 1px 0 14px;
	}
}
</style>