<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $status = 'fail';
    protected $message = '';
    protected $code = 200;

    protected function responseData($data = [], $more = '', $code = 200)
    {
        $res = [
            'status'  => $this->status,
            'message' => $this->message,
            'code'    => $this->code,
            'data'    => $data
        ];
        if ($more) {
            $res = array_merge($res, $more);
        }
        return response()->json($res, $code);
    }
}
