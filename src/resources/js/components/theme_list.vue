<script>
import color from './color';
import axios from 'axios';
import { BDropdown, BDropdownItem, BButton } from "bootstrap-vue";
export default {
	data() {
		return {
			themes: [],
		}
	},
	components: {
		color, BDropdown, BDropdownItem, BButton
	},
	props: {
		assetUrl: String,
		baseUrl: String
	},
	methods: {
		applyTheme(id) {
			axios.post(this.baseUrl+'/apply', {id}).then(response => {
				document.location.reload();
			}).catch(err => {
				console.log(err)
			})
		},
		erase(index) {
			console.log(this.themes[index].id);
			axios.delete(this.baseUrl, {params: {id: this.themes[index].id}}).then(response => {
				if(response.data.success){
					this.themes.splice(index, 1);
				} else {
					console.log('ERROR')
				}
			})
		}
	},
	mounted() {
		axios.get(this.baseUrl + '/list').then(response => {
			this.themes = response.data
		})
	}
}
</script>

<template>
	<div class="card card-outline-info">
		<div class="card-header">
			<h4 class="m-b-0 text-white">{{trans('themes.themes')}}</h4>
		</div>
		<div class="card-block">
			<table class="table">
				<thead>
					<th>{{trans('themes.id')}}</th>
					<th>{{trans('themes.theme_color')}}</th>
					<th>{{trans('themes.primary_color')}}</th>
					<th>{{trans('themes.secondary_color')}}</th>
					<th>{{trans('themes.hover_color')}}</th>
					<th>{{trans('themes.active_color')}}</th>
					<th>{{trans('themes.actions')}}</th>
				</thead>
				<tbody>
					<tr v-for="(theme, index) in themes" :key="theme.id">
						<td>{{theme.id}}</td>
						<td><color :color="theme.theme_color" />{{theme.theme_color}}</td>
						<td><color :color="theme.primary_color" />{{theme.primary_color}}</td>
						<td><color :color="theme.secondary_color" />{{theme.secondary_color}}</td>
						<td><color :color="theme.hover_color" />{{theme.hover_color}}</td>
						<td><color :color="theme.active_color" />{{theme.active_color}}</td>
						<td>
							<b-dropdown id="actions-dropdown" :text="trans('themes.actions')" variant="primary">
								<b-dropdown-item @click="applyTheme(theme.id)">{{trans('themes.apply')}}</b-dropdown-item>
								<b-dropdown-item :href="baseUrl+'/'+theme.id">{{trans('themes.edit')}}</b-dropdown-item>
								<b-dropdown-item :href="baseUrl+'/'+theme.id+'/titles'">{{trans('themes.titles')}}</b-dropdown-item>
								<b-dropdown-item @click="erase(index)">{{trans('themes.delete')}}</b-dropdown-item>
							</b-dropdown>
						</td>
					</tr>
				</tbody>
			</table>
			<b-button variant="success" :href="baseUrl+'/new'">{{trans('themes.new')}}</b-button>
		</div>
	</div>
</template>


<style>

</style>