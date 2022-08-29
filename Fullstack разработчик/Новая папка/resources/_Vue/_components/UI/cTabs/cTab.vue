<template>
	<div
			class="tab"
			:class="{active: activeTab.title === title}"
	>
		<div class="tab-content">
			<slot/>
		</div>
	</div>
</template>

<script>
export default {
	name: 'cTab',
	inject: ['selectedTab'],
	props: {
		title: {
			type: String,
			required: true,
		},
	},
	data() {
		return {
			activeTab: this.selectedTab,
		}
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.tab {
	height: 0;

	opacity: 0;
	overflow: hidden;
	transition: opacity 1s ease-out;

	&.active {
		opacity: 1;
		height: auto;
	}

	&-content {
		&:last-child {
			margin-bottom: -10px;
		}
	}
}
</style>