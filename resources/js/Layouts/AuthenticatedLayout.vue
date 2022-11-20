<script >
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
import DropdownLink from '@/Components/DropdownLink.vue'
import LinkButton from '@/Components/LinkButton.vue';

const showingNavigationDropdown = ref(false);

export default {
	components: {
		ApplicationLogo,
		Link,
		LinkButton,
		DropdownLink
	},
	props:{
		flash: Object,
	},
	data() {
		return {
			toast: false,
			toastMessage: '',
		};
	},
	watch: {
		$page: {
			handler(e) {
				if (e.props && e.props.flash && e.props.flash.message) {
					this.toastMessage = e.props.flash.message;
					this.toast = true;
				}
			},
			deep: true,
			immediate: true,
		},
	},
}


</script>

<template>
    <div>
		<v-app>
			<v-app-bar app>
				<Link :href="route('article.index')" >
					<ApplicationLogo class="block ml-4"/>
				</Link>
				<v-spacer></v-spacer>

				<LinkButton
					:href="route('article.index')"
					class="mr-1"
				>
					ARTICLE
				</LinkButton>

				<LinkButton
					v-if="$page.props.auth.user.is_editor"
					:link="route('asset.index')"
					class="d-flex align-center  mr-1"
				>
					ASSET
				</LinkButton>
				<LinkButton
					:href="route('user.index')"
					class="d-flex align-center text-decoration-none"
				>
					USER
				</LinkButton>

				<v-spacer></v-spacer>
				<DropdownLink :href="route('logout')" as="button" method="post" style="width: 8rem;">
					LOG OUT
				</DropdownLink>
			</v-app-bar>
			<v-main>
				<div class="app-content-container boxed-container pr-6 pl-6 pb-6">
					<v-snackbar
						v-model="toast"
						:timeout="3000"
						:position="'absolute'"
						color="primary"
						content-class="text-center"
					>
						{{ toastMessage }}
					</v-snackbar>
				</div>
				<slot/>
			</v-main>
		</v-app>
    </div>
</template>
