<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '家事',
        ];
        DB::table('tags')->insert($param);
        $param = [
            'name' => '運動',
        ];
        DB::table('tags')->insert($param);
        $param = [
            'name' => '趣味',
        ];
        DB::table('tags')->insert($param);
        $param = [
            'name' => '仕事',
        ];
        DB::table('tags')->insert($param);
        $param = [
            'name' => '交際',
        ];
        DB::table('tags')->insert($param);
    }
}
