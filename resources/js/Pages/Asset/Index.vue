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
								<LinkButton :link="route('asset.create')">Create asset</LinkButton>

							</v-col>

						</v-row>

					</v-card-title>

					<v-card-text>
						<Table :columns="columns" :rows="assets"></Table>
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

export default {
	name: "Index",
	components: {
		AuthenticatedLayout,
		LinkButton,
		Table
	},
	props: {
		assets: Object
	},
	data() {
		return {
			columns: [
				{name: '', attribute: 'actions'},
				{name: 'Title', attribute: 'title'},
				{name: 'Name', attribute: 'name'},
				{name: 'Extension', attribute: 'extension'},
				{name: 'Created at', attribute: 'created_at'},
			]
		}
	}
}
</script>

<style scoped>

</style>
