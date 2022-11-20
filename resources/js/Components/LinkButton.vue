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
	<Link :href="link" class="btn btn-primary text-decoration-none" color="black">
		<v-btn   variant="plain" color="color">
			<slot/>
		</v-btn>
	</Link>
</template>
