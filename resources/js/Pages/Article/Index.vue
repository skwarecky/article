<template>

	<AuthenticatedLayout>
		<v-row align="center"
			   justify="center">
			<v-col cols="6">
				<v-card class="mt-4">
					<v-card-title>
						<v-row>
							<v-col cols="6">
								Article
							</v-col>
							<v-col class="text-right" cols="6">
								<LinkButton v-if="$page.props.auth.user.is_author" :link="route('article.create')">Create article</LinkButton>
							</v-col>
						</v-row>
					</v-card-title>

					<v-card-text>
						<Table :columns="columns" :rows="articles"></Table>

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
		articles: Object
	},
	data() {
		return {
			columns: [
				{name: '', attribute: 'actions'},
				{name: 'Title', attribute: 'title'},
				{name: 'Content', attribute: 'content'},
				{name: 'Created at', attribute: 'created_at'},
			]
		}
	}
}
</script>

<style scoped>

</style>
