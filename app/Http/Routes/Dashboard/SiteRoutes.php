<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Http\Routes\Dashboard;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the dashboard user routes class.
 *
 * @author James Brooks <james@alt-three.com>
 * @author Connor S. Parks <connor@connorvg.tv>
 */
class SiteRoutes
{
    /**
     * Defines if these routes are for the browser.
     *
     * @var bool
     */
    public static $browser = true;

    /**
     * Define the dashboard user routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['auth'],
            'namespace'  => 'Dashboard',
            'prefix'     => 'dashboard/sites',
        ], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'get:dashboard.sites',
                'uses' => 'SiteController@listsite',
            ]);

            $router->get('add', [
                'as' => 'get:dashboard.sites.add',
                'uses' => 'SiteController@addsite',
            ]);

            $router->post('add', [
                'as' => 'post:dashboard.sites.add',
                'uses' => 'SiteController@savesite',
            ]);

            $router->get('update/id/{id}/status/{status}', [
                'as' => 'get:dashboard.sites.update',
                'uses' => 'SiteController@updatesite',
            ]);

//            // Route for add new site script to store in database.
//            Route::post('add', [
//                'as' => 'add',
//                'uses' => 'DynabicCachet\Multitenancy\Controllers\SiteController@savesite',
//            ]);






//            $router->post('/', [
//                'as'   => 'post:dashboard.user',
//                'uses' => 'UserController@postUser',
//            ]);
//
//            $router->get('{user}/api/regen', [
//                'as'   => 'get:dashboard.user.api.regen',
//                'uses' => 'UserController@regenerateApiKey',
//            ]);
        });
    }
}
