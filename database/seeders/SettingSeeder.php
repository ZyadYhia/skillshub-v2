<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email'=>'zyad.yhia@epic-techs.com',
            'phone'=>'01002401163',
            'facebook'=>'https://www.facebook.com/zyad.yhia96',
            'linkedin'=>'https://www.linkedin.com/in/zyad-yhia-206918167/',
            'instagram'=>'https://www.instagram.com/zyad_yhia/',
            'youtube'=>'https://www.youtube.com/channel/UCXPyFbVh-g1BeUloNU7UI4A',
            'twitter'=>'https://twitter.com/zyad_yhia',
        ]);
    }
}
