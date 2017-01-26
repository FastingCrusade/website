<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-26
 * Time: 00:52
 */

namespace Testing;


use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentModel extends TestCase
{
    use DatabaseTransactions;

    public function testArrayRepresentation()
    {
        /** @var array $array */
        $array = factory('App\Models\Comment')->create()->toArray();

        $this->assertTrue(is_int($array['created_at']));
        $this->assertTrue(is_int($array['updated_at']));
    }
}
