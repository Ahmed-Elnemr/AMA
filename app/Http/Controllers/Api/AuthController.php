<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{

    public function register(Request $request)
            {
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
                            'email' => 'required|string|email|max:255|unique:users',
                            'password' => 'required|string|min:8',
            ]);

                $user = User::create([
                        'name' => $validatedData['name'],
                            'email' => $validatedData['email'],
                            'password' => Hash::make($validatedData['password']),
                            'role_id' => "USER"
                ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                        'access_token' => $token,
                            'token_type' => 'Bearer',
            ]);
            }


            public function login(Request $request)
                {
                if (!\Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                'message' => 'Invalid login details'
                        ], 401);
                    }

                $user = User::where('email', $request['email'])->firstOrFail();
                 if($user->role_id == "USER" || $user->role_id == "ADMIN") {
                     $token = $user->createToken('auth_token')->plainTextToken;
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                   ]);
                 }else{
                    return response()->json([
                        'message' => 'Invalid login details'
                                ], 401);
                 }



                }


                public function me(Request $request)
                {

                    return response()->json($request->user()
                );

                }

                public function updatetokne(Request $request){
                    $authUser = User::find(\Auth::id());
                    $user = User::where('id', $authUser->id)->firstOrFail();
                    $user->fbtoken = $request->fbtoken;
                    $user->save();
                    return $user;
                }

}
