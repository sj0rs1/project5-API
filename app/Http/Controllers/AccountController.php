<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\DisallowedRanges;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $account = Auth::user();

            $account->tokens()->delete();

            $token = $account->createToken('api_token', $account->getTokenData())->plainTextToken;

            //dit is zo scuffed ik snap het ook niet, geen vragen stellen want het werkt.
            $token = PersonalAccessToken::where('tokenable_id', $account->id)->first()->token;

            return response()->json(['token' => $token, 'name' => $account->name], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required',
            'phone' => 'required'
        ]);

        try {
            $newAccount = new Account();
            $newAccount->name = $request->input('name');
            $newAccount->role_id = 1;
            $newAccount->phone = $request->input('phone');
            $newAccount->email = $request->input('email');
            $newAccount->password = Hash::make($request->input('password'));
            $newAccount->save();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully created'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not create'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $accessToken = PersonalAccessToken::where('token', $token)->first();

        if ($accessToken) {
            PersonalAccessToken::where('tokenable_id', $accessToken->tokenable_id)->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return response()->json(['message' => 'Logout attempt failed'], 401);
    }

    public function checkauth(Request $request)
    {
        $token = $request->bearerToken();

        $accessToken = PersonalAccessToken::where('token', $token)->first();

        if (!$accessToken) {
            return response()->json(['succes' => false, 'error' => 'Invalid token.'], 401);
        }

        return response()->json(['succes' => true,'id' => $accessToken->id, 'role_id' => json_decode($accessToken->abilities)->role_id], 200);
    }

    public function index(Request $request)
    {
        return Account::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|email|unique:accounts,email',
            'phone' => 'required',
            'password' => 'required'
        ]);

        try {
            $newAccount = new Account();
            $newAccount->name = $request->input('name');
            $newAccount->role_id = $request->input('role_id');
            $newAccount->phone = $request->input('phone');
            $newAccount->email = $request->input('email');
            $newAccount->password = Hash::make($request->input('password'));
            $newAccount->save();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully created'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not create'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Account::find($id);
    }

    public function getFromToken($token)
    {
        $foundToken = PersonalAccessToken::where('token', $token)->first();

        return ($foundToken != null) ? $foundToken->tokenable_id : null;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $account = Account::find($id);

            if ($request->has('password') && !empty($request->input('password'))) {
                $request->merge(['password' => Hash::make($request->input('password'))]);
            } else {
                $request->request->remove('password');
            }

            $account->update($request->only(['name', 'role_id', 'email', 'password']));

            return response()->json([
                'error' => false,
                'message' => 'Successfully edited'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not edit'
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Account::find($id)->delete();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully deleted'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not delete'
            ]);
        }
    }
}
