<template>
	<div class="tabs">
		<div
				class="tabs__labels-container"
				ref="tabsContainer"
		>
			<button
					class="clear tabs__label"
					v-for="tab in tabs"
					:key="tab.id"
					:class="{active: tab.title === selectedTab.title}"
					@click="selectTab(tab)"
			>
				{{ tab.title }}
			</button>
			<div class="tabs__line"></div>
			<div
					class="tabs__line active"
					:style="{left: lineLeft + 'px', width: lineWidth + 'px'}"
			></div>
		</div>
		<div
				class="tabs-content"
		>
			<slot/>
		</div>
	</div>
</template>

<script>
import { computed } from 'vue';

export default {
	name: 'cTabs',
	data() {
		return {
			tabs: [],
			selectedTab: {},
			lineWidth: 0,
			lineLeft: 0,
		}
	},
	methods: {
		selectTab(tab) {
			this.selectedTab = tab;
		},
		getTabs() {
			let activeTabIndex = 0;
			let tabs = this.$slots.default().map((tab, index) => {
				if (typeof tab.props?.active !== 'undefined') {
					activeTabIndex = index;
				}

				return {
					id: index,
					title: tab.props.title,
				}
			});

			this.selectTab(tabs[activeTabIndex]);

			return tabs;
		},
		calculateAnsSetNewLineStyle() {
			let tabsContainer = this.$refs.tabsContainer;
			let left = 0;
			for (let i = 0; i < this.selectedTab.id; i++) {
				left += tabsContainer.children[i].getBoundingClientRect().width;
			}
			this.lineWidth = tabsContainer.children[this.selectedTab.id].getBoundingClientRect().width;
			this.lineLeft = left;
		},
	},
	mounted() {
		this.tabs = this.getTabs();
	},
	updated() {
		this.calculateAnsSetNewLineStyle();
	},
	provide() {
		return {
			selectedTab: computed(() => (
					this.selectedTab
			)),
		}
	},
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.tabs {

	&__labels-container {
		display: flex;

		position: relative;

		width: 100%;

		background-color: $w;
		border-radius: 6px;
		overflow: hidden;

		margin-bottom: 12px;
	}

	&__label {
		color: $c_90;
		letter-spacing: .5px;
		font-weight: 600;
		font-size: 16px;
		text-transform: uppercase;

		border-radius: 6px 6px 0 0;
		border: 2px solid transparent;
		background-color: transparent;
		transition: color .2s;

		padding: 12px;
		&.active {
			color: $o_50;
		}

		&:focus {
			outline: none;
		}

		&:hover {
			color: $o_50;
		}

		&:focus-visible {
			border: 2px solid $c_90;
		}
	}

	&__line {
		position: absolute;
		display: block;
		bottom: 0;
		height: 1px;
		width: 100%;
		background-color: $gr_30;
		transition: all .3s ease;

		&.active {
			//display: none;
			width: 100px;

			height: 2px;
			background-color: $o_50;
		}
	}
}
</style>