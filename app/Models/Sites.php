<?php

namespace CachetHQ\Cachet\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Sites extends Eloquent
{
    //use ActorRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "sites";

    protected $fillable = [
        'name', 'url', 'status'
    ];


    /**
     * @param array $data
     * @param bool $provider
     * @return static
     */
    public function addsites(array $data, $provider = false)
    {

        if ($provider) {
            $site = Sites::create([
                'name' => $data['name'],
                'url' => $data['url'],
                'status' => $data['status']
            ]);
        } else {
            $site = Sites::create([
                'name' => $data['name'],
                'url' => $data['url'],
                'status' => $data['status']
            ]);
        }
        /**
         * Return the user object
         */
        return $site;
    }

    public function getSite($url) {
        $site = Sites::where('url', $url)->where('status','active')->first();
        return $site;
    }

    public function getServices($url) {
        $site = Sites::where('url', $url)->where('status','active')->first();
        return $site;
    }

}
