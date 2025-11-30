<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Command :
         * artisan seed:generate --table-mode --tables=books,book_user,users
         *
         */

        $dataTables = [
            [
                'id' => 1,
                'name' => 'donut',
                'email' => 'mydomub@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$1dQLJhjUm4NXypoIYfi0J.zVGxezDJSIkDY5PFrEGLbeR0FN.WbXO',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-11-18 14:57:11',
                'updated_at' => '2025-11-18 14:57:11',
            ],
            [
                'id' => 2,
                'name' => 'Ayanna Manning',
                'email' => 'fibyj@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$pgRkaJX9EJR0V.nOrV.M4.Ch0DSJBKtfH.FQubh1WCSCeWaZ1ntAm',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'created_at' => '2025-11-20 00:42:39',
                'updated_at' => '2025-11-20 00:42:39',
            ]
        ];
        
        DB::table("users")->insert($dataTables);
    }
}