<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'OMAR',
            'email'=>'omar@yahoo.com',
            'password'=> Hash::make('password'),
        ]);

        // Query builder لو فيه جدول ملوش مودل نفوم بستخدام هذا الطريقه لعمل اضافة بيانات له
        DB::table('users')->insert([
            'name'=>'Hossam',
            'email'=>'hossam@yahoo.com',
            'password'=> Hash::make('password'),
        ]);
    }
}
