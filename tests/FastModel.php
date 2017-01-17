<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-01-16
 * Time: 22:42
 */

namespace Testing;


use App\Models\Fast;
use Carbon\Carbon;

class FastModel extends TestCase
{
    public function testToArray()
    {
        $start = Carbon::now();
        $end = Carbon::now()->addDays(3);

        /** @var Fast $fast */
        $fast = factory('App\Models\Fast')->make([
            'start' => $start,
            'end'   => $end,
        ]);

        $this->assertArraySubset(
            [
                'start' => $start->timestamp,
                'end'   => $end->timestamp,
            ],
            $fast->toArray()
        );
    }
}
