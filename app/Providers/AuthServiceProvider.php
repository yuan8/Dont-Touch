<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        


        Gate::define('route_access', function ($user,$bidang_urusan) {

                if((session('focus_tahun')!=null)){
                    session(['focus_tahun',2020]);
                }

                if((session('route_access')!=null)&&(session('route_access')!=[])){
                     if(in_array($bidang_urusan,session('route_access'))){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                $data=$user->HaveUrusan->pluck('id')->toArray();
                session(['route_access' => ($user->HaveUrusan->pluck('id')->toArray())]);

                    if(in_array($bidang_urusan,$data)){
                        return true;
                    }else{
                        return false;
                    }
                }
                

                
        });

        //
    }
}
