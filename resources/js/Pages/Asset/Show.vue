<template>

	<AuthenticatedLayout>
		<v-row align="center"
			   justify="center">
			<v-col cols="6">
				<v-card class="mt-4">
					<v-card-title>
						<v-row>
							<v-col cols="6">
								Asset
							</v-col>
							<v-col class="text-right" cols="6">
								<LinkButton :link="route('asset.index')">Back to list</LinkButton>
							</v-col>
						</v-row>
					</v-card-title>
					<v-card-text>
						<v-row>
							<v-col cols="8">
								<div>Title: {{ asset.title }}</div>
								<div>Name: {{ asset.name }}</div>
							</v-col>
							<v-col cols="4" align="center"
								   justify="center">
								<form :action="route('asset.download', {id: this.asset.id})" method="get" target="_blank">
									<v-btn type="submit">Download</v-btn>
								</form>
							</v-col>
						</v-row>
					</v-card-text>
				</v-card>
			</v-col>
		</v-row>

	</AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LinkButton from '@/Components/LinkButton.vue';
import Table from '@/Components/Table.vue';
import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "Show",
	components: {
		AuthenticatedLayout,
		LinkButton
	},
	props: {
		asset: Object
	},
	data() {
	},
	methods:{
	}
}
</script>

<style scoped>

</style>
