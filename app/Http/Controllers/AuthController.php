<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Méthode pour l'authentification (login)
    public function login(LoginRequest $request)
    {
        //dd('LoginController hit!');
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Vérification des informations d'identification
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer un token pour cet utilisateur
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response([
            'message' => 'Connexion réussie',
            'token' => $token,
            'user' => $user,  // Optionnel : Retourner l'utilisateur connecté pour plus de détails
        ],200);
    }

    // Méthode pour déconnexion (logout)
    public function logout(Request $request)
    {
        if ($request->user()) {
            // Supprimer le token de l'utilisateur authentifié
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Déconnexion réussie']);
        }

        return response()->json(['message' => 'Aucun utilisateur authentifié'], 401);
    }
}