<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a listing of the students
    public function index()
    {
        return response()->json(Student::all());
    }

    // Store a new student
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
            ]);

            // Create the student and return the result
            $student = Student::create([
                'name' => $request->name,
                'age' => $request->age,
            ]);

            return response()->json([
                'message' => 'Student added successfully',
                'student' => $student
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    // Display a specific student
    public function show(Student $student)
    {
        return response()->json($student);
    }

    // Update an existing student
    public function update(Request $request, Student $student)
    {
        try {
            $request->validate([
                'name' => 'sometimes|required|string',
                'age' => 'sometimes|required|integer',
            ]);

            // Update the student with the provided data
            $student->update($request->only(['name', 'age']));

            return response()->json($student);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    }

    // Delete a student
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete student'], 500);
        }
    }
}
