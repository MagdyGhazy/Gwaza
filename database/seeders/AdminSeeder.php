<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
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

        $admin = User::updateOrCreate(['email'=>'admin@app.com'],[
            'email'     => 'admin@app.com',
            'name'      => 'Super Admin',
            'password'  => bcrypt('password'),
            'address'=>'elmahala',
            'gender'=>'1',
            'user_type'=>UserRoleEnum::ADMIN,
            'latitude'=>'30.11',
            'longitude'=>'30.28',
            'phone'=>'012714'
        ]);
//        $admin->assignRole('Super Admin');
//        $this->command->info('Admin Account Has Been Created Successfully');

    }
}
