<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Gym;
use App\Models\Login;
use App\Models\Occupation;


class GymRegisterCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gym:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ジムオーナーを登録するコマンドです';

    private const RULE_NAME = 0;
    private const RULE_VALUE = 1;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function validateAsk($question, $rules, $default = null)
    {
        $inputValue = $this->ask($question, $default);

        $validator = \Validator::make([
            $rules[self::RULE_NAME] => $inputValue
        ], [
            $rules[self::RULE_NAME] => $rules[self::RULE_VALUE]
        ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $this->warn($error->first($rules[self::RULE_NAME]));
            $inputValue = $this->validateAsk($question, $rules, $default);
        }

        return $inputValue;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 対話式で登録内容を入力する
        $email = $this->validateAsk('メールアドレスを入力してください', [
            'メールアドレス',
            [
                'email',
                Rule::unique('login', 'email')->where(function ($query) {
                    return $query->where('user_type', Gym::class);
                })
            ]
        ]);
        $name = $this->validateAsk('屋号、事業名を入力してください', ['屋号、事業名','required']);
        $presidentName = $this->validateAsk('代表者氏名を入力してください', ['代表者氏名','required']);
        $occupations = Occupation::get(['name'])->pluck('name')->toArray();
        $occupationName = $this->choice('種類を入力してください', $occupations);
        $areas = Area::get(['name'])->pluck('name')->toArray();
        $areaName = $this->choice('場所／エリアを入力してください', $areas);

        $this->info("メールアドレス : $email");
        $this->info("屋号、事業名 　: $name");
        $this->info("代表者氏名 　　: $presidentName");
        $this->info("種類 　　　　　: $occupationName");
        $this->info("場所／エリア 　: $areaName");

        if (!$this->confirm('この内容で登録してよろしいですか?', false)) {
            return;
        }

        // DBに入力値を登録
        $occupationId = Occupation::where('name', $occupationName)->first()->id;
        $areaId = Area::where('name', $areaName)->first()->id;
        $gym = Gym::create([
            'name' => $name,
            'president_name' => $presidentName,
            'occupation_id' => $occupationId,
            'area_id' => $areaId
        ]);

        $password = Str::random(10);
        $gym->login()->create([
            'name' => $name,
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'password' => $password,
        ]);

        $this->info('登録が完了しました');
        $this->info("パスワード：$password");
    }
}
