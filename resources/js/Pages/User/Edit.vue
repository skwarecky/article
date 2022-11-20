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
								<LinkButton :link="route('user.index')">Back to list</LinkButton>
							</v-col>
						</v-row>
					</v-card-title>
					<v-card-text>
						<v-alert v-if="Object.keys(errors).length > 0" type="error">
							<span v-for="error in errors">
								{{ error }}
							</span>
						</v-alert>
						<form @submit.prevent="submit">

									<v-checkbox v-model="form.is_author" label="Author"></v-checkbox>
									<v-checkbox v-model="form.is_editor" label="Editor"></v-checkbox>

									<v-text-field
										v-model="form.name"
										autocomplete="off"
										dense
										label="Name"
										outlined
										required
										type="text"
									></v-text-field>

									<v-text-field
										v-model="form.email"
										autocomplete="off"
										dense
										label="Email"
										outlined
										required
										type="text"
									></v-text-field>
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
		LinkButton
	},
	props: {
		user: Object,
		errors: Object,
	},
	data() {
		return {
			form: useForm({
				is_author: this.user.is_author,
				is_editor: this.user.is_editor,
				name: this.user.name,
				email: this.user.email,
			})
		}
	},
	methods: {
		submit() {
			this.form
				.transform((data) => ({
					...data,
				}))
				.patch(route('user.update', {'id': this.user.id}));
		}
	},
}
</script>

<style scoped>

</style>
