<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 24-Nov-16
 * Time: 02:54
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class Server
{
    /** @var String $payload */
    private $payload;
    /** @var String $github_secret */
    private $github_secret;
    /** @var string $passphrase */
    private $passphrase;

    public function __construct(Request $request)
    {
        $this->payload = $request->getContent();
        $this->github_secret = config('services.github')['secret'];
        $this->passphrase = $request->header('X-Hub-Signature');
        $this->id = $request->header('X-GitHub-Delivery');
    }

    public function deploy() {
        if ($this->verifyPayload()) {
            if (Artisan::call('app:deploy') === 0) {
                event(App::make('App\Events\Deployment', [time(), $this->id]));
                $response = response()->make('OK', 200);
            } else {
                $response = response()->make('Deployment failed.', 500);
            }
        } else {
            $response = response()->make('Failed security check.', 403);
        }

        return $response;
    }

    private function verifyPayload()
    {
        $hash = 'sha1=' . hash_hmac('sha1', $this->payload, $this->github_secret);

        return ($hash === $this->passphrase);
    }
}
