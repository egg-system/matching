<?php

namespace Tests\Feature;

use App\Models\Login;
use App\Models\Trainer;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use ReflectionClass;
use Tests\TestCase;

class TrainerRegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * email登録できること
     * @test
     */
    public function can_register_email()
    {
        $this->get(route('top'))->assertStatus(200);

        $email = $this->faker->email;
        // email登録
        $response = $this->post(route('register'), compact('email'));
        // 送信完了画面へ
        $response->assertStatus(302);
        // 登録確認
        $this->assertDatabaseHas('login', compact('email'));
        // ログイン状態ではないこと
        $this->assertGuest();
    }

    /**
     * トレーナー登録できること
     * @test
     */
    public function can_register_trainer_info()
    {
        // login作成
        $login = factory(Login::class)->create();
        // protectedアクセス
        $notification = new VerifyEmail();
        $ref = new ReflectionClass($notification);
        $verificationUrl = $ref->getMethod('verificationUrl');
        $verificationUrl->setAccessible(true);
        // 署名url取得
        $url = $verificationUrl->invoke($notification, $login);
        // $url = str_replace(url('/'), '', $url);

        // 署名ルートにアクセス
        $this->get($url)->assertStatus(200);
        // 登録データ作成
        $data = factory(Trainer::class)->make(['agree' => 1]);
        $response = $this->post(URL::signedRoute('trainer.store', ['id' => $login->id]), $data->toArray());
        // 登録後リダイレクト
        $response->assertSessionHasNoErrors()->assertStatus(302);
        // トレーナー登録
        $this->assertCount(1, Trainer::all());
        // loginとのmorph確認
        $trainer = Login::find($login->id)->user;
        $this->assertEquals($trainer->getAttributes(), Trainer::first()->getAttributes());
        // 認証確認
        $this->assertAuthenticated();
    }
}
