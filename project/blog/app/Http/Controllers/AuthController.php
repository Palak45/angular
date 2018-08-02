<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\UserData;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        try {
            $requestData = $request->all();

            $userData = UserData::get();
        } catch (\Illuminate\Database\QueryException $ex) {
            return response(array(
                'error' => false,
                'data' => null,
                'msg' => $ex->getMessage()
            ), 400);
        }
        return response(array(
            'error' => false,
            'data' => $userData,

        ), 200);
    }

    public function register(RegisterFormRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

        } catch (\Illuminate\Database\QueryException $ex) {
            return response(array(
                'error' => true,
                'data' => null,
                'msg' => $ex->getMessage()
            ), 400);
        }
            return response(array(
                'error' => false,
                'data' => $user,
            ),200);

    }
    public function search(Request $request)
    {
        $requestData = $request->all();
        try {


            $query = UserData::query();
            if (isset($requestData['search']) && !empty($requestData['search'])) {
                $query->where(function ($query) use ($requestData) {
                    $query->where('name', 'LIKE', '%' . $requestData['search'] . '%');

                });
            }
            $userData = $query->get();

        } catch (\Illuminate\Database\QueryException $ex) {
            return response(array(
                'error' => true,
                'data' => null,
                'msg' => $ex->getMessage()
            ), 400);
        }
        return response(array(
            'error' => false,
            'data' => $userData,

        ), 200);
    }
}
