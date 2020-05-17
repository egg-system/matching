<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Carbon\Carbon;
use App\Models\Gym;
use App\Models\Login;


class register extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'オーナー登録コマンドです';

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
        $method = function() use ($question, $default) {
            return $this->ask($question, $default);
        };

        $input_value = $method();

        if ($input_value === false) {
            $input_value = null;
        }

        $validator = \Validator::make([$rules[0] => $input_value], [$rules[0] => $rules[1]]);

        if ($validator->fails()) {
            $error = $validator->errors();
            $result = $error->first($rules[0]);
        } else {
            $result = true;
        }

        if ($result !== true) {
            $this->warn($result);
            $input_value = $this->validateAsk($question, $rules, $default);
        }

        return $input_value;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      // 対話式で登録内容を入力する
      $email = $this->validateAsk('メールアドレスを入力してください', ['email','email']);
      $name = $this->validateAsk('屋号、事業名を入力してください',['屋号、事業名','required']);
      $president_name = $this->validateAsk('代表者氏名を入力してください',['代表者氏名','required']);
      $occupation_id = $this->validateAsk('種類を入力してください',['種類','required|exists:occupations,id']);
      $area_id = $this->validateAsk('場所／エリアを入力してください',['場所／エリア','required|exists:areas,id']);
      $staff_count = $this->validateAsk('スタッフ数を入力してください',['スタッフ数','required|integer']);

      $this->info("メールアドレス : $email");
      $this->info("屋号、事業名 　: $name");
      $this->info("代表者氏名 　　: $president_name");
      $this->info("種類 　　　　　: $occupation_id");
      $this->info("場所／エリア 　: $area_id");
      $this->info("スタッフ数 　　: $staff_count");

      if ($this->confirm('この内容で登録してよろしいですか?',true)) {
          // DBに入力値を登録
          $gym = new Gym();
          $gym->create([
                         'name' => $name,
                         'president_name' => $president_name,
                         'occupation_id' => $occupation_id,
                         'area_id' => $area_id,
                         'staff_count' => $staff_count
          ]);
  
          $login = new Login();
          $login->create([
          'name' => $name,
          'email' => $email,
          'email_verified_at' => Carbon::now(),
          'password' => Str::random(50),
          ]);

          $this->info("登録が完了しました");
      } else {
          $this->info('キャンセルしました');
      }
  }
}
