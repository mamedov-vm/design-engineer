const directiveTooltip = {
  name: 'tooltip',
  created: (el, binding) => {
    window.app.addTip(
        binding.value,
        el,
    )
  },
};

export default directiveTooltip;