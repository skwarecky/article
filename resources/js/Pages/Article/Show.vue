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
						<v-row class="mt-4">
							<v-col cols="4" v-for="(asset, index) in selectedArticleAssets">
								<form :action="route('asset.download', {id: asset?.asset?.id})" method="get" target="_blank">
									<v-btn type="submit">Download</v-btn>
								</form>
								<p class="mt-3">
									{{ asset?.asset?.title }}
								</p>
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
	name: "Index.vue",
	components: {
		AuthenticatedLayout,
		LinkButton,
		Table
	},
	props: {
		article: Object,
		articleAssets: Object
	},
	data() {
		return {
			selectedArticleAssets: this.articleAssets?.data,
		}
	}
}
</script>

<style scoped>

</style>
