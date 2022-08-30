<template>
	<button
			class="button"
			@click="$emit('click')"
	>
		<slot></slot>
	</button>
</template>

<script>
export default {
	name: 'cButton',
	emits: [
		'click',
	],
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.button {
	line-height: 1.4em;
	font-weight: 600;
	text-align: center;
	text-decoration: none;
	color: $w;
	letter-spacing: 1px;

	min-width: 133px;

	background-color: $o_50;
	background-image: linear-gradient(to right, $o_50, $o_40, $o_50);
	border: 2px solid transparent;
	background-size: 200%;
	border-radius: 3px;

	padding: 5px 10px;
	margin-left: 10px;

	cursor: pointer;
	transition: .3s ease-in-out;

	&:first-child {
		margin-left: 0;
	}

	&:hover {
		background-color: $o_60;
		background-position: right;
	}

	&:focus-visible {
		border: 2px solid $c_90;
	}

	&.error {
		background-color: $r_70;
		background-image: linear-gradient(to right, $r_70, $r_60, $r_70);

		&:hover {
			background-color: $r_80;
			background-position: right;
		}
	}

	&.ok {
		background-color: $g_80;
		background-image: linear-gradient(to right, $g_80, $g_70, $g_80);

		&:hover {
			background-color: $g_90;
			background-position: right;
		}
	}

	&:disabled {
		background-color: $gr_50;
		background-image: linear-gradient(to right, $gr_50, $gr_60, $gr_50);
		cursor: not-allowed;
	}

	&:disabled:hover{
		background-position: left;
	}
}
</style>