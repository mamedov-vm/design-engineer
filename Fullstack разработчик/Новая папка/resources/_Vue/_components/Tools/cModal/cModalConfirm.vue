<template>
	<div class="modal__confirmation">
		<div class="modal__confirmation-row">
			<div class="modal__confirmation-icon">
				<i
						:class="icon"
						aria-hidden="true"
				></i>
			</div>
			<div class="modal__confirmation-content">
				<div
						class="modal__confirmation-question"
						v-html="question"
				></div>
				<div
						class="modal__confirmation-description"
						v-html="description"
				></div>
			</div>
		</div>
		<div class="modal__confirmation-row modal__confirmation-row--content">
			<slot/>
		</div>
	</div>
</template>

<script>
export default {
	name: 'cModalConfirm',
	props: {
		icon: {
			type: String,
			default: 'fal fa-question-circle',
		},
		question: {
			type: String,
			default: '',
		},
		description: {
			type: String,
			default: '',
		},
	},

}
</script>

<style lang="scss">
@import "resources/_assets/scss/variables";

</style>