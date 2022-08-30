<template>
	<div class="checkbox">
		<div class="checkbox__container">
			<label
					:for="id ?? name"
					class="checkbox__wrapper"
			>
				<input
						type="checkbox"
						:name="name"
						:id="id ?? name"
						class="checkbox__control"
						:class="{ 'disabled': disabled }"
						@change="updateControl"
						:checked="modelValue"
						:disabled="disabled"
				/>
				<span class="checkbox__content">
        <span class="checkbox__content-icon">
          <svg
							width="12px"
							height="12px"
							viewBox="0 0 14 14"
					>
          <path d="M1 7 5.5 11 L13 1"></path>
        </svg>
        </span>
        <span class="checkbox__content-text">
          <span class="checkbox__content-label">
          {{ label }}
          </span>
          <span
							class="checkbox__content-description"
							v-if="helper"
							v-html="helper ?? ''"
					></span>
        </span>
      </span>
			</label>
		</div>
	</div>
</template>

<script>
export default {
	name: 'cCheckbox',
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

.checkbox {
	display: flex;
	flex-direction: column;

	width: 100%;

	font-size: 1em;
	color: $c_90;

	margin: 8px 0;

	&__container {
		width: 100%;

		padding-top: 6px;
	}

	&__wrapper {
		position: relative;

		transition: .2s;

		cursor: pointer;
	}

	&__wrapper:hover &__content &__content-icon {
		background-color: $gr_10;
	}

	&__control {
		position: absolute;
		left: 0;
		top: 0;
		width: 0;
		height: 0;

		opacity: 0;
	}

	&__control:checked + &__content &__content-icon {
		background: $o_50;
		border-color: $o_50;
		outline-color: $o_50;

		& svg path {
			stroke: $w;
		}

		&:before {
			transform: scale(1);
			opacity: 1;
		}
	}

	&__control:focus-visible ~ &__content &__content-icon {
		outline-color: $c_90;
	}

	&__control.disabled + &__content {
		color: $gr_60;

		cursor: not-allowed;
	}

	&__control.disabled + &__content &__content-icon {
		background-color: $gr_20;
		outline-color: $gr_20;
	}

	&__content {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		align-items: center;
		gap: 16px;

		height: 100%;

		border-radius: 6px;
		transition: .1s;

		padding: 0 8px 0 12px;

		&:hover + &-icon {
			outline: 1px solid $c_90;
			border-color: $c_90;
		}

		&-icon {
			display: block;
			position: relative;

			width: 20px;
			height: 20px;

			outline: 2px solid $gr_20;
			box-shadow: 2px 2px 4px 2px $gr_10;

			border-radius: 2px;
			transition: .2s;

			& svg {
				position: absolute;
				left: 50%;
				top: 50%;

				transform: translateY(calc(-50% + 1px)) translateX(-50%);

				fill: none;

				& path {
					stroke-width: 3;
				}
			}
		}

		&-text {
			display: flex;
			flex-direction: column;
			align-self: center;
			flex: 1;

			overflow: hidden;
		}

		&-label {
			font-weight: 500;
			letter-spacing: -0.24px;
			text-align: left;

			overflow: hidden;
		}

		&-description {
			font-size: 0.8em;
			line-height: 1.2rem;
			font-weight: 400;
			color: $gr_60;

			margin-top: 2px;
		}

		&-info {
			width: 16px;
			height: 16px;

			font-size: 16px;
			text-align: center;
			color: $o_50;
			line-height: 16px;
		}
	}
}
</style>