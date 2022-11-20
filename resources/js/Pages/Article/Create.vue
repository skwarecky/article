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
							<v-row>
								<v-col cols="6">
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
								</v-col>
								<v-col cols="6">
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
											<v-btn @click="remove(index)">
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
		assets: Object
	},
	data() {
		return {
			selectedAsset: null,
			selectedArticleAssets: [],
			columns: [
				{name: '', attribute: 'actions'},
				{name: 'Title', attribute: 'title'},
			],
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
					article_asset: this.selectedArticleAssets
				}))
				.post(route('article.store'));
		},
		convertObject(object) {
			return JSON.parse(JSON.stringify(object));
		},
		remove(i){
			this.selectedArticleAssets.splice(i, 1);
		},
		addSelectedAsset(asset){
			this.selectedArticleAssets.push({id: null, asset: asset});
			console.log(this.selectedArticleAssets);
		},
	},
	watch:{
		selectedAsset: function (selectedAsset){
			if(!selectedAsset) return;

			console.log(selectedAsset);
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
