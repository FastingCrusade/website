<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-02
 * Time: 00:30
 */

namespace Testing;


use Illuminate\Foundation\Testing\DatabaseTransactions;

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
}
