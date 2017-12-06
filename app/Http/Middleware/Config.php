<?php
/**
 * Created by PhpStorm.
 * User: Furqan
 * Date: 8/23/2017
 * Time: 1:18 AM
 */

namespace CachetHQ\Cachet\Http\Middleware;

use Closure;
use CachetHQ\Cachet\Models\Sites;
use Illuminate\Database\DatabaseManager;
use Illuminate\Contracts\Foundation;
use Illuminate\Foundation\Application;
use CachetHQ\Cachet\Models\Setting;

class Config
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sites = new Sites();
        $site_url = $_SERVER['SERVER_NAME'];
        $site = $sites->getSite($site_url);
        $DB_NAME = \Config::get('database.connections.mysql.database');
        $config = array();
        if(!is_null($site) && !is_null($site_url) && $site_url == $site->url ){
            $db = str_replace('.','_',$site_url);
            $config['id'] = 'site_id1';
            $config['site_url'] = $site_url;
            $config['theme'] = 'site1_theme';
            $config['host'] = 'localhost';
            $config['db_name'] = $db;
            $config['user'] = 'root';
            $config['password'] = '';
            $config['prefix'] = 'gt ';
        }
        else{
            exit('no site found or inactive site!');
        }

        \Config::set('database.connections.mysql.host', $config['host'] );
        \Config::set('database.connections.mysql.database', $config['db_name'] );
        \Config::set('database.connections.mysql.username', $config['user']);
        \Config::set('database.connections.mysql.password', $config['password']);
        \Config::set('database.connections.mysql.prefix', $config['prefix']);

        \Config::set('database.connections.mysql.theme', $config['theme']);
        \DB::reconnect();

        $settings = Setting::all('name','value')->toArray();
        $settingArr = [];
        if($settings){
            foreach($settings as $val) {
                $settingArr[$val['name']] = $val['value'];
            }
        }
        \Config::set('setting.app_name',$settingArr['app_name']);
        \Config::set('setting.app_domain',$settingArr['app_domain']);
        \Config::set('setting.app_about',$settingArr['app_about']);
        \Config::set('setting.header',$settingArr['header']);
        \Config::set('setting.footer',$settingArr['footer']);
        \Config::set('setting.app_incident_days',$settingArr['app_incident_days']);
        \Config::set('setting.show_support',$settingArr['show_support']);
        \Config::set('setting.app_locale',$settingArr['app_locale']);
        \Config::set('setting.app_timezone',$settingArr['app_timezone']);
        \Config::set('setting.enable_subscribers',$settingArr['enable_subscribers']);
        \Config::set('setting.skip_subscriber_verification',$settingArr['skip_subscriber_verification']);
        \Config::set('setting.display_graphs',$settingArr['display_graphs']);
        \Config::set('setting.enable_external_dependencies',$settingArr['enable_external_dependencies']);
        \Config::set('setting.show_timezone',$settingArr['show_timezone']);
        \Config::set('setting.only_disrupted_days',$settingArr['only_disrupted_days']);


        return $next($request);
    }
}