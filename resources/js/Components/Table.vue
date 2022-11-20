<script>
	import LinkButton from "@/Components/LinkButton.vue";
	import DialogButton from "@/Components/DialogButton.vue";

	export default {
		components: {
			LinkButton,
			DialogButton
		},
		props: {
			columns: Array,
			rows: Object,
			links: Object
		}
	}
</script>
<template>
	<div>
		<v-table>
			<thead>
				<tr>
					<td v-for="column in columns" :key="column.name">{{ column.name }}</td>
				</tr>
			</thead>
			<tbody v-if="rows.data">
				<tr
					v-for="row in rows.data"
					:key="row.id"
				>
					<td width="50px" v-for="column in columns">
						<slot v-if="column.attribute === 'actions'">
							<LinkButton v-if="row.actions.show_link" :link="row.actions.show_link">
								Show
							</LinkButton>
							<LinkButton v-if="row.actions.edit_link" :link="row.actions.edit_link">
								Edit
							</LinkButton>
							<DialogButton
								:message="'Do you wanna delete ?'"
								v-if="row.actions.delete_link"
								:link="row.actions.delete_link"
							>
								Delete
							</DialogButton>
						</slot>
						<slot v-else >
							{{ row[column.attribute] }}
						</slot>
					</td>
				</tr>
			</tbody>
		</v-table>
		<v-row v-if="rows.links">
			<v-col cols="6" class="text-left">
				<LinkButton v-if="rows.links.prev" :link="rows.links.prev">
					Prev
				</LinkButton>
			</v-col>
			<v-col cols="6" class="text-right">
				<LinkButton v-if="rows.links.next" :link="rows.links.next">
					Next
				</LinkButton>
			</v-col>
		</v-row>
	</div>
</template>
