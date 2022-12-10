<?php

use Illuminate\Database\Seeder;

use App\BlogConfig;

class ConfigsTableSeeder extends Seeder
{
    public function run()
    {
        $config = new \App\BlogConfig();
        $config->text = "Blog piłkarski";
        $config->image = "default.jpg";
        $config->pagination = 6;
        $config->save();

    }
}
