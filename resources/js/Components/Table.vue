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
			rows: Array,
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
			<tbody>
				<tr
					v-for="row in rows"
					:key="row.name"
				>
					<td width="50px">
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
					</td>
					<td>{{ row.title }}</td>
					<td>{{ row.content }}</td>
					<td>{{ row.created_at }}</td>
				</tr>
			</tbody>
		</v-table>
		<v-row v-if="links">
			<v-col cols="6" class="text-left">
				<LinkButton v-if="links.prev" :link="links.prev">
					Prev
				</LinkButton>
			</v-col>
			<v-col cols="6" class="text-right">
				<LinkButton v-if="links.next" :link="links.next">
					Next
				</LinkButton>
			</v-col>
		</v-row>
	</div>
</template>
