<template>
	<teleport to="body">
		<transition
				name="tooltip-fade"
		>
			<div
					:style="{left: leftCoordinate + 'px', top: topCoordinate + 'px'}"
					v-show="isShow"
					ref="tooltip"
			>
				<div
						class="tooltip-content"
						v-html="tip"
				></div>
				<div
						class="tooltip-label"
						ref="tooltipLabel"
				></div>
			</div>
		</transition>
	</teleport>
</template>

<script>
export default {
	name: 'cTooltip',
	data() {
		return {
			tip: null,
			tipsElements: [],
			isShow: false,
			leftCoordinate: 0,
			topCoordinate: 0,
		}
	},
	created() {
		this.labelSize = 10;
		this.labelOffset = 4;
		this.maxTooltipWidth = 300;

		window.app.addTip = this.add;

		document.addEventListener(
				'mouseover',
				(e) => {
					let targetTip = this.tipsElements.filter(current => current.el === e.target);
					if (targetTip.length) {
						this.show(
								targetTip[0].tooltip,
								targetTip[0].el,
						);
					} else {
						this.hide();
					}
				},
				true,
		);

		document.addEventListener(
				'scroll',
				() => {
					this.hide();
				},
				true,
		);
	},
	methods: {

		add(tooltip, el) {
			this.tipsElements.push({
				tooltip,
				el,
			});
		},
		hide() {
			this.isShow = false;

			this.leftCoordinate = -9000;
			this.topCoordinate = -9000;
		},
		show(tooltip, el) {
			this.tip = tooltip.tip;

			/* Размер блока body */
			let parentWidth = this.$refs.tooltip.parentElement.offsetWidth;

			/* Габариты элемента с подсказкой */
			let elHeight = el.offsetHeight;
			let elWidth = el.offsetWidth;

			/* Центр элемента с подсказкой */
			let elCoords = el.getBoundingClientRect();
			let elCenterTop = Math.round(elCoords.top + el.offsetHeight);
			let elCenterLeft = Math.round(elCoords.left + el.offsetWidth);

			/* Рабочая область ярлычка */
			let labelWidth = this.labelSize + this.labelOffset;

			this.$refs.tooltip.classList.value = 'tooltip';

			this.$refs.tooltip.removeAttribute('style');
			this.$refs.tooltipLabel.removeAttribute('style');

			let left = -9000;
			let top = -9000;

			switch (tooltip.dir) {
				case 'r': {
					/* Подсказка расположена справа */
					if (elCenterLeft + this.maxTooltipWidth + labelWidth > parentWidth) {
						/* Выпирает вправо */
						left = elCenterLeft - elWidth / 2;
						top = elCenterTop + labelWidth;

						this.$refs.tooltip.style.transform = `translateX(calc(-50%)) translateY(0)`;

						this.$refs.tooltipLabel.style.left = `calc(50%)`;
						this.$refs.tooltip.classList.add('bottom');
					} else {
						/* Не выпирает */
						left = elCenterLeft + this.labelSize + this.labelOffset;
						top = elCenterTop - Math.round(elHeight / 2);

						this.$refs.tooltip.style.transform = 'translateX(0) translateY(-50%)';
						this.$refs.tooltip.classList.add('right');
					}
					break;
				}
				case 'l': {
					/* Подсказка расположена слева */
					if (elCenterLeft - this.maxTooltipWidth - labelWidth < 0) {
						/* Выпирает влево */
						left = elCenterLeft - elWidth - Math.round(labelWidth / 2);
						top = elCenterTop + labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(0) translateY(0)';

						this.$refs.tooltipLabel.style.left = `${ Math.round(labelWidth / 2) - 2 }px`;
						this.$refs.tooltip.classList.add('bottom');
					} else {
						/* Не выпирает */
						left = elCenterLeft - elWidth - this.labelSize - this.labelOffset;
						top = elCenterTop - Math.round(elHeight / 2);

						this.$refs.tooltip.style.transform = 'translateX(-100%) translateY(-50%)';
						this.$refs.tooltip.classList.add('left');
					}
					break;
				}
				case 't': {
					/* Подсказка расположена сверху */
					if (elCenterLeft + this.maxTooltipWidth / 2 > parentWidth) {
						/* Выпирает справа */
						left = elCenterLeft + labelWidth - 5;
						top = elCenterTop - elHeight - labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(-100%) translateY(-100%)';

						this.$refs.tooltipLabel.style.left = `calc(100% - ${ 2 * labelWidth }px)`;
						this.$refs.tooltip.classList.add('top');
					} else if (elCenterLeft - this.maxTooltipWidth / 2 < 0) {
						/* Выпирает слева */
						left = elCenterLeft - elWidth - Math.round(labelWidth / 2);
						top = elCenterTop - elHeight - labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(0) translateY(-100%)';

						this.$refs.tooltipLabel.style.left = `${ Math.round(labelWidth / 2) - 2 }px`;
						this.$refs.tooltip.classList.add('top');
					} else {
						/* Не выпирает */
						left = elCenterLeft - Math.round(elWidth / 2);
						top = elCenterTop - elHeight - labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(-50%) translateY(-100%)';

						this.$refs.tooltipLabel.style.left = `calc(50% - ${ elWidth })`;
						this.$refs.tooltip.classList.add('top');
					}
					break;
				}
				default: {
					/* Подсказка расположена снизу */
					if (elCenterLeft + this.maxTooltipWidth / 2 > parentWidth) {
						/* Выпирает справа */
						left = elCenterLeft + labelWidth - 5;
						top = elCenterTop + labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(-100%) translateY(0)';

						this.$refs.tooltipLabel.style.left = `calc(100% - ${ 2 * labelWidth - 1 }px)`;
						this.$refs.tooltip.classList.add('bottom');
					} else if (elCenterLeft - this.maxTooltipWidth / 2 < 0) {
						/* Выпирает слева */
						left = elCenterLeft - elWidth - Math.round(labelWidth / 2);
						top = elCenterTop + labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(0) translateY(0)';

						this.$refs.tooltipLabel.style.left = `${ Math.round(labelWidth / 2) - 2 }px`;
						this.$refs.tooltip.classList.add('bottom');
					} else {
						/* Не выпирает */
						left = elCenterLeft - Math.round(elWidth / 2);
						top = elCenterTop + labelWidth;

						this.$refs.tooltip.style.transform = 'translateX(-50%) translateY(0)';

						this.$refs.tooltipLabel.style.left = `calc(50% - ${ elWidth })`;
						this.$refs.tooltip.classList.add('bottom');
					}
				}
			}

			this.leftCoordinate = left;
			this.topCoordinate = top;

			this.isShow = true;
		},
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.tooltip-fade-enter-active,
.tooltip-fade-leave-active {
	transition: all 0.01s linear;
}

.tooltip-fade-enter-from,
.tooltip-fade-leave-to {
	opacity: 0;
}

.tooltip {
	position: fixed;
	left: -9000px;
	top: -9000px;

	width: max-content;
	max-width: 300px;

	color: $w;
	line-height: 20px;
	font-size: 14px;
	font-weight: 400;
	text-align: left;

	border-radius: 6px;
	background: $c_80;
	transition: opacity 0.5s;
	pointer-events: none;
	z-index: 999;

	padding: 10px;

	& i {
		font-style: normal;
		color: $o_50;
	}

	& dd {
		position: relative;

		width: 100%;

		text-align: left;

		margin: 10px auto 0 0;
		padding-top: 6px;

		&:before {
			content: '';

			position: absolute;
			top: -1px;
			left: 0;

			width: 80%;
			height: 1px;

			background-color: $w;
		}
	}

	&-content {
		width: 100%;

		& img {
			display: block;
			width: 85%;

			margin: 0 auto;
		}
	}

	&-label {
		position: absolute;

		content: '';

		border: 10px solid transparent;
	}

	&.right &-label {
		top: calc(50% - 10px);
		right: 100%;

		border-right: 10px solid $c_80;
	}

	&.left &-label {
		left: calc(100% - 1px);
		top: calc(50% - 10px);

		border-left: 10px solid $c_80;
	}

	&.top &-label {
		left: calc(50% - 10px);
		top: 100%;

		border-top: 10px solid $c_80;
	}

	&.bottom &-label {
		left: calc(50% - 10px);
		bottom: 100%;

		border-bottom: 10px solid $c_80;
	}
}
</style>