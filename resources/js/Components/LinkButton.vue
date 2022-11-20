<script>
	import { Link } from '@inertiajs/inertia-vue3';
	export default {
		components:{
			Link,
		},
		props: {
			link: {
				type: String,
				default: '#'
			},
			color: {
				type: String,
				default: ''
			},
		}
	}
</script>

<template>
	<v-btn  :href="link" variant="plain" color="color">
		<slot/>
	</v-btn>
</template>
