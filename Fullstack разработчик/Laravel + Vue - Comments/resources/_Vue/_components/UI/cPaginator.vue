<template>
	<ul
			class="paginator"
			:class="{'blocked': isBlocked}"
	>
		<li
				class="paginator__btn"
				:class="{'active' : (currentPageInPaginator !== 1)}"
				@click="changeCurrentPage(currentPageInPaginator - 1)"
		>
			<i
					class="fad fa-chevron-double-left"
					aria-hidden="true"
					role="button"
			></i>
		</li>
		<li
				class="paginator__numbers"
				@click="changeCurrentPage(1)"
				v-if="currentPageInPaginator > 3 && pageCount > 6"
		>
			1
		</li>
		<li
				class="paginator__dots"
				v-if="currentPageInPaginator > 3 && pageCount > 6"
		>
			<i class="fas fa-ellipsis-h-alt"></i>
		</li>
		<li
				class="paginator__numbers"
				v-for="pageNumber in displayedPages"
				@click="changeCurrentPage(pageNumber)"
				:class="{'active' : (currentPageInPaginator === pageNumber)}"
		>
			{{ pageNumber }}
		</li>
		<li
				class="paginator__dots"
				v-if="currentPageInPaginator < pageCount - 3 && pageCount > 6"
		>
			<i class="fas fa-ellipsis-h-alt"></i>
		</li>
		<li
				class="paginator__numbers"
				@click="changeCurrentPage(pageCount)"
				v-if="currentPageInPaginator < pageCount - 3 && pageCount > 6"
		>
			{{ pages[pageCount - 1] }}
		</li>
		<li
				class="paginator__btn"
				:class="{'active' : (currentPageInPaginator < pageCount)}"
				@click="changeCurrentPage(currentPageInPaginator + 1)"
		>
			<i
					class="fad fa-chevron-double-right"
					aria-hidden="true"
					role="button"
			></i>
		</li>
	</ul>
</template>

<script>
export default {
	name: 'cPaginator',
	props: {
		pageCount: {
			default: 0,
		},
		currentPage: {
			default: 0,
		},
		isBlocked: {
			default: false,
		},
	},
	data() {
		return {
			pages: [],
			currentPageInPaginator: this.currentPage,
		};
	},
	methods: {
		setPages() {
			for (let i = 1; i <= this.pageCount; i++) {
				this.pages.push(i);
			}
		},
		changeCurrentPage(value) {
			if (this.isBlocked) {
				window.app.newNoty(this.magic.wait, 2);
				return;
			}

			this.currentPageInPaginator = value;

			this.$emit(
					'update:currentPage',
					value,
			)
		},
	},
	computed: {
		displayedPages() {

			if (this.pageCount < 6) {
				return this.pages;
			}

			if (this.currentPageInPaginator === 1) {
				return this.pages.slice(
						this.currentPageInPaginator - 1,
						this.currentPageInPaginator + 4,
				);
			}

			if (this.currentPageInPaginator === this.pageCount) {
				return this.pages.slice(
						this.currentPageInPaginator - 5,
						this.currentPageInPaginator + 1,
				);
			}

			if (this.currentPageInPaginator >= 4 && this.currentPageInPaginator <= this.pageCount - 4) {
				return this.pages.slice(
						this.currentPageInPaginator - 2,
						this.currentPageInPaginator + 1,
				);
			}

			if (this.currentPageInPaginator === 3) {
				return this.pages.slice(
						Math.max(
								this.currentPageInPaginator - 3,
								0,
						),
						this.currentPageInPaginator + 2,
				);
			}

			if (this.currentPageInPaginator === 4) {
				return this.pages.slice(
						Math.max(
								this.currentPageInPaginator - 3,
								0,
						),
						this.currentPageInPaginator + 2,
				);
			}

			if (this.currentPageInPaginator === this.pageCount - 3) {
				return this.pages.slice(
						Math.max(
								this.currentPageInPaginator - 2,
								0,
						),
						this.currentPageInPaginator + 3,
				);
			}

			if (this.currentPageInPaginator === this.pageCount - 2) {
				return this.pages.slice(
						Math.max(
								this.currentPageInPaginator - 3,
								0,
						),
						this.currentPageInPaginator + 3,
				);
			}

			if (this.currentPageInPaginator === this.pageCount - 1) {
				return this.pages.slice(
						Math.max(
								this.currentPageInPaginator - 4,
								0,
						),
						this.currentPageInPaginator + 3,
				);
			}

			return this.pages.slice(
					Math.max(
							this.currentPageInPaginator - 3,
							0,
					),
					this.currentPageInPaginator + 3,
			);
		},
	},
	watch: {
		pageCount() {
			this.setPages();
		},
		currentPage(value) {
			this.currentPageInPaginator = value;
		},
	},
	mounted() {
		this.setPages();
	},
	emits: ['update:currentPage'],
}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

.paginator {
	display: flex;
	justify-content: center;
	align-items: center;

	&.blocked * {
		cursor: wait;
	}

	&__numbers,
	&__btn,
	&__dots {
		display: flex;
		justify-content: center;
		align-items: center;

		font-size: 1.4rem;

		cursor: pointer;

		margin: 8px;
	}

	&__dots {
		width: 32px;
		height: 32px;

		color: $gr_80;

		cursor: initial;
	}

	&__numbers {
		width: 32px;
		height: 32px;

		border-radius: 0.4rem;

		&:hover {
			color: $o_50;
		}

		&.active {
			color: $w;
			font-weight: 600;

			background: $o_50;
			border: 1px solid $o_50;
		}
	}

	&__btn {
		color: $gr_20;

		pointer-events: none;

		&.active {
			color: $gr_80;

			pointer-events: initial;

			&:hover {
				color: $o_50;
			}
		}
	}
}
</style>