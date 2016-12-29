<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 16-Dec-16
 * Time: 00:35
 */

namespace App\Http\Controllers\Api;


use App\Models\EmailSubscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Newsletters extends ApiController
{
    public function create(Request $request)
    {
        if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            EmailSubscription::create([
                'email' => $request->input('email'),
            ]);

            $response = $this->response('Subscription started.');
        } else {
            $response = $this->response('Invalid email provided.', 'FAILED', Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}
