<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(AttachmentsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
