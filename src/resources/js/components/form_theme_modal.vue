<template>
	<b-modal ref="modal" @hidden="$emit('hidden')" @ok="saveTheme()">
		<form>
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

			<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.logo')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.logo')}}"><span class="mdi mdi-comment-question-outline"></span></a> <span class="required-field">*</span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('logo')" ref="logo" id="logo" :data-default-file="assetUrl + '/uploads/' + theme.logo">

					<!--<img src="<?php echo asset_url(); ?>/uploads/<?= $theme->logo; ?>">-->
				</div>
			</div>

			<!--/span-->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.icon')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.icon')}}"><span class="mdi mdi-comment-question-outline"></span></a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('icon')" ref="icon" id="icon" :data-default-file="assetUrl + '/uploads/' + theme.favicon">

					<!--<?php if ($theme->favicon != "") { ?>
					<img src="<?php echo asset_url(); ?>/uploads/<?= $theme->favicon; ?>" height="40" width="40">
					<br>
					<?php } ?>-->
				</div>
			</div>
			<!-- Imagem Home -->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.back_image_signup_application_home')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.back_image_signup_application_home')}}">
							<span class="mdi mdi-comment-question-outline"></span>
						</a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('bckSignupHome')" ref="bckSignupHome" id="bckSignupHome" :data-default-file="assetUrl + '/uploads/' + theme.background_image_home_signup">
				</div>
			</div>
			<!-- Imagem Admin -->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.back_image_signup_application_admin')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.back_image_signup_application_admin')}}">
							<span class="mdi mdi-comment-question-outline"></span>
						</a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('bckSignupAdmin')" ref="bckSignupAdmin" id="bckSignupAdmin" :data-default-file="assetUrl + '/uploads/' + theme.background_image_admin_signup">
				</div>
			</div>
			<!-- Imagem Corp -->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.back_image_signup_application_corp')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.back_image_signup_application_corp')}}">
							<span class="mdi mdi-comment-question-outline"></span>
						</a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('bckSignupCorp')" ref="bckSignupCorp" id="bckSignupCorp" :data-default-file="assetUrl + '/uploads/' + theme.background_image_corp_signup">
				</div>
			</div>
			<!-- Imagem Motorista -->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.back_image_signup_application_provider')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.back_image_signup_application_provider')}}">
							<span class="mdi mdi-comment-question-outline"></span>
						</a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('bckSignupProvider')" ref="bckSignupProvider" id="bckSignupProvider" :data-default-file="assetUrl + '/uploads/' + theme.background_image_provider_signup">
				</div>
			</div>
			<!-- Imagem Usuário -->
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.back_image_signup_application_user')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.back_image_signup_application_user')}}">
							<span class="mdi mdi-comment-question-outline"></span>
						</a> <span class="required-field"></span>
					</label>
					<input type="file" class="form-control dropify" @change="onUploadFiles('bckSignupUser')" ref="bckSignupUser" id="bckSignupUser" :data-default-file="assetUrl + '/uploads/' + theme.background_image_user_signup">
				</div>
			</div>
		</div>

		</form>
	</b-modal>
</template>

<script>
import { BModal, BFormInput } from "bootstrap-vue";
import axios from 'axios';
export default {
	data() {
		return { }
	},
	components: {
		BModal, BFormInput
	},
	watch: {
		show: function (newValue, oldValue) {
			if(newValue) {
				this.$refs.modal.show();
			}
		}
	},
	props: ['theme', 'show'],
	methods: {
		onUploadFiles(ref) {
			this.theme[ref] = this.$refs[ref].file[0];
		},
		saveTheme() {
			let formData = new FormData();

			for(index in theme) {
				formData.append(index, theme[index]);
			}

			axios.post('theme/savea', formData, {
				headers: {
					'Content-Type': 'multipart/form-data'
				}
			} ).then(response => {
				if(! this.selectedTheme.id) {
					document.location.reload(true);
				}
			}).catch(err => {
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