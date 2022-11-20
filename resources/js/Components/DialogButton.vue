<script>

export default {
	props: {
		link: {
			type: String,
			default: ''
		},
		message: {
			type: String,
			default: ''
		},
	},
	data(){
		return {
			dialog: false
		}
	},
	methods:{
		handleDelete(){
			this.$inertia.delete(this.link)
			this.dialog = false;
		}
	}
}
</script>

<template>
	<v-btn color="color" variant="plain"
		   @click="dialog = true">
		<slot/>
	</v-btn>

	<v-dialog
	v-model="dialog"
	width="400px"
>
	<v-card>
		<v-card-title>
			<span>{{ message }}</span>
		</v-card-title>
		<v-card-actions class="text-right">
			<v-btn
				color="primary"
				variant="text"
				@click="dialog = false"
			>
				Close
			</v-btn>
			<v-btn
				color="primary"
				variant="text"
				@click="handleDelete"
			>
				Delete
			</v-btn>
		</v-card-actions>
	</v-card>
</v-dialog>
</template>
