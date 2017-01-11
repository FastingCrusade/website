<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-02
 * Time: 00:30
 */

namespace Testing;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class FastsController extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory('App\Models\Fast', 60)->create();
        $this->get('/api/fasts');

        $this->assertResponseOk();
        $this->seeJson([
            'status' => 'OK',
        ]);

        $response = json_decode($this->response->content());

        $this->assertEquals('http://localhost/api/fasts?page=2', $response->data->next_page_url);
        $this->assertEquals(60, $response->data->total);
    }

    public function testCreateAsAdmin()
    {
        /** @noinspection PhpParamsInspection */
        /** @var User $admin */
        $admin = factory('App\Models\User')->states('admin')->create();
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        $this->post(
            '/api/fasts',
            [
                'user_id'     => $user->id,
                'category_id' => factory('App\Models\Category')->create()->id,
                'start'       => Carbon::now(),
                'end'         => Carbon::now()->addDays(3),
                'description' => 'Just a test fast, nothing to see here.',
            ],
            [
                'Authorization' => "Bearer {$admin->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_CREATED);
        $this->seeJson([
            'status' => 'OK',
        ]);
        $this->assertTrue(is_int(json_decode($this->response->content())->data));
    }

    public function testCreateAsSelf()
    {
        /** @noinspection PhpParamsInspection */
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        $this->post(
            '/api/fasts',
            [
                'user_id'     => $user->id,
                'category_id' => factory('App\Models\Category')->create()->id,
                'start'       => Carbon::now(),
                'end'         => Carbon::now()->addDays(3),
                'description' => 'Just a test fast, nothing to see here.',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_CREATED);
        $this->seeJson([
            'status' => 'OK',
        ]);
        $this->assertTrue(is_int(json_decode($this->response->content())->data));
    }

    public function testCreateAsOther()
    {
        /** @noinspection PhpParamsInspection */
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        /** @var User $requester */
        $requester = factory('App\Models\User')->create();
        $this->post(
            '/api/fasts',
            [
                'user_id'     => $user->id,
                'category_id' => factory('App\Models\Category')->create()->id,
                'start'       => Carbon::now(),
                'end'         => Carbon::now()->addDays(3),
                'description' => 'Just a test fast, nothing to see here.',
            ],
            [
                'Authorization' => "Bearer {$requester->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testExtraFieldsSent()
    {
        /** @noinspection PhpParamsInspection */
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        $this->post(
            '/api/fasts',
            [
                'user_id'     => $user->id,
                'category_id' => factory('App\Models\Category')->create()->id,
                'start'       => Carbon::now(),
                'end'         => Carbon::now()->addDays(3),
                'description' => 'Just a test fast, nothing to see here.',
                'api_token'   => 'testTokenGoesHere',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testSendingTimestamps()
    {
        /** @noinspection PhpParamsInspection */
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        $this->post(
            '/api/fasts',
            [
                'user_id'     => $user->id,
                'category_id' => factory('App\Models\Category')->create()->id,
                'start'       => Carbon::now()->timestamp,
                'end'         => Carbon::now()->addDays(3)->timestamp,
                'description' => 'Just a test fast, nothing to see here.',
                'api_token'   => 'testTokenGoesHere',
            ],
            [
                'Authorization' => "Bearer {$user->api_token}",
            ]
        );

        $this->assertResponseStatus(Response::HTTP_CREATED);
    }
}
