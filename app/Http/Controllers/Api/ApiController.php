<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 11-Dec-16
 * Time: 01:24
 */

namespace App\Http\Controllers;


use Illuminate\Http\Response;

/**
 * Class ApiController
 *
 * TODO: Create a response class to move this member variables into.
 *
 * @package App\Http\Controllers
 */
abstract class ApiController extends Controller
{
    protected $status = 'OK';
    protected $code = Response::HTTP_OK;
    protected $message = '';

    /**
     * Generic API style response.
     *
     * @param string $message
     * @param string $status
     * @param int    $code
     *
     * @return Response
     */
    protected function response($message = null, $status = null, $code = null)
    {
        $message = $message ?: $this->message;
        $status = $status ?: $this->status;
        $code = $code ?: $this->code;

        return response()->json([
            'status'  => $status,
            'message' => $message,
        ], $code);
    }
}
