<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
class HelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function GenerateTokenApi($user=''){

      if(!$user){
        $user=array(
          'email'=>date('h.u').rand(0,100).'@mail.com',
          'id'=>date(1,10000000000000)
        );
      }else {
        $user= $user->toArray();
      }
      $token_id='';
      do {
        $base=base64_encode(($user['email']).date('u'));
        $base2=base64_encode(($user['id']).date('u'));
        $token_id = $base.date('hiyum').rand(0,1000).'-'.rand(1000,10000).'-'.date('f-d').$base2;
      }while(User::where("api_token", "=", $token_id)->first() instanceof User);
      return $token_id;
    }
}
