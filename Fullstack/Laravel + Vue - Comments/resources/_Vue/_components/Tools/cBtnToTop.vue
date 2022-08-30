<template>
	<div
			class="btn2top"
			id="btn2top"
			title="Подняться наверх"
			role="button"
			@click="scrollToTop"
			v-if="isShow"
	>
		<i
				class="fa fa-arrow-up"
				aria-hidden="true"
		></i>
	</div>
</template>

<script>
export default {
	name: 'cBtnToTop',
	data() {
		return {
			isShow: false,
		}
	},
	methods: {
		scrollToTop: function () {
			window.scrollTo({
				top: 0,
				behavior: 'smooth',
			});
		},
		onScrollEvent: function () {
			this.isShow = window.scrollY > 0.25 * screen.height;
		},
	},
	mounted() {
		document.addEventListener(
				'scroll',
				this.onScrollEvent,
				true,
		);
	},
	beforeDestroy() {
		document.removeEventListener(
				'scroll',
				this.onScrollEvent,
				true,
		);
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.btn2top {
	position: fixed;

	bottom: 60px;

	width: 50px;
	height: 50px;
	border-radius: 50%;

	background-color: rgba(255, 108, 55, 0.85);

	text-align: center;

	cursor: pointer;
	transition: 0.35s;

	z-index: 400;

	& i {
		font-size: 40px;
		color: rgba(255, 255, 255, 0.75);
		line-height: 50px;
	}

	&:hover {
		background-color: rgba(255, 108, 55, 1);
	}

	&:hover i {
		color: rgba(255, 255, 255, 1);
	}

	@media (min-width: 1849px) {
		& {
			right: 14%;
		}
	}

	@media (min-width: 1750px) and (max-width: 1850px) {
		& {
			right: 12%;
		}
	}

	@media (min-width: 1580px) and (max-width: 1749px) {
		& {
			right: 8%;
		}
	}

	@media (min-width: 1450px) and (max-width: 1579px) {
		& {
			right: 4%;
		}
	}

	@media (min-width: 1000px) and (max-width: 1449px) {
		& {
			right: 70px;
		}
	}

	@media (min-width: 700px) and (max-width: 999px) {
		& {
			right: 50px;
			bottom: 50px;
		}
	}

	@media (max-width: 699px) {
		& {
			right: 30px;
			bottom: 40px;
		}
	}
}
</style>