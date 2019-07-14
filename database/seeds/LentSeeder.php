<?php

use Illuminate\Database\Seeder;

class LentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lents::class,10)->create();
    }
}
