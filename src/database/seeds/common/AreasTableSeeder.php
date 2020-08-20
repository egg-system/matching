<?php

namespace Database\Seeds\Common;

use App\Http\Clients\HeartRailsExpressClient;
use App\Models\Area;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class AreasTableSeeder extends Seeder
{
    const AREA_DATA = [
        '東京エリア' => [
            '新宿・代々木',
            '渋谷',
            '銀座・日比谷・有楽町・新橋',
            '原宿・青山・表参道',
            '六本木・麻布・広尾',
            '赤坂・溜池山王',
            '恵比寿・代官山・中目黒',
            '田町・浜松町・芝浦・品川',
            '東京・日本橋',
            '目黒・白金台・五反田・大崎',
            '市ヶ谷・四谷・麹町・九段',
            'お台場・有明',
            '天王洲・港南',
            'その他地域',
        ],
        '神奈川エリア' => [
            '横浜',
            '川崎',
            '鎌倉・逗子・横須賀',
            '藤沢・茅ヶ崎・平塚',
            '相模原',
            'その他地域',
        ],
    ];

    public function run()
    {
        collect(self::AREA_DATA)->each(function ($areas, $prefecture) {
            $area = Area::firstOrCreate(['name' => $prefecture]);

            collect($areas)->each(function ($areaData) use ($area) {
                $area->children()->firstOrCreate(['name' => $areaData]);
            });
        });
    }
}
