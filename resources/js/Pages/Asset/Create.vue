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
								<LinkButton :link="route('asset.index')">Back to list</LinkButton>
							</v-col>
						</v-row>
					</v-card-title>
					<v-card-text>
						<HandleRequestErrors :errors="errors"/>
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

							<v-file-input
								label="File input"
								density="compact"
								@change="onChange($event)"
							></v-file-input>

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
import HandleRequestErrors from '@/Components/HandleRequestErrors.vue';
import Table from '@/Components/Table.vue';
import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "Index.vue",
	components: {
		AuthenticatedLayout,
		LinkButton,
		Table,
		HandleRequestErrors
	},
	props: {
		articles: Object,
		errors: Object,
	},
	data() {
		return {
			form: useForm({
				title: null,
				file: null,
			})
		}
	},
	methods:{
		onChange(e) {
			this.form.file = e.target.files[0];
		},
		submit(){
			this.form.post(route('asset.store'));
		}
	}
}
</script>

<style scoped>

</style>
