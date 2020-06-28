<?php

declare(strict_types=1);

namespace Database\Seeds\Common;

use App\Http\Clients\HeartRailsExpressClient;
use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    public function run(): void
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
                'name' => $stationName,
            ]);
        }
    }
}
