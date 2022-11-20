<template>

	<AuthenticatedLayout>
		<v-row align="center"
			   justify="center">
			<v-col cols="6">
				<v-card class="mt-4">
					<v-card-title>
						<v-row>
							<v-col cols="6">
								User
							</v-col>
							<v-col class="text-right" cols="6">
								<LinkButton :link="route('user.create')">Create user</LinkButton>

							</v-col>

						</v-row>

					</v-card-title>

					<v-card-text>
						<Table :columns="columns" :rows="users"></Table>

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
	name: "Index.vue",
	components: {
		AuthenticatedLayout,
		LinkButton,
		Table
	},
	props: {
		users: Object
	},
	data() {
		return {
			columns: [
				{name: '', attribute: 'actions'},
				{name: 'Author', attribute: 'is_author'},
				{name: 'Editor', attribute: 'is_editor'},
				{name: 'Name', attribute: 'name'},
				{name: 'Email', attribute: 'email'},
				{name: 'Created at', attribute: 'created_at'},
			]
		}
	}
}
</script>

<style scoped>

</style>
