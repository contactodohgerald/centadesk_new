<?php

use Carbon\Carbon;
use App\Traits\Generics;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentsSeed extends Seeder
{
    use Generics;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = Carbon::now()->toDateTimeString();
        
        DB::table('agents')->insert([//unique_id, agent_name
            ['unique_id' => 'zuLKShyeijlyoMX7wWsP151f8b495dec34f5', 'agent_name' => 'normal', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => '31f3Ibex3rbQuqj3ubaeae463f657bdd8d21', 'agent_name' => 'silver', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => 'yMcRB9jYCtkAYsvnPq8I9cbaada2a9559ec4', 'agent_name' => 'diamond', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => 'NvlSLS84KSYxrz0Sijm7afb1596bd766c184', 'agent_name' => 'golden', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => 'pKnXYM6rIhCS5ldSQm9Cfcebcbee89638a83', 'agent_name' => 'special', 'created_at'=>$currentDate, 'updated_at'=>$currentDate]
        ]);
    }
}