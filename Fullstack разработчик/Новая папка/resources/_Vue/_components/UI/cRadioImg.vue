<template>
  <div class="radio-img">
    <div class="radio-img__label">
      {{ label }}
    </div>
    <div class="radio-img__helper">
      {{ helper }}
    </div>
    <div class="radio-img__container">
      <label :for="option.value" class="radio-img__wrapper" v-bind:style="cardStyle" v-for="option in options">
        <!--suppress JSUnresolvedVariable -->
        <input
            type="radio"
            :name="name"
            :id="option.value"
            class="radio-img__control"
            :class="{ 'disabled': option.disabled !== undefined && option.disabled }"
            @change="currentOption = option"
            :checked="currentOption.value === option.value || selectedOption.value === option.value"
            :disabled="option.disabled !== undefined && option.disabled"
        />
        <span class="radio-img__content">
        <span class="radio-img__content-icon">
          <svg
              v-if="currentOption.value === option.value || selectedOption.value === option.value"
              width="12px"
              height="12px"
              viewBox="0 0 14 14">
          <path d="M1 7 5.5 11 L13 1"></path>
        </svg>
        </span>
        <span class="radio-img__content-img">
          <img
              :src="option.img"
              :alt="option.alt ?? ''"
          />
        </span>
        <span class="radio-img__content-label">
          {{ option.label }}
        </span>
          <span class="radio-img__content-description" v-if="option.description">
            {{ option.description ?? '' }}
          </span>
      </span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: "cRadioImg",
  inheritAttrs: false,
  props: {
    modelValue: {
      type: [String, Number]
    },
    currentOption: {
      type: Object,
      default: {
        label: 'Выберите из списка',
        value: null
      }
    },
    label: {
      type: String,
      default: ''
    },
    id: {
      type: String
    },
    name: {
      type: String,
      required: true
    },
    helper: {
      type: String,
      default: null
    },
    options: {
      type: Array,
      default: []
    },
    cardWidth: {
      type: String,
      default: '40%'
    }
  },
  data() {
    return {
      cardStyle: {
        width: this.cardWidth
      }
    }
  },
  computed: {
    selectedOption() {
      if (!this.currentOption.value) {
        let selectedOption = this.options.find(option => option.selected);
        if (selectedOption) {
          this.$emit('update:modelValue', selectedOption.value);
          return selectedOption;
        }
      }
      return this.currentOption;
    }
  },
  methods: {},
  watch: {
    currentOption() {
      this.$emit('update:modelValue', this.currentOption.value);
    }
  }
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.radio-img {
  display: flex;
  flex-direction: column;
  width: 100%;

  font-size: 1em;
  color: $c_90;

  margin-bottom: 12px;

  &__label {
    font-weight: 500;

    margin-top: 6px;
  }

  &__helper {
    display: flex;
    flex-wrap: nowrap;

    font-size: 0.8em;
    line-height: 1.2rem;
    font-weight: 400;
    color: $gr_60;

    margin-bottom: 8px;
  }

  &__container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    gap: 16px;
  }

  &__wrapper {
    position: relative;

    background: $w;
    box-shadow: 2px 2px 4px 2px $gr_10;
    border-radius: 6px;

    transition: .2s;

    cursor: pointer;
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
    transform: scale(1.2);

    &:before {
      transform: scale(1);
      opacity: 1;
    }
  }

  &__control:checked + &__content {
    outline: 2px solid $o_50;
    border-color: transparent;
  }

  &__control.disabled + &__content {
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

  &__control:focus + &__content &__content-icon {
    box-shadow: 0 0 0 4px rgba(255, 108, 55, 0.2);
    border-color: $o_50;
  }

  &__control:focus + &__content {
    outline: 2px solid $o_50;
  }

  &__content {
    display: flex;
    flex-direction: column;

    height: 100%;

    border-radius: 6px;
    border: 1px solid $gr_50;

    transition: .1s;

    padding: 12px;

    &:hover {
      outline: 1px solid $c_90;
      border-color: $c_90;
    }

    &-icon {
      position: relative;

      width: 20px;
      height: 20px;

      border-radius: 50%;
      transition: .2s;

      & svg {
        position: absolute;
        left: 50%;
        top: 50%;

        transform: translateY(calc(-50% + 1px)) translateX(-50%);

        fill: none;

        & path {
          stroke: $w;
          stroke-width: 3;
        }
      }
    }

    &-img {
      display: block;

      margin: 10px 0;

      & img {
        width: 100%;
      }
    }

    &-label {
      font-weight: 500;
      letter-spacing: -0.24px;
      text-align: center;

      overflow: hidden;
    }

    &-description {
      text-align: center;
      font-size: 0.8em;
      line-height: 1.2rem;
      font-weight: 400;
      color: $gr_60;
    }
  }
}
</style>