<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Models\User;
use Modules\Common\Models\Partner;



class AuthController extends Controller
{
    // Register function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    // Login function
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $partner = Partner::where('user_id', Auth::user()->id)->first();
        $role = $user->getRoleNames()->first(); // Using Spatie's method to get the role name

        // Create a token for the user
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,  // Assuming `role` is a property of the User model
                'partner' => $partner    // Returns the partner data associated with the user
            ]
        ]);
    }

    // Logout function
    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }

    // Get Authenticated User function
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function editUserData(Request $request)
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();

        // Create a token for the user (optional, if you need to return a token)

        return response()->json([
            'message' => 'User data retrieved successfully',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'partner' => $partner    // Returns the partner data associated with the user
            ]
        ]);
    }

    // UserController.php
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);
        
        $user = auth()->user();
        
        // Verifikasi password lama
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Password lama tidak benar.'], 401);
        }
        
        // Pastikan password baru tidak sama dengan password lama
        if (Hash::check($request->new_password, $user->password)) {
            return response()->json(['message' => 'Password baru tidak boleh sama dengan password lama.'], 400);
        }
        
        // Ganti password
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengubah password.'], 500);
        }
        
        return response()->json(['message' => 'Password berhasil diubah.']);
        
    }

    public function updatePartner(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'name_partner' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update User
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update Partner
        $partner = Partner::where('user_id', $id)->firstOrFail();
        $partner->name = $request->name_partner;
        $partner->phone = $request->phone;
        $partner->address = $request->address;
        $partner->save();

        return response()->json([
            'message' => 'Partner updated successfully',
            'user' => $user,
            'partner' => $partner,
        ]);
    }
}
