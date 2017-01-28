<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 24-Nov-16
 * Time: 02:54
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Server
{
    /** @var String $payload */
    private $payload;
    /** @var String $github_secret */
    private $github_secret;
    /** @var String $passphrase */
    private $passphrase;
    /** @var String $id */
    private $id;
    /** @var String $deployed_branch */
    private $deployed_branch;

    public function __construct(Request $request)
    {
        $this->payload = $request->getContent();
        $this->ref = ($request->header('X-GitHub-Event') === 'push') ? json_decode($this->payload)->ref : null;
        $this->github_secret = config('services.github')['secret'];
        $this->passphrase = $request->header('X-Hub-Signature');
        $this->id = $request->header('X-GitHub-Delivery');
        $this->deployed_branch = config('services.github')['branch'];
    }

    /**
     * Performs the deployment via Artisan.
     *
     * @return Response
     */
    public function deploy() {
        if ($this->verifyPayload()) {
            if ($this->checkRef()) {
                if (Artisan::call('app:deploy') === 0) {
                    event(App::make('App\Events\Deployment', [$this->id]));
                    $response = response()->make('OK', 200);
                } else {
                    $response = response()->make('Deployment failed.', 500);
                }
            } else {
                $response = response()->make('Branch ignored.', 202);
            }
        } else {
            $response = response()->make('Failed security check.', 403);
        }

        return $response;
    }

    /**
     * Verifies the integrity of the payload.
     *
     * @return bool
     */
    private function verifyPayload()
    {
        $hash = 'sha1=' . hash_hmac('sha1', $this->payload, $this->github_secret);

        if ($hash === $this->passphrase) {
            $passed = true;
        } else {
            $passed = false;
            Log::info("Deploy attempted with invalid security. Hash {$hash} does not match passphrase {$this->passphrase}.");
        }

        return $passed;
    }

    /**
     * Determines if the proper ref was sent.
     *
     * @return bool
     */
    private function checkRef()
    {
        return ($this->ref === "refs/heads/{$this->deployed_branch}");
    }
}
