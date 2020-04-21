<?php

use App\Models\Occupation;
use Illuminate\Support\Facades\DB;

class OccupationsTableSeeder extends BaseSeeder
{

    /**
     * 開発環境用
     */
    public function dev()
    {
        $this->production();
    }

    /**
     * 本番用
     */
    public function production()
    {
        $datas = $this->dataList();
        foreach ($datas as $data) {
            Occupation::firstOrCreate($data);
        }
    }

    /**
     * 挿入データ定義
     *
     * @return array
     */
    private function dataList()
    {
        return [
            [
                'name' => 'パーソナル'
            ],
            [
                'name' => 'ボクシング'
            ],
            [
                'name' => 'フィットネス'
            ],
            [
                'name' => 'etc'
            ]
        ];
    }
}
