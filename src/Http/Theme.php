<?php

namespace Codificar\Themes\Http;

use Eloquent;
use Settings;

class Theme extends Eloquent {

	protected $table = 'theme';
	protected $guarded = ['id'];

	public static function getDefaultTheme() {
		$defaultId = Settings::findByKey('default_theme');
		$theme = self::find($defaultId);
		if($theme) {
			return $theme;
		} else {
			return self::first();
		}
	}

	public static function getLogo(){
		$theme = self::getDefaultTheme();

		$logo = '/images/logo.png';
		if ($theme) {
			$logo = '/uploads/' . $theme->logo;
		}
		if ($logo == '/uploads/') {
			$logo = '/image/logo.png';
		}

		return $logo;
	}

	public static function getFavicon(){
		$theme = self::getDefaultTheme();

		$favicon = '/image/favicon.ico';
		if ($theme) {
			$favicon = '/uploads/' . $theme->favicon;
		}

		if ($favicon == '/uploads/') {
			$favicon = '/image/favicon.ico';
		}

		return $favicon;
	}

	public static function getBackground($role){
		$theme = self::getDefaultTheme();
		//dd($role);

		$favicon = '/image/background.png';
		if ($theme) {
			switch($role) {
				case 'user':
					$favicon = '/uploads/' . $theme->background_image_user_signup;
					break;
				case 'provider':
					$favicon = '/uploads/' . $theme->background_image_provider_signup;
					break;
				case 'admin':
					$favicon = '/uploads/' . $theme->background_image_admin_signup;
					break;
				case 'corp':
					$favicon = '/uploads/' . $theme->background_image_corp_signup;
					break;
				default:
					$favicon = '/uploads/' . $theme->background_image_home_signup;
					break;
			}
		}

		if ($favicon == '/uploads/') {
			$favicon = '/image/background.png';
		}

		return $favicon;
	}

	#TODO SET Complete URL
	public static function getLogoUrl(){
		return self::getLogo();
	}

	public static function getFaviconUrl(){
		return self::getFavicon();
	}

	public static function getBackgroundUrl($role = 'home'){
		return self::getBackground($role);
	}
}
?>