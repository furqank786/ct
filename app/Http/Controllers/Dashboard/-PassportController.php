<?php
/**
 * Created by PhpStorm.
 * User: Furqan
 * Date: 8/31/2017
 * Time: 12:28 AM
 */

namespace CachetHQ\Cachet\Http\Controllers\Dashboard;


use CachetHQ\Cachet\Models\Setting;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;


use CachetHQ\Cachet\Bus\Commands\System\Config\UpdateConfigCommand;
use CachetHQ\Cachet\Integrations\Contracts\Credits;
use CachetHQ\Cachet\Models\User;
use CachetHQ\Cachet\Notifications\System\SystemTestNotification;
use CachetHQ\Cachet\Settings\Repository;
use Exception;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Log\Writer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class PassportController extends Controller
{
    /**
     * Creates a new settings controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'setup' => [
                'title'  => trans('dashboard.settings.app-setup.app-setup'),
                'url'    => cachet_route('dashboard.settings.setup'),
                'icon'   => 'ion-gear-b',
                'active' => false,
            ],
            'theme' => [
                'title'  => trans('dashboard.settings.theme.theme'),
                'url'    => cachet_route('dashboard.settings.theme'),
                'icon'   => 'ion-paintbrush',
                'active' => false,
            ],
            'stylesheet' => [
                'title'  => trans('dashboard.settings.stylesheet.stylesheet'),
                'url'    => cachet_route('dashboard.settings.stylesheet'),
                'icon'   => 'ion-paintbucket',
                'active' => false,
            ],
            'customization' => [
                'title'  => trans('dashboard.settings.customization.customization'),
                'url'    => cachet_route('dashboard.settings.customization'),
                'icon'   => 'ion-wand',
                'active' => false,
            ],
            'localization' => [
                'title'  => trans('dashboard.settings.localization.localization'),
                'url'    => cachet_route('dashboard.settings.localization'),
                'icon'   => 'ion-earth',
                'active' => false,
            ],
            'security' => [
                'title'  => trans('dashboard.settings.security.security'),
                'url'    => cachet_route('dashboard.settings.security'),
                'icon'   => 'ion-lock-combination',
                'active' => false,
            ],
            'passport' => [
                'title'  => 'Passport',
                'url'    => cachet_route('dashboard.settings.passport'),
                'icon'   => 'ion-ios-albums-outline',
                'active' => false,
            ],
            'menu' => [
                'title'  => 'Menu',
                'url'    => cachet_route('dashboard.settings.menu'),
                'icon'   => 'ion-ios-albums-outline',
                'active' => false,
            ],
            'analytics' => [
                'title'  => trans('dashboard.settings.analytics.analytics'),
                'url'    => cachet_route('dashboard.settings.analytics'),
                'icon'   => 'ion-stats-bars',
                'active' => false,
            ],
            'log' => [
                'title'  => trans('dashboard.settings.log.log'),
                'url'    => cachet_route('dashboard.settings.log'),
                'icon'   => 'ion-document-text',
                'active' => false,
            ],
            'credits' => [
                'title'  => trans('dashboard.settings.credits.credits'),
                'url'    => cachet_route('dashboard.settings.credits'),
                'icon'   => 'ion-ios-list',
                'active' => false,
            ],
            'mail' => [
                'title'  => trans('dashboard.settings.mail.mail'),
                'url'    => cachet_route('dashboard.settings.mail'),
                'icon'   => 'ion-paper-airplane',
                'active' => false,
            ],
            'about' => [
                'title'  => CACHET_VERSION,
                'url'    => 'javascript: void(0);',
                'icon'   => 'ion-flag',
                'active' => false,
            ],
        ];

        View::share([
            'sub_title' => trans('dashboard.settings.settings'),
            'sub_menu'  => $this->subMenu,
        ]);
    }
//    public function showSetupView()
//    {
//        $this->subMenu['setup']['active'] = true;
//
//        Session::flash('redirect_to', $this->subMenu['setup']['url']);
//        $setting = new Setting();
//        $settings = $setting::all();
//        dd($settings);
//        return View::make('dashboard.settings.app-setup')
//            ->withPageTitle(trans('dashboard.settings.app-setup.app-setup').' - '.trans('dashboard.dashboard'))
//            ->withSubMenu($this->subMenu)
//            ->withRawAppAbout(Config::get('setting.app_about'));
//    }

    /**
     * Shows the settings passport view.
     *
     * @return \Illuminate\View\View
     */
    public function showPassportView()
    {
        $this->subMenu['passport']['active'] = true;
        $settings['url'] = Setting::where('name', 'url')->pluck('value')->first();
        $settings['client_id'] = Setting::where('name', 'client_id')->pluck('value')->first();
        $settings['client_secret'] = Setting::where('name', 'client_secret')->pluck('value')->first();

        Session::flash('redirect_to', $this->subMenu['passport']['url']);
        return View::make('dashboard.settings.passport', compact('settings'))
            ->withPageTitle('Passport'.' - '.'dashboard')
            ->withSubMenu($this->subMenu);
    }

    public function listsite()
    {
        $site = new Sites();
        $sites = $site::all();

        return view('dashboard.sites.list', compact('sites'));
    }

}