<?php

namespace Codificar\Themes\Http\Controllers;

use App\Http\Controllers\Controller;
use Codificar\Themes\Http\Requests\SaveAppPreferenceRequest;
use Codificar\Themes\Http\Requests\SaveThemeOptionsRequest;
use Codificar\Themes\Http\Theme;
use Session;
use Illuminate\Http\Request;
use Settings;
use Log;
use Provider;
use User;

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
    public function getAppThemes(Request $request)
    {
        $themes = Theme::getAppThemes();
        $isEnabled = Theme::getIsAppThemeEnabled();
        $menuName = Theme::getAppThemeMenuName();
        $menuFrase = Theme::getAppThemeMenuFrase();
        $selected = Theme::getSelectedTheme($request->token);

        return response()->json([
            'success' => true,
            'url' => url('uploads'),
            'is_enabled' => $isEnabled,
            'menu_name' => $menuName,
            'menu_frase' => $menuFrase,
            'themes' => $themes,
            'selected_theme' => $selected
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

        if ($request->type == self::PROVIDER && $save && $request->is_register) {
            $typeClient = Provider::find($request->provider_id);

            if ($typeClient)
                $this->sendWelcomeEmail($typeClient, self::PROVIDER);
        } else if ($request->type == self::USER && $save && $request->is_register) {
            $typeClient = User::find($request->user_id);

            if ($typeClient)
                $this->sendWelcomeEmail($typeClient, self::USER);
        }

        return response()->json([
            'success' => $save
        ]);
    }

    /**
	 *
	 * sentWelcomeEmail
	 *
	 * @param object $typeClient
	 * @return void
	 */
	private function sendWelcomeEmail($typeClient, $type) 
	{
        try {
            if ($type == self::PROVIDER) {
                // Obtém o e-mail do admin
                $admin_email = Settings::getAdminEmail();

                // Monta a mensagem
                $pattern = array('admin_email' => $admin_email, 'name' => ucwords($typeClient->first_name . " " . $typeClient->last_name), 'web_url' => web_url());

                // Monta o assunto
                $subject = trans('providerController.welcome_to') . ucwords(Settings::findByKey('website_title')) . ", " . ucwords($typeClient->first_name . " " . $typeClient->last_name) . '';

                // Envia a notificação por e-mail
                email_notification($typeClient->id, $type, $pattern, $subject, $type . '_new_register', null);
            } else if ($type == self::USER) {
                $is_user_approval_enabled = Settings::getIsUserApprovalEnabled();

                // Configurações de e-mail
                $admin_email_address = Settings::getAdminEmail();
                $pattern = array('admin_email' => $admin_email_address, 'name' => ucwords($typeClient->first_name . " " . $typeClient->last_name), 'web_url' => web_url());

                // Verifica se a configuração de aprovação está ativa 
                if($is_user_approval_enabled)
                {
                    // Pega o assunto da mensagem
                    $subject = trans('user.in_analysis') . " " . ucwords(Settings::findByKey('website_title')) . ", " . ucwords($typeClient->first_name . " " . $typeClient->last_name) . "";
                    
                    // Envia e-mail de notificação de usuário em análise
                    email_notification($typeClient->id, $type, $pattern, $subject, 'user_in_analysis', null);
                }
                else {
                    // Pega o assunto da mensagem
                    $subject = trans('userRegisterController.welcome_to') . " " . ucwords(Settings::findByKey('website_title')) . ", " . ucwords($typeClient->first_name . " " . $typeClient->last_name) . "";
                    
                    // Envia e-mail de notificação de novo usuário
                    email_notification($typeClient->id, $type, $pattern, $subject, 'user_new_register', null);
                }
            }
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
	}
}