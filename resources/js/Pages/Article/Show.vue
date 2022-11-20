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
								<LinkButton :link="route('article.index')">Back to list</LinkButton>
							</v-col>
						</v-row>
					</v-card-title>
					<v-card-text>
						<div>{{ article.title }}</div>
						<p> {{ article.content }}</p>
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
	name: "Index.vue",
	components: {
		AuthenticatedLayout,
		LinkButton,
		Table
	},
	props: {
		article: Object
	},
	methods:{
	}
}
</script>

<style scoped>

</style>
