<?php

/**
 * Created by PhpStorm.
 * User: Brito
 * Date: 09/12/2016
 * Time: 18:23
 */
use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 'appid1',
                'secret' => 'secret',
                'name' => 'App CodeProject'
            ]
        ]);
    }
}