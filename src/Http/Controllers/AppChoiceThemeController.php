<?php

namespace Codificar\Themes\Http\Controllers;

use App\Http\Controllers\Controller;
use Codificar\Themes\Http\Requests\SaveAppPreferenceRequest;
use Codificar\Themes\Http\Requests\SaveThemeOptionsRequest;
use Codificar\Themes\Http\Theme;
use Session;

class AppChoiceThemeController extends Controller
{
    const USER = 'user';
    const PROVIDER = 'provider';

    /**
     * Recupera as configurações para o app theme
     * 
     * @api {GET} /api/themes/get_settings
     * @return json
     */
    public function getSettings()
    {
        $isEnabled = Theme::getIsAppThemeEnabled();
        $menuName = Theme::getAppThemeMenuName();
        $menuFrase = Theme::getAppThemeMenuFrase();

        return response()->json([
            'success' => true,
            'is_enabled' => $isEnabled,
            'menu_name' => $menuName,
            'menu_frase' => $menuFrase
        ]);
    }

    /**
     * Recupera as configurações para o app theme
     * 
     * @api {POST} /api/themes/get_settings
     * @param SaveThemeOptionsRequest $request
     * @return json
     */
    public function saveSettings(SaveThemeOptionsRequest $request)
    {
        $save = Theme::saveThemeOptions($request);
        Session::flash('success', trans('themes::themes.success'));
        
        return response()->json([
            'success' => $save
        ]);
    }

    /**
     * Recupera os temas para os apps
     * 
     * @api {GET} /api/application/themes
     * @return json
     */
    public function getAppThemes()
    {
        $themes = Theme::getAppThemes();

        return response()->json([
            'success' => true,
            'url' => url('uploads/'),
            'themes' => $themes
        ]);
    }

    /**
     * Save app preference
     * 
     * @param SaveAppPreferenceRequest $request
     * @return json
     */
    public function saveAppPreference(SaveAppPreferenceRequest $request)
    {
        $save = $request->type == self::USER ? 
            Theme::saveUserAppTheme($request) :
            Theme::saveProviderAppTheme($request);

        return response()->json([
            'success' => $save
        ]);
    }
}