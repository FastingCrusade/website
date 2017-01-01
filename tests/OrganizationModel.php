<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 31-Dec-16
 * Time: 04:15
 */

namespace Testing;


use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Organization;
use Illuminate\Support\Collection;

class OrganizationModel extends TestCase
{
    use DatabaseTransactions;

    public function testUser()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();
        /** @var Organization $organization */
        $organization = factory('App\Models\Organization')->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($organization->user() instanceof BelongsTo);
        $this->assertEquals($user->id, $organization->user->id);
    }

    public function testUsers()
    {
        /** @var Organization $organization */
        $organization = factory('App\Models\Organization')->create([]);
        /** @var Collection $users */
        $users = factory('App\Models\User', 3)->create();
        $users->each(function (User $user) use ($organization) {
            $user->organizations()->attach($organization->id);
            $user->save();
        });

        $this->assertTrue($organization->users() instanceof BelongsToMany);
        $this->assertEquals($users->count(), $organization->users()->count());
    }
}
