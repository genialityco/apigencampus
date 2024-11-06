<?php

namespace Database\Seeds;
use Illuminate\Database\Seeder;
use App\Account;

class AccountTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Account::factory()->count(2)->create();    
        factory(App\Account::class)->create();
    }
}
