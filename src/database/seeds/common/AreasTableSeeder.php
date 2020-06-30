<?php

namespace Database\Seeds\Common;

use App\Http\Clients\HeartRailsExpressClient;
use App\Models\Area;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        // 駅情報取得APIを利用して山手線の駅名を取得
        $client = new HeartRailsExpressClient();
        $response = $client->getYamanoteLineStations();
        $body = $response->getBody();
        $data = json_decode($body, true);
        $stations = $data['response']['station'];
        foreach ($stations as $stationData) {
            $stationName = $stationData['name'];
            Area::firstOrCreate([
                'name' => $stationName
            ]);
        }
    }
}
