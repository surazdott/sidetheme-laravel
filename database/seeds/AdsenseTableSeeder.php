<?php

use Illuminate\Database\Seeder;

class AdsenseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adsense = App\Adsense::create([
        	'above_featured' => null,
            'above_latest' => null,
            'above_footer' => null,
            'above_image' => null,
            'above_desc' => null,
            'below_desc' => null,
            'above_details' => null,
            'above_downloads' => null,
            'above_tags' => null,
            'below_tags' => null,
        ]);
    }
}
