<template>
	<div class="switch">
		<div class="switch__col switch__col--label">
			<label
					class="switch__label"
					:for="id ?? name"
					v-html="label"
			></label>
			<div
					class="switch__helper"
					v-html="helper"
			></div>
		</div>
		<div class="switch__col switch__col--control">
			<input
					:id="id ?? name"
					:name="name"

					class="switch__control"
					:class="{ 'disabled': disabled }"

					type="checkbox"

					:checked="modelValue"
					@change="updateControl"
					true-value="true"
					false-value="false"
					:disabled="disabled"
			/>
			<div class="switch__control-knobs"></div>
			<div class="switch__control-layer"></div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'cSwitch',
	inheritAttrs: false,
	props: {
		modelValue: {
			type: Boolean,
			default: false,
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
		helper: {
			type: String,
			default: null,
		},
		disabled: {
			type: Boolean,
			default: false,
		},
	},
	methods: {
		updateControl: function (event) {
			this.$emit(
					'update:modelValue',
					event.target.checked,
			);
		},
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.switch {
	display: flex;
	gap: 10px;

	width: 100%;

	margin-bottom: 8px;

	&__col {
		font-size: 1em;
		color: $c_90;

		&--label {
			display: flex;
			flex-direction: column;
			flex: 1;

			width: 100%;

			text-overflow: ellipsis;
			white-space: nowrap;
			overflow: hidden;

			margin-top: 6px;
		}

		&--control {
			align-self: center;

			position: relative;
			top: 50%;

			width: 50px;
			height: 26px;

			margin: 6px 0 4px 0;
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
		position: relative;

		width: 100%;
		height: 100%;

		opacity: 0;
		cursor: pointer;
		z-index: 3;

		padding: 0;
		margin: 0;

		&-knobs,
		&-layer {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
		}

		&-layer {
			width: 100%;

			border-radius: 12px;
			border: 1px solid $gr_50;
			box-shadow: 0 0 4px $gr_30;

			transition: 0.1s;
			z-index: 1;
		}

		&-knobs:before {
			content: "\f00d";

			position: absolute;
			top: 50%;
			left: 4px;
			transform: translateY(-50%);

			width: 20px;
			height: 10px;

			color: #fff;
			font-size: 10px;
			font-weight: bold;
			text-align: center;
			line-height: 1px;
			font-family: 'Font Awesome 5 Pro', serif;

			background-color: $gr_60;
			border-radius: 50%;
			transition: all 0.3s ease, left 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15);

			padding: 9px 4px;
		}

		&:active + &-knobs:before {
			width: 30px;
			border-radius: 100px;
		}

		&:checked:active + &-knobs:before {
			margin-left: -10px;
		}

		&:checked + &-knobs:before {
			content: "\f00c";
			left: 26px;
			background-color: $o_50;
		}

		&:hover ~ &-layer {
			border-color: $gr_80;
			outline: 1px solid $gr_80;
		}

		&:focus-visible ~ &-layer {
			border-color: $o_50;
			outline: 2px solid $o_50;
		}

		&.disabled ~ &-layer {
			color: $gr_60;

			border: 1px solid $gr_50 !important;
			outline-color: transparent !important;
			background-color: $gr_09;
			box-shadow: 0 0 4px $gr_30;
			cursor: not-allowed;

			z-index: 4;

			&:hover {
				border: 1px solid $gr_50;
				outline: none;
				box-shadow: 0 0 4px $gr_50;
			}
		}

		&.disabled ~ &-knobs:before {
			cursor: not-allowed;
			z-index: 5;
		}
	}

	&__helper {
		font-size: 0.8em;
		line-height: 1.2em;
		font-weight: 400;
		color: $gr_60;

		margin-top: 4px;
	}
}
</style>