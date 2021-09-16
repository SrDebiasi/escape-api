<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class External extends Middleware
{
    public function handle($request, Closure $next)
    {
        //$tokenSalt = env('EXT_SALT', '');
        //$externalSources = explode(',', env('EXT_SRCS', ''));
        $ipServer = \Request::server('SERVER_ADDR');

        //if (!in_array(\Request::ip(), $externalSources))
        if (!in_array(\Request::ip(), [$ipServer]))
            abort(405, 'not_allowed');

        switch ($request->method()) {
            //GET
            case 'GET':
                $authorization = $request->header('Authorization');
                $hash = $request->query('hash');
                $company = $request->query('company');
                $token = md5($company . env('KEY_EXTERNAL'));
//
//                if (!Hash::check($hashMake, $authorization))
//                    abort(405, 'not_allowed');
                if ($token !== $hash)
                    abort(405, 'not_allowed');
                break;

            //POST
            case 'POST':
                $authorization = $request->header('Authorization');
                $postJson = json_encode($request->post());
//                $hashMake = $postJson . $tokenSalt;
//                $token = Hash::make($hashMake);
//
//                if (!Hash::check($hashMake, $authorization))
//                    abort(405, 'not_allowed');
                break;

            //DEFAULT
            default:
                abort(405, 'not_allowed');
                break;
        }
        return $next($request);

    }

}
