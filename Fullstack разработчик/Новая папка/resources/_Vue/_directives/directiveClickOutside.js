/**
 * Директива v-clickOutside
 * Параметры:
 *  button - ref кнопки, при клике на которую происходит открытие блока;
 *  toggle(el) - [optional] функция, которая выполняется при повторном нажатии на кнопку button;
 *  close(el) - [optional] функция, которая выполняется при клике вне области блока el и кнопки button.
 *
 * Если параметры не заданы, то применяется скрытие/отображение через display = none/block
 */

const clickOutside = {
  name: 'clickOutside',
  beforeMount: function (el, binding, vnode) {
    binding.clickOutsideEvent = function (event) {
      if (event.target === binding.value.button()) {
        if (binding.value.toggle) {
          binding.value.toggle(el);
          return;
        } else {
          if (el.style.display === 'none') {
            el.style.display = 'block';
          } else {
            el.style.display = 'none';
          }
          return;
        }
      }
      if (!el.contains(event.target)) {
        if (binding.value.close) {
          binding.value.close(el);
        } else {
          el.style.display = 'none';
        }
      }
    }

    document.body.addEventListener(
        'click',
        binding.clickOutsideEvent,
    )
  },
  unmounted: function (el, binding, vnode) {
    document.body.removeEventListener(
        'click',
        binding.clickOutsideEvent,
    )
  },
};

export default clickOutside;