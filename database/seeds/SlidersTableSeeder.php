<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Slider;

class SlidersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sliders')->truncate();

        Model::unguard();

        $css_main = 'slidedirection: right; transition2d: 92,93,105;';
        $css_1 = 'color: #fff; padding: 5px 15px; background-color: #ec1f27; font-weight: 100; font-size: 25px; top:145px; left: 15px; slidedirection : top; slideoutdirection : bottom; durationin : 1000; durationout : 1000;';
        $css_2 = 'opacity: 0.9; padding: 5px 15px; font-size:25px; top:200px; left: 15px; slidedirection : bottom; slideoutdirection : bottom; durationin : 2000; durationout : 2000;';
        $css_3 = 'top:110px; left: 770px; slidedirection : right; slideoutdirection : bottom; durationin : 3000; durationout : 3000;';

        Slider::create([
            'file_main' => '1.jpg',
            'file_logo' => '1.png',
            'url' => '#',
            'text_1' => 'Sika - компанія зі 100-річною історією',
            'text_2' => 'Інновації та стабільність',
            'css_main' => $css_main,
            'css_1' => $css_1,
            'css_2' => $css_2,
            'css_3' => $css_3,
            'order' => 1,
        ]);

        Slider::create([
            'file_main' => '2.jpg',
            'file_logo' => '2.png',
            'url' => '#',
            'text_1' => 'Sika - компанія зі 100-річною історією',
            'text_2' => 'Інновації та стабільність',
            'css_main' => $css_main,
            'css_1' => $css_1,
            'css_2' => $css_2,
            'css_3' => $css_3,
            'order' => 2,
        ]);


        Slider::create([
            'file_main' => '3.jpg',
            'file_logo' => '3.png',
            'url' => '#',
            'text_1' => 'Sika - компанія зі 100-річною історією',
            'text_2' => 'Інновації та стабільність',
            'css_main' => $css_main,
            'css_1' => $css_1,
            'css_2' => $css_2,
            'css_3' => $css_3,
            'order' => 3,
        ]);

        Model::reguard();
    }
}
