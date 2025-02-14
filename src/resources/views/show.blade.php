	@extends('layout.master')
	@section('breadcrumbs')
	<div class="row page-titles">
		<div class="col-md-6 col-8 align-self-center">
			<h3 class="text-themecolor m-b-0 m-t-0">{{ trans("setting.conf") }}</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("dashboard.home") }}</a></li>
				<li class="breadcrumb-item active">{{ trans("setting.conf") }}</li>
				<li class="breadcrumb-item active">{{ trans("setting.themes")}}</li>
				<li class="breadcrumb-item active">{{$theme ? $theme->id : trans('setting.new')}}</li>
			</ol>
		</div>
	</div>
	@stop

	@section('content')
	<div id="ThemeVue">
		<form-theme :asset-url="'{{asset_url()}}'" :theme="{{$theme ? $theme : '{}'}}" :base-url="'{{route('themeIndex')}}'"></form-theme>
	</div>

	<script src="/js/lang.trans/detail,settingTableSeeder,setting"> </script>
	<script src="/js/lang/theme"> </script>
	<script src="{{ asset('vendor/codificar/laravel-themes/js/app.vue.js') }}"> </script>
	@stop