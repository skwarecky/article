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
						<HandleRequestErrors :errors="errors"/>
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

							<v-text-field
								v-model="form.password"
								autocomplete="off"
								dense
								label="Password"
								outlined
								required
								type="password"
							></v-text-field>

							<v-text-field
								v-model="form.password_confirmation"
								autocomplete="off"
								dense
								label="Password confirmation"
								outlined
								required
								type="password"
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
import HandleRequestErrors from '@/Components/HandleRequestErrors.vue';

import {useForm} from "@inertiajs/inertia-vue3";

export default {
	name: "Index.vue",
	components: {
		AuthenticatedLayout,
		LinkButton,
		HandleRequestErrors
	},
	props: {
		user: Object,
		errors: Object,
	},
	data() {
		return {
			form: useForm({
				is_author: false,
				is_editor: false,
				name: '',
				email: '',
				password_confirmation: null,
				password: null,
			})
		}
	},
	methods: {
		submit() {
			this.form.post(route('user.store'));
		}
	},
}
</script>

<style scoped>

</style>
