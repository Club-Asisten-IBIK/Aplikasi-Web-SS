<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginMobileController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Find user by username
            $user = User::where('username', $request->username)
                ->where('isactive', true)
                ->first();

            // Check if user exists and password matches
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'username' => ['Invalid credentials'],
                ]);
            }

            // Get user role with parent relationship
            $userRole = UserRole::with('parent')
                ->where('userid', $user->userid)
                ->whereNotNull('parentid')
                ->first();

            // Check if user is a parent
            if (!$userRole || !$userRole->parent) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User is not authorized as parent'
                ], 403);
            }

            // Create token for mobile app
            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'userid' => $user->userid,
                        'username' => $user->username,
                    ],
                    'parent' => [
                        'parentid' => $userRole->parent->parentid,
                        'name' => $userRole->parent->name,
                        'status' => $userRole->parent->status,
                    ]
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Revoke current token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logout failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
