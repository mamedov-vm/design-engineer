<template>
	<div
			class="loader"
	>
		<div class="loader-container">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
		<div class="loader-label">
			Идет обмен ионами...
		</div>
	</div>
</template>

<script>
export default {
	name: 'cLoader',
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.loader {
	position: relative;

	width: 100%;
	height: 250px;

	background-color: $w;
	overflow: hidden;

	$size: 10px;

	&-container {
		position: absolute;
		left: 50%;
		top: calc(50% - 20px);

		transform: translateX(-50%) translateY(-50%) rotate(90deg);

		width: 400px;
		height: 440px;

		margin: 0 auto;

		div {
			position: absolute;
			left: 0;

			width: $size;
			height: $size;

			background: $c_90;
			border-radius: 50%;
			opacity: 0;
		}

		$time: 1.5s;
		$delay: 0.1s;
		$padding: 15px;

		@for $i from 0 through 54 {
			& div:nth-child( #{$i + 1} ) {
				top: 2*$size + $i * $padding + 8px;
				@if $i % 2 == 0 {
					background: $o_50;
					animation: dna_rotate #{$time} #{$i * $delay} infinite ease-in-out;
				} @else {
					animation: dna_rotate #{$time} #{$i * $delay + 0.75s } infinite ease-in-out;
				}
			}
		}

		@keyframes dna_rotate {
			0% {
				opacity: 1;
				transform: scale(1);
				left: 40%;
				z-index: 0;
			}
			25% {
				opacity: 1;
				transform: scale(1.8);
			}
			50% {
				opacity: 1;
				left: 60%;
				z-index: 1;
				transform: scale(1);
			}
			75% {
				opacity: 1;
				transform: scale(0.5);
			}
			100% {
				opacity: 1;
				left: 40%;
				z-index: 0;
				transform: scale(1);
			}
		}
	}

	&-label {
		position: absolute;
		left: 50%;
		top: calc(50% + 16px);

		transform: translateX(-50%) translateY(calc(-50% + 70px));

		width: 100%;

		text-align: center;
		font-weight: 600;
		letter-spacing: 0.05rem;

		background: linear-gradient(45deg, $c_90, $c_90, $o_50, $c_90, $c_90);
		background-size: 300%;
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;

		animation: dna_text 6s ease-in-out infinite;

		@keyframes dna_text {
			0% {
				background-position: 0 50%;
			}
			50% {
				background-position: 100% 50%;
			}
			100% {
				background-position: 0 50%;
			}
		}
	}
}
</style>