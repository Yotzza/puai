<?php
namespace App\Http\Controllers\Api;

use App\Models\Zaposleni;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $zaposleni = Zaposleni::whereEmail($request->email)->firstOrFail();

        $token = $zaposleni->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }
}
