<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{


    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:6|confirmed',
            'company' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'locale' => $request->get('locale'),
            'password' => Hash::make($request->get('password')),
        ]);

        $companyRepository = new CompanyRepository();
        $companyRepository->store([
            'name' => $request->get('company'),
            'email' => $request->get('email'),
            'user_id' => $user->id
        ])['data'];
        DB::commit();

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 200);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        $user = User::with('companies')->find($user->id);
        return $this->response($user);
    }


    public function show($id, UserRequest $request)
    {
        $user = User::with('companies')->find($id);

        return $this->response($user);
    }

    public function locale(UserRequest $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        $user = User::with('companies')->find($user->id);
        $user->locale = $request->post('locale');
        $user->save();

        return $this->response($user);
    }

}
