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
            ['unique_id' => $this->createUniqueId('agents', 'unique_id'), 'agent_name' => 'normal', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => $this->createUniqueId('agents', 'unique_id'), 'agent_name' => 'silver', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => $this->createUniqueId('agents', 'unique_id'), 'agent_name' => 'diamond', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => $this->createUniqueId('agents', 'unique_id'), 'agent_name' => 'golden', 'created_at'=>$currentDate, 'updated_at'=>$currentDate],
            ['unique_id' => $this->createUniqueId('agents', 'unique_id'), 'agent_name' => 'special', 'created_at'=>$currentDate, 'updated_at'=>$currentDate]
        ]);
    }
}