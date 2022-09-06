<?php

namespace Codificar\Themes\Http\Controllers;

use Codificar\Themes\Http\Requests\SaveThemeFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Codificar\Themes\Http\Theme;

use Input;

class ThemeController extends Controller
{
	public function index()
	{
		return view('themes::themes', ['theme' => Theme::first()]);
	}

	public function list()
	{
		return Theme::all();
	}

	public function show(Request $request, $theme_id)
	{
		if($theme_id == 'new') {
			return view('themes::show', ['theme' => null]);
		}
		$theme = Theme::findOrFail($theme_id);
		return view('themes::show', ['theme' => $theme]);
	}

	private function saveImage($inputName)
	{
		// Upload File
		$file_name = time();
		$file_name .= rand();
		$ext = Input::file($inputName)->getClientOriginalExtension();

		Input::file($inputName)->move(public_path() . "/uploads", $file_name . "." . $ext);
		$local_url = $file_name . "." . $ext;

		$s3Link = upload_to_s3($file_name, $local_url);
		return $local_url;
	}

	private function unsetOldImage($file)
	{
		if ($file) {
			$image = asset_url() . '/uploads/' . $file;
			unlink_image($image);
		}
	}

	public function saveImages($theme)
	{

		$listImages = [
			['app_image_icon', 'app_image_icon'],
			['logo', 'logo'],
			['icon', 'favicon'],
			['bckSignupHome', 'background_image_home_signup'],
			['bckSignupAdmin', 'background_image_admin_signup'],
			['bckSignupCorp', 'background_image_corp_signup'],
			['bckSignupProvider', 'background_image_provider_signup'],
			['bckSignupUser', 'background_image_user_signup'],
		];

		foreach ($listImages as $image) {
			if (Input::hasFile($image[0])) {
				$newUrl = null;
				$newUrl = $this->saveImage($image[0]);
				if ($newUrl) {
					$this->unsetOldImage($theme->{$image[1]});
				}
				$theme->{$image[1]} = $newUrl;
			}
		}
		// Salva as mídias anexadas
		$theme->save();
	}

	public function save(SaveThemeFormRequest $request)
	{
		if($request->theme) {

			$request->theme->fill($request->only($request->getColors()));
			//$request->theme->save();
			$this->saveImages($request->theme);
			
		} else {
			$theme = Theme::create($request->only($request->getColors()));
			$this->saveImages($theme);
		}
	}

	public function apply()
	{
		$id = request()->input('id');
		$theme = Theme::find($id);
		if($theme) {
			\Settings::where('key', 'default_theme')->update(['value' => $id]);
		}
	}

	public function delete()
	{
		$id = request()->input('id');
		if($id == 1) return ['success' => false];
		$theme = Theme::find($id);
		if($theme){
			try {
				$theme->delete();
				return ['success' => true];
			} catch (\Throwable $th) {
				//throw $th;
			}
		}
		return ['success' => false];
	}

}
