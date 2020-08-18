<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Area;
use App\Models\Login;
use App\Models\Occupation;
use App\Models\Trainer;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use ReflectionClass;
use Tests\TestCase;

class TrainerRegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // トレーナーの登録機能を有効にする
        config(['release.register.is_enabled' => true]);
    }

    /**
     * email登録できること
     * @test
     */
    public function canRegisterEmail()
    {
        $this->withoutMiddleware([VerifyCsrfToken::class]);

        $this->get(route('top'))->assertStatus(200);

        $email = $this->faker->email;
        // email登録
        $response = $this->post(route('trainers.register'), compact('email'));
        // 送信完了画面へ
        Mail::fake();
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
    public function canRegisterTrainerInfo()
    {
        $this->withoutMiddleware([VerifyCsrfToken::class]);
        $this->withExceptionHandling();
        // login作成
        $login = factory(Login::class)->create();
        // protectedアクセス
        $notification = new VerifyEmail();
        $ref = new ReflectionClass($notification);
        $verificationUrl = $ref->getMethod('verificationUrl');
        $verificationUrl->setAccessible(true);
        // 署名url取得
        $url = $verificationUrl->invoke($notification, $login);

        // 署名ルートにアクセス
        $this->get($url)->assertStatus(200);
        // 登録データ作成
        $data = factory(Trainer::class)->make([
            'password' => 'password',
            'password_confirmation' => 'password',
            'agree' => true
        ]);

        $response = $this->post(
            URL::signedRoute('trainers.store', ['id' => $login->id]),
            array_merge($data->toArray(), [
                'name' => $login->name,
                'occupation_ids' => factory(Occupation::class)->create()->id,
                'area_id' => factory(Area::class)->create()->id,
                'careers' => json_encode($data->career)
            ])
        );

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
