<?php
/**
 * Created by PhpStorm.
 * User: Furqan
 * Date: 8/31/2017
 * Time: 12:28 AM
 */

namespace DynabicCachet\Passport\Controllers;


use Illuminate\Routing\Controller;
//use Socialite;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        //dd('test');
       //return $user = Socialite::driver('google')->user();
        $userData = array();
        $user =  Socialite::driver('google')->stateless()->user();
        //$userData['token'] = $user->token;
        $loginData['username'] = 'furqan';// $user->getName();
        $loginData['password'] = '111111';
        //$userData['avatar'] = "<img src='".$user->getAvatar()."'>";

        if ($loginData) {
            Auth::once($loginData);



            Auth::attempt($loginData, 'no');

           // event(new UserLoggedInEvent(Auth::user()));
            //dd($loginData);
            return Redirect::intended(cachet_route('dashboard'));
        }

        //dd($user);
        //$user->token;



    }
}
