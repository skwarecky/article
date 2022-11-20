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
						<HandleRequestErrors :errors="errors"/>
						<form @submit.prevent="submit">

							<v-row>
								<v-col cols="6">
									<v-text-field
										v-model="form.title"
										autocomplete="off"
										dense
										label="Title"
										outlined
										required
										type="text"
									></v-text-field>

									<v-textarea
										v-model="form.content"
										autocomplete="false"
										dense
										label="Content"
										outlined
									></v-textarea>
								</v-col>
								<v-col>
									<v-select
										v-model="selectedAsset"
										:items="assets.data"
										item-value="id"
										item-text="title"
										dense
										label="Assets"
										outlined
									/>
									<v-divider></v-divider>

									<v-row v-for="(articleAsset, index) in selectedArticleAssets">
										<v-col cols="2">
											<v-btn @click="remove(index)" class="mt-1 ml-1">
												DELETE
											</v-btn>
										</v-col>
										<v-col cols="10">
											<p>
												{{ articleAsset?.asset?.title }}
											</p>
										</v-col>
									</v-row>

								</v-col>
							</v-row>

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
		article: Object,
		assets: Object,
		articleAssets: Object,
		errors: Object,
	},
	data() {
		return {
			selectedAsset: null,
			selectedArticleAssets: this.articleAssets?.data,
			form: useForm({
				title: this.article.title,
				content: this.article.content,
			})
		}
	},
	methods: {
		submit() {
			this.form
				.transform((data) => ({
					...data,
					article_asset: this.selectedArticleAssets
				}))
				.patch(route('article.update', {'id': this.article.id}));
		},
		convertObject(object) {
			return JSON.parse(JSON.stringify(object));
		},
		remove(i){
			this.selectedArticleAssets.splice(i, 1);
		},
		addSelectedAsset(asset){
			this.selectedArticleAssets.push({id: null, asset: asset});
		},
	},
	watch:{
		selectedAsset: function (selectedAsset){
			if(!selectedAsset) return;

			let searchedAsset;
			for(const asset of this.assets.data){
				if(asset.id == selectedAsset){
					searchedAsset = asset;
				}
			}

			const assetToAdd = this.convertObject(searchedAsset);
			this.addSelectedAsset(assetToAdd);
			this.selectedAsset = null;
		}
	}
}
</script>

<style scoped>

</style>
