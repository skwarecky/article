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
						<form @submit.prevent="submit">

							<v-text-field
								v-model="form.title"
								label="Title"
								required
								outlined
								dense
								type="text"
								autocomplete="off"
							></v-text-field>

							<v-textarea
								v-model="form.content"
								label="Content"
								outlined
								dense
								autocomplete="false"
							></v-textarea>

							<div class="text-right">
								<v-btn type="submit">Save</v-btn>
							</div>
						</form>
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
		articles: Object
	},
	data() {
		return {
			form: useForm({
				title: null,
				content: null,
			})
		}
	},
	methods:{
		submit(){
			this.form
				.transform((data) => ({
					...data,
				}))
				.post(route('article.store'));
		}
	}
}
</script>

<style scoped>

</style>
