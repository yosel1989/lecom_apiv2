<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Helpers;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{


    public function register(Request $request)
    {

        $user = User::create([
            'usuario_user' => $request->username,
            'usuario_passwd' => Helpers::encryptPass($request->password)
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $User = User::where('username',$request->input('username') )
                    ->where('actived',1)
                    ->where('deleted',0)
                    ->get();

        if( !$User->isEmpty() ){

            if( !Hash::check( $request->input('password'),$User->first()->password ) ){
                return response()->json([
                    'body'=>[],
                    'errors' => [
                        'message'=>'Username or Password incorrect.'
                    ],
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            if( Auth::loginUsingId( $User->first()->id ) ) {
                $user = Auth::user();
                $token = $user->createToken($user->username.'-'.now());

                return response()->json([
                    'body'=>[
                        'token' => $token->accessToken,
                        'user' => [
                            'username' => $user->username,
                            'firstname' => $user->first_name,
                            'lastname' => $user->last_name,
                            'email' => $user->email,
                            'level' => $user->level
                        ],
                        'client' => $user->client ? $user->client()->first(['id','bussiness_name', 'first_name', 'last_name']) : null,
                        'permissions' => $user->modules()->pluck('short_name')
                    ],
                    'errors' => [],
                    'status' => Response::HTTP_OK
                ]);
            }else{
                return response()->json([
                    'body'=>[],
                    'errors' => [
                        'msg'=>'User not found'
                    ],
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

        }else{

            return response()->json([
                'body'=>[],
                'errors' => [
                    'msg'=>'User not found'
                ],
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }

    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json([
                'body'=>[],
                'errors' => [],
                'status' => Response::HTTP_OK
            ]);
        }else{
            return response()->json([
                'body'=>[],
                'errors' => [
                    'msg'=>'User Unauthorized'
                ],
                'status' => Response::HTTP_UNAUTHORIZED
            ]);
        }
    }

}
