<?php

use Illuminate\Database\Seeder;

class UserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $users=[

        	[
        	'name'=>'dss',
        	'email'=>'dss@domain.com',
        	'password'=>'$2y$10$VWqJmqHg5GLwu4EwNu7LieyY85gseIs4sqLHaBlA5XRN76gnqIJ2m',
        	'api_token'=>'testing_token'.rand(0,10000)
        	],

        ];

        DB::table('users')->delete();
    	DB::table('users')->truncate();

    	DB::table('users')->insert($users);

    	DB::table('user_role_urusan')->delete();
    	DB::table('user_role_urusan')->truncate();

    	$urusans=[
    		[
    			'id_user'=>1,
    			'id_urusan'=>3
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>15
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>21
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>16
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>4
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>20
    		],
    		[
    			'id_user'=>1,
    			'id_urusan'=>25
    		]

    	];

    	DB::table('user_role_urusan')->insert($urusans);

        $datas=DB::table('urusan_23_plus')->get();

        foreach ($datas as $key => $value) {
            DB::table('urusan_23')->where('id',$value->id)->update([
                'nomenklatur_provinsi'=>$value->nomenklatur_provinsi,
                'nomenklatur_kabkota'=>$value->nomenklatur_kabkota
            ]);
        }



    	return 1;
    }
}
