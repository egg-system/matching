<?php

namespace Database\Seeds\Common;

use App\Models\Area;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        // 駅情報取得APIを利用して山手線の駅名を取得
        $client = new Client();
        $url = 'http://express.heartrails.com/api/json?method=getStations&line=JR%E5%B1%B1%E6%89%8B%E7%B7%9A';
        $response = $client->request('GET', $url);
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
