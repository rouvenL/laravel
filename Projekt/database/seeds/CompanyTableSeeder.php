<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->insert([
            'id' => '1',
            'company_name' => 'Fewclicks',
            'operating_status' => 'Active',
        ]);
        
        DB::table('company')->insert([
            'id' => '2',
            'company_name' => 'Test',
            'operating_status' => 'Active',
        ]);
        
        DB::table('company')->insert([
           'id'=>'3',
           'company_name'=> 'Microsoft',
           'operating_status'=> 'Inactiv',
        ]);
    }
}
