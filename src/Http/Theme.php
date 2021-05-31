<?php

namespace Codificar\Themes\Http;

use Eloquent;

class Theme extends Eloquent {

	protected $table = 'theme';
	protected $guarded = ['id'];

	public static function getLogo(){
		$theme = Theme::first();

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
		$theme = Theme::first();

		$favicon = '/image/favicon.ico';
		if ($theme) {
			$favicon = '/uploads/' . $theme->favicon;
		}

		if ($favicon == '/uploads/') {
			$favicon = '/image/favicon.ico';
		}

		return $favicon;
	}

	public static function getBackground(){
		$theme = Theme::first();

		$favicon = '/image/background.png';
		if ($theme) {
			$favicon = '/uploads/' . $theme->background_image_provider_signup;
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

	public static function getBackgroundUrl(){
		return self::getBackground();
	}
}
?>