<?php

namespace App\Http\Controllers\front;

use DB;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Socialite;
use App\Traits\AuthTrait;





class AuthController extends Controller
{
    use AuthTrait;




    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'image' => "",
            'payment_account' => "",
            'payment_id' => 0,
            'statistiques' => 0,
            'type' => "User",
        ]);
        return response()->json(['msg' => "A new user has been registered"], 201);
    }

    function user()
    {
        dd($this->helperfunction1());
        $this->helperfunction1();
        $user = User::orderBy('id')->get();

        return response()->json(['message' => 'success', 'data' => $user], 200);
    }

    function roles()
    {

        $roles_user = DB::table('roles_user')->orderBy('id', 'desc')->get();
        return response()->json(['message' => 'success', 'data' => $roles_user], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];
    }

    function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'phone' => $request->input('phone'),
                'image' => "",
                'payment_account' => "",
                'payment_id' => 0,
                'statistiques' => 0,
            ]);
        return response()->json(['success' => 'User has been updated'], 200);
    }

    public function delete($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        return response()->json(['status' => 'success', 'data' => null], 200);
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'phone' => "",
                'image' => $user->avatar,
                'payment_account' => "",
                'payment_id' => 0,
                'statistiques' => 0,
                'type' => "User",
            ]);

            Auth::login($newUser);
        }
        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $newUser->createToken("API TOKEN")->plainTextToken
        ], 200);
    }


    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'phone' => "",
                'image' => $user->avatar,
                'payment_account' => "",
                'payment_id' => 0,
                'statistiques' => 0,
                'type' => "User",
            ]);

            Auth::login($newUser);
        }

        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => $newUser->createToken("API TOKEN")->plainTextToken
        ], 200);
    }


    function Seller($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'type' => "Seller",
            ]);
    }




}
