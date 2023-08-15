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

        $admin = User::updateOrCreate(['email' => 'admin@app.com'], [
            'email'     => 'admin@app.com',
            'first_name'      => 'Super',
            'last_name'      => 'Admin',
            'password'  => bcrypt('Password'),
            'city' => '1',
            'gender' => 'male',
            'user_type' => UserRoleEnum::ADMIN,
            'phone' => '012714',
            'country_code' => '020'
        ]);
        //        $admin->assignRole('Super Admin');
        //        $this->command->info('Admin Account Has Been Created Successfully');

    }
}
