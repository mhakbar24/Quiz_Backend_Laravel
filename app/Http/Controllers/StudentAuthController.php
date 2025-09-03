<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function register(Request $request)
    {
  
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:students,email',
            'password' => 'required|string|min:6',
        ]);

        $student = Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Student registered successfully',
            'student' => $student
        ], 201);
    }
    

    public function login(Request $request)
    {
        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $token = $student->createToken('student-token')->plainTextToken;

        return response()->json([
            'student' => $student,
            'token'   => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function profile(Request $request)
{
    return response()->json($request->user());
}
}
