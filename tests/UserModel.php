<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 30-Dec-16
 * Time: 23:54
 */

namespace Testing;


use App\Models\Comment;
use App\Models\Fast;
use App\Models\Gender;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mockery;

class UserModel extends TestCase
{
    use DatabaseTransactions;

    public function testFullname()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->make();

        $this->assertEquals("{$user->first_name} {$user->last_name}", $user->fullname(), 'Both names expected if provided.');

        $user = factory('App\Models\User')->make([
            'first_name' => null,
            'last_name'  => null,
        ]);

        $this->assertEquals($user->email, $user->fullname(), 'Email expected if no names provided.');

        $user = factory('App\Models\User')->make([
            'last_name' => null,
        ]);

        $this->assertEquals($user->first_name, $user->fullname(), 'Partial name expected if provided.');

        $user = factory('App\Models\User')->make([
            'first_name' => null,
        ]);

        $this->assertEquals($user->last_name, $user->fullname(), 'Partial name expected if provided.');
    }

    public function testOrganizations()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();

        $this->assertTrue($user->organizations() instanceof BelongsToMany);

        /** @var Collection $organizations */
        $organizations = factory('App\Models\Organization', 2)->create();
        $organizations->each(function (Organization $org) use ($user) {
            $user->organizations()->attach($org->id);
        });

        $this->assertEquals(2, $user->organizations()->count());
        $this->assertArraySubset($organizations->pluck('name')->toArray(), $user->organizations->pluck('name')->toArray());
    }

    public function testComments()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();

        $this->assertTrue($user->comments() instanceof HasMany);

        /** @var Collection $comments */
        $comments = factory('App\Models\Comment', 3)->create();
        $comments->each(function (Comment $comment) use ($user) {
            $user->comments()->save($comment);
        });

        $this->assertEquals(3, $user->comments()->count());
        $this->assertArraySubset($comments->pluck('id')->toArray(), $user->comments->pluck('id')->toArray());
    }

    public function testFasts()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();

        $this->assertTrue($user->fasts() instanceof HasMany);

        /** @var Collection $fasts */
        $fasts = factory('App\Models\Fast', 3)->create();
        $fasts->each(function (Fast $comment) use ($user) {
            $user->fasts()->save($comment);
        });

        $this->assertEquals(3, $user->fasts()->count());
        $this->assertArraySubset($fasts->pluck('id')->toArray(), $user->fasts->pluck('id')->toArray());
    }

    public function testGender()
    {
        /** @var User $user */
        $user = factory('App\Models\User')->create();

        $this->assertTrue($user->gender() instanceof BelongsTo);

        /** @var Gender $gender */
        $gender = factory('App\Models\Gender')->create();
        $user->gender()->associate($gender);

        $this->assertEquals($gender->id, $user->gender->id);
    }

    public function testProfileImageUrl()
    {
        $email = 'test@notadomain.com';
        $url = 'http://images.com/123';
        $mock_image_handler = Mockery::mock('image_handler');
        $mock_image_handler->shouldReceive('url')->with($email)->andReturn($url);
        $mock_image_handler->shouldReceive('setDefault');
        App::instance('App\Contracts\ImageHandler', $mock_image_handler);
        /** @var User $user */
        $user = factory('App\Models\User')->create([
            'email' => $email,
        ]);

        $this->assertTrue(filter_var($user->profileImageUrl(), FILTER_VALIDATE_URL) !== false);
    }

    public function testJsonSerialize()
    {
        /** @var Gender $gender */
        $gender = factory('App\Models\Gender')->create();
        /** @var User $user */
        $user = factory('App\Models\User')->create([
            'gender_id' => $gender->id,
        ]);

        $this->assertJson(collect([
            'id'     => $user->id,
            'gender' => [
                'id' => $gender->id,
            ],
        ])->toJson(), $user->toJson());
    }

    public function testJsonSerializeAsAdmin()
    {
        /** @var Gender $gender */
        $gender = factory('App\Models\Gender')->create();
        /** @var User $user */
        $user = factory('App\Models\User', 'admin')->create([
            'gender_id' => $gender->id,
        ]);
        Auth::login($user);

        $this->assertJson(collect([
            'id'        => $user->id,
            'gender'    => [
                'id' => $gender->id,
            ],
            'api_token' => $user->api_token,
        ])->toJson(), $user->toJson());
    }

    public function testJsonSerializeAsSelf()
    {
        /** @var Gender $gender */
        $gender = factory('App\Models\Gender')->create();
        /** @var User $user */
        $user = factory('App\Models\User')->create([
            'gender_id' => $gender->id,
        ]);
        Auth::login($user);

        $this->assertJson(collect([
            'id'        => $user->id,
            'gender'    => [
                'id' => $gender->id,
            ],
            'api_token' => $user->api_token,
        ])->toJson(), $user->toJson());
    }
}
