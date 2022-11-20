<template>
	<v-alert v-if="Object.keys(errors).length > 0" type="error" class="mb-1">
		<span v-for="error in errors">
			{{ error }}
		</span>
	</v-alert>
</template>

<script setup>
	defineProps(['errors']);
</script>

<style scoped>

</style>
