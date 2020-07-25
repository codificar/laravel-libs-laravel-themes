<?php

namespace Codificar\Themes\Http\Controllers;

use App\Http\Requests\SaveThemeFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Theme; //Assume que o Model existe

class ThemeController extends Controller
{
	public function index()
	{
		return view('themes::themes');
	}

	public function list()
	{
		return Theme::all(['id', 'theme_color', 'primary_color', 'secondary_color', 'hover_color', 'active_color']);
	}

	public function save(SaveThemeFormRequest $request)
	{
		if($request->theme) {
			if ($request->theme->id == 1) return ['success' => false];
			$request->theme->fill($request->except(['id', 'theme']));
			$request->theme->save();
		} else {
			Theme::create($request->all());
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
