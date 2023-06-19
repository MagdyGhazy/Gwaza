<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $name='admin';
        $email='admin@admin.com';
        $password='12345678';
        $address='elmahala';
        $gender='1';
        $usertype='1';
        $latitude='30.11';
        $longitude='30.28';
        $phone='012714';


        foreach ($bgs as $bg)
        {
            User::create([
                'Name'=>$name,
                'email'=>$email,
                'password'=>$password,
                'address'=>$address,
                'latitude'=> $latitude,
                'longitude'=>$longitude,
                'phone'=>$phone,
                'gender'=> $gender,
                'user_type'=> $usertype,
            ]);
        }
    }
}
