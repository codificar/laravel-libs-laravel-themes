<?php

namespace Codificar\Themes\Http;

use Eloquent;
use Settings;
use User;
use Provider;

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

			if(!file_exists(public_path($logo))){
				$logo = '/images/logo.png';
			}
		}

		return $logo;
	}

	public static function getFavicon(){
		$theme = self::getDefaultTheme();

		$favicon = '/image/favicon.png';
		if ($theme) {
			$favicon = '/uploads/' . $theme->favicon;

			if(!file_exists(public_path($favicon))){
				$logo = '/images/favicon.png';
			}
		}

		return $favicon;
	}

	public static function getBackground($role){
		$theme = self::getDefaultTheme();
		
		$background = '/image/background.png';
		if ($theme) {
			switch($role) {
				case 'user':
					$background = '/uploads/' . $theme->background_image_user_signup;
					break;
				case 'provider':
					$background = '/uploads/' . $theme->background_image_provider_signup;
					break;
				case 'admin':
					$background = '/uploads/' . $theme->background_image_admin_signup;
					break;
				case 'corp':
					$background = '/uploads/' . $theme->background_image_corp_signup;
					break;
				default:
					$background = '/uploads/' . $theme->background_image_home_signup;
					break;
			}
		}

		if ($background == '/uploads/') {
			$background = '/image/background.png';
		}

		if (!file_exists(public_path($background))){
			$background = '/images/background.png';
		}

		return $background;
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

	/**
	 * Get is_app_theme_enabled setting
	 * 
	 * @return boolean
	 */
	public static function getIsAppThemeEnabled()
	{
		$setting = Settings::where('key', 'is_app_theme_enabled')->first();

		if ($setting)
			return $setting->value;

		return 0;
	}

	/**
	 * Get app_theme_menu_name setting
	 * 
	 * @return string
	 */
	public static function getAppThemeMenuName()
	{
		$setting = Settings::where('key', 'app_theme_menu_name')->first();

		if ($setting)
			return $setting->value;

		return '';
	}

	/**
	 * Get app_theme_menu_frase setting
	 * 
	 * @return string
	 */
	public static function getAppThemeMenuFrase()
	{
		$setting = Settings::where('key', 'app_theme_menu_frase')->first();

		if ($setting)
			return $setting->value;

		return '';
	}

	/**
	 * Save app theme in app options
	 * 
	 * @param object $request
	 * @return boolean
	 */
	public static function saveThemeOptions($request)
	{
		try {
			Settings::updateOrCreate(
				['key' => 'is_app_theme_enabled'],
				['key' => 'is_app_theme_enabled', 'value' => $request->is_enabled]
			);

			Settings::updateOrCreate(
				['key' => 'app_theme_menu_name'],
				['key' => 'app_theme_menu_name', 'value' => $request->menu_name]
			);

			Settings::updateOrCreate(
				['key' => 'app_theme_menu_frase'],
				['key' => 'app_theme_menu_frase', 'value' => $request->menu_frase]
			);

			return true;
		} catch (\Throwable $th) {
			\Log::error($th->getMessage());
			return false;
		}
	}

	/**
	 * Get app themes
	 * 
	 * @return Themes
	 */
	public static function getAppThemes()
	{
		try {
			$appThemes = self::where('is_visible_in_app', 1)
				->select('id as theme_id', 'app_image_icon')
				->get();

			return $appThemes;
		} catch (\Throwable $th) {
			\Log::error($th->getMessage());
			return [];
		}
	}

	/**
	 * Save user theme preference
	 * 
	 * @param object $request
	 * @return boolean
	 */
	public static function saveUserAppTheme($request)
	{
		try {
			$user = User::find($request->user_id);

			if ($user) {
				$user->theme_id = $request->theme_id;
				$user->save();
			}

			return true;
		} catch (\Throwable $th) {
			\Log::error($th->getMessage());
			return false;
		}

	}

	/**
	 * Save provider theme preference
	 * 
	 * @param object $request
	 * @return boolean
	 */
	public static function saveProviderAppTheme($request)
	{
		try {
			$provider = Provider::find($request->provider_id);

			if ($provider) {
				$provider->theme_id = $request->theme_id;
				$provider->save();
			}

			return true;
		} catch (\Throwable $th) {
			\Log::error($th->getMessage());
			return false;
		}

	}

	/**
	 * Get selected theme
	 * 
	 * @param object $request
	 * @return boolean
	 */
	public static function getSelectedTheme($token)
	{
		$client = User::whereToken($token)->first();

		if (!$client)
			$client = Provider::whereToken($token)->first();

		if ($client)
			return $client->theme_id;

		return null;
	}
}
?>