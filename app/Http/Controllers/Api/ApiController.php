<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 11-Dec-16
 * Time: 01:24
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
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
    protected $data = '';

    /**
     * Generic API style response.
     *
     * @param string $data
     * @param string $status
     * @param int    $code
     *
     * @return Response
     */
    protected function response($data = null, $status = null, $code = null)
    {
        $data = $data ?: $this->data;
        $status = $status ?: $this->status;
        $code = $code ?: $this->code;

        return response()->json([
            'status' => $status,
            'data'   => $data,
        ], $code);
    }

    /**
     * General unauthorized response.
     *
     * @return Response
     */
    protected function notAuthorizedResponse()
    {
        return $this->response(null, 'NOT AUTHORIZED', Response::HTTP_UNAUTHORIZED);
    }
}
