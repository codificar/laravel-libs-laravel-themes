@extends('layout.master')
@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">
		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans("setting.conf") }}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("dashboard.home") }}</a></li>
			<li class="breadcrumb-item active">{{ trans("setting.conf") }}</li>
			<li class="breadcrumb-item active">{{ trans("setting.themes")}}</li>
		</ol>
	</div>
</div>
@stop

@section('content')
<div id="ThemeVue">
	<theme-list></theme-list>

	<form action="{{route('themeImageSave')}}" id="saveImageForm" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="usr">
						{{trans('setting.logo')}}
						<a href="#" class="question-field" data-toggle="tooltip" title="{{trans('settingTableSeeder.logo')}}"><span class="mdi mdi-comment-question-outline"></span></a> <span class="required-field">*</span>
					</label>
					<input type="file" class="form-control dropify" name="logo" id="logo" data-default-file="<?php echo asset_url(); ?>/uploads/<?= $theme->logo; ?>">

					<!--Logo-->
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
					<input type="file" class="form-control dropify" name="icon" id="icon" data-default-file="<?php echo asset_url(); ?>/uploads/<?= $theme->favicon; ?>">

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
					<input type="file" class="form-control dropify" name="bckSignupHome" id="bckSignupHome" data-default-file="{{asset_url().'/uploads/'.$theme->background_image_home_signup}}">
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
					<input type="file" class="form-control dropify" name="bckSignupAdmin" id="bckSignupAdmin" data-default-file="{{asset_url().'/uploads/'.$theme->background_image_admin_signup}}">
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
					<input type="file" class="form-control dropify" name="bckSignupCorp" id="bckSignupCorp" data-default-file="{{asset_url().'/uploads/'.$theme->background_image_corp_signup}}">
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
					<input type="file" class="form-control dropify" name="bckSignupProvider" id="bckSignupProvider" data-default-file="{{asset_url().'/uploads/'.$theme->background_image_provider_signup}}">
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
					<input type="file" class="form-control dropify" name="bckSignupUser" id="bckSignupUser" data-default-file="{{asset_url().'/uploads/'.$theme->background_image_user_signup}}">
				</div>
			</div>
		</div>
		<button class="btn btn-success" form="saveImageForm" >Salvar</button>
	</form>

</div>

<script src="/js/lang/theme"> </script>
<!-- <script src="/js/lang.trans/detail"> </script> -->
<script src="{{asset(mix('js/app.js', 'vendor/laravel-themes'))}}"> </script>
@stop