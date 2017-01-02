<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-02
 * Time: 01:38
 */

namespace Testing;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserFastsController extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        factory('App\Models\Fast', 60)->create([
            'user_id' => $user->id,
        ]);
        $this->get("/api/user/{$user->id}/fasts");

        $this->assertResponseOk();
        $this->seeJson([
            'status' => 'OK',
        ]);

        $response = json_decode($this->response->content());

        $this->assertEquals("http://localhost/api/user/{$user->id}/fasts?page=2", $response->data->next_page_url);
        $this->assertEquals(60, $response->data->total);
    }
}
