<template>
	<form>
		<input type="hidden" :value="theme.id">
		<label for="">{{trans('themes.theme_color')}}</label>
		<b-form-input type="color" v-model="theme.theme_color"></b-form-input>
		<label for="">{{trans('themes.primary_color')}}</label>
		<b-form-input type="color" v-model="theme.primary_color"></b-form-input>
		<label for="">{{trans('themes.secondary_color')}}</label>
		<b-form-input type="color" v-model="theme.secondary_color"></b-form-input>
		<label for="">{{trans('themes.hover_color')}}</label>
		<b-form-input type="color" v-model="theme.hover_color"></b-form-input>
		<label for="">{{trans('themes.active_color')}}</label>
		<b-form-input type="color" v-model="theme.active_color"></b-form-input>

		<image-preview :imageUrl="getUrl(theme.logo)" :label="trans('setting.logo')" fieldName="logo" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.favicon)" :label="trans('setting.icon')" fieldName="icon" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_home_signup)" :label="trans('setting.back_image_signup_application_home')" fieldName="bckSignupHome" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_admin_signup)" :label="trans('setting.back_image_signup_application_admin')" fieldName="bckSignupAdmin" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_corp_signup)" :label="trans('setting.back_image_signup_application_corp')" fieldName="bckSignupCorp" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_provider_signup)" :label="trans('setting.back_image_signup_application_provider')" fieldName="bckSignupProvider" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_user_signup)" :label="trans('setting.back_image_signup_application_user')" fieldName="bckSignupUser" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<image-preview :imageUrl="getUrl(theme.background_image_icon_app)" :label="trans('setting.back_image_icon_app')" fieldName="bckIconApp" :trans="{choose: 'Escolha uma imagem'}" @update="onUploadFiles"/>
		<button type="button" @click="saveTheme()" :disabled="saving" class="btn btn-primary">{{trans('themes.save')}}</button>
	</form>
</template>

<script>
import { BFormInput } from "bootstrap-vue";
import axios from 'axios';
import ImagePreview from "./image_preview.vue";
export default {
	data() {
		return {
			tranlations: {
				choose: this.trans('theme.choose')
			},
			saving: false
		}
	},
	components: {
		BFormInput, ImagePreview
	},
	props: ['theme', 'baseUrl'],
	methods: {
		onUploadFiles(payload) {
			this.theme[payload.fieldName] = payload.image;
		},
		getUrl(image) {
			if(image && image != '') {
				return '/uploads/' + image
			}
			return null;
		},
		saveTheme() {
			this.saving = true;
			let formData = new FormData();

			for(let index in this.theme) {
				formData.append(index, this.theme[index]);
			}

			axios.post(this.baseUrl+'/save', formData, {
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			} ).then(response => {
				document.location.href = '.';
			}).catch(err => {
				this.saving = false;
				console.log(err)
			})
		}
	}
}
</script>

<style lang="scss">
	// @import 'css/custom.scss';
	// @import 'node_modules/bootstrap/scss/bootstrap';
	// @import 'node_modules/bootstrap-vue/src/index.scss';
	.modal-backdrop {
		opacity: 0.5;
	}
</style>