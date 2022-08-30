<template>
  <div class="checkbox-title">
    <div class="checkbox-title__label">
      {{ label }}
    </div>
    <div class="checkbox-title__helper">
      {{ helper }}
    </div>
  </div>
</template>

<script>
export default {
  name: "cCheckboxTitle",
  inheritAttrs: false,
  props: {
    label: {
      type: String,
      required: true
    },
    helper: {
      type: String,
      default: null
    }
  }
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.checkbox-title {
  display: flex;
  flex-direction: column;

  width: 100%;

  font-size: 1em;
  color: $c_90;

  margin-bottom: -2px;

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

		margin-top: 2px;
  }
}
</style>