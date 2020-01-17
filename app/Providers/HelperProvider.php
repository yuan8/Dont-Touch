<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Auth;
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


    public static function getIdsUrusanHandle(User $user,$id_urusan=null){
       if($user){
          $ids=$user->HaveUrusan->pluck('id')->toArray();
          if($id_urusan){
            if(in_array($id_urusan, $ids)){
              return $ids;
            }else{
              return [];
            } 
          }else{
            if(count($ids)>0){
              return $ids;
            }else{
              return [];
            }
          }
       }
    }


    public static function SpliterArray($data){
        $data_return='';
        if(!is_array($data)){
         $data=json_decode($data,true);

        }
        foreach($data as $key=> $d){
          $data_return.='<p>'.($key+1).'. '.$d.'</p>';
        }

        return $data_return;
    }

    public static function SpliterArrayLink($data){
        $data_return='';
        $data=json_decode($data,true);
        foreach($data as $key=> $d){
          $data_return.='<a href="javascript:void(0)" onclick="SearchingSatuData(`'.$d.'`)">'.$d.'</a><br>';
        }

        return $data_return;
    }


    public static function SpliterArrayLink2($data){
      $data_return='';
      foreach ($data as $key => $d) {
        $data_return.='<a href="javascript:void(0)" onclick="SearchingSatuData(`'.$d['nama'].'`)">'.$d['nama'].'</a><br>';
      }

      return $data_return;
    }


    public static function paginate($input=[],$page=1,$jdata=1,$paginate=1){
        $return['page']=$page;
        $return['total']=$jdata;
         $return['html']=view('widget.paginate',['input'=>$input,'page'=>$page,'jdata'=>$jdata,'paginate'=>$paginate])->render();
         return $return;
    }

}
