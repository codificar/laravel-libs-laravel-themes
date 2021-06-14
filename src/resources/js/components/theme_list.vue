<script>
import color from './color';
import FormThemeModal from './form_theme_modal';
import axios from 'axios';
import { BDropdown, BDropdownItem, BButton } from "bootstrap-vue";
export default {
	data() {
		return {
			themes: [],
			selectedTheme: {},
			showModal: false
		}
	},
	components: {
		color, FormThemeModal, BDropdown, BDropdownItem, BButton
	},
	props: {
		assetUrl: String
	},
	methods: {
		openModal(theme = {}) {
			this.showModal = true;
			this.selectedTheme = theme;
		},
		applyTheme(id) {
			axios.post('theme/apply', {id}).then(response => {
				document.location.reload(true);
			}).catch(err => {
				console.log(err)
			})
		},
		erase(index) {
			console.log(this.themes[index].id);
			axios.delete('theme', {params: {id: this.themes[index].id}}).then(response => {
				if(response.data.success){
					this.themes.splice(index, 1);
				} else {
					console.log('ERROR')
				}
			})
		}
	},
	mounted() {
		//axios.get('themes/list').then(response => {
			this.themes = [{"id":1,"theme_color":"#","primary_color":"#","secondary_color":"#","hover_color":"#","active_color":"#"},{"id":78,"theme_color":"#e11919","primary_color":"#1d1b1b","secondary_color":"#2b2a93","hover_color":"#9eb918","active_color":"#b8652e"},{"id":80,"theme_color":"#d24b4b","primary_color":"#28268c","secondary_color":"#700f0f","hover_color":"#2c3959","active_color":"#cc8585"}];
		//})
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
							<b-dropdown-item v-if="theme.id != 1" @click="openModal(theme)">{{trans('themes.edit')}}</b-dropdown-item>
							<b-dropdown-item v-if="theme.id != 1" @click="erase(index)">{{trans('themes.delete')}}</b-dropdown-item>
						</b-dropdown>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>


<style>

</style>