<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

URL::forceRootUrl(config('app.url')); 

Route::get('/', function () {
    return view('welcome');
});


// Fake in-memory data (resets on every reload)
app()->singleton('fakeData', function () {
    return [
        'students' => [
            [ "id" => 1, "name" => "John Doe", "age" => 20 ],
            [ "id" => 2, "name" => "Jane Smith", "age" => 22 ],
        ],
        'teachers' => [
            [ "id" => 1, "name" => "Mr. Brown", "subject" => "Math" ],
            [ "id" => 2, "name" => "Ms. Green", "subject" => "Science" ],
        ]
    ];
});

// --- STUDENT ROUTES ---

Route::get('/students', function () {
    return response()->json(app('fakeData')['students']);
});

Route::post('/students', function (Request $request) {
    $data = $request->all();
    $store = &app('fakeData');
    foreach ($store['students'] as $student) {
        if ($student['id'] == $data['id']) {
            return response()->json(['error' => 'Student ID already exists'], 400);
        }
    }
    $store['students'][] = $data;
    return response()->json(['message' => 'Student added', 'student' => $data]);
});

Route::delete('/students/{id}', function ($id) {
    $store = &app('fakeData');
    foreach ($store['students'] as $index => $student) {
        if ($student['id'] == $id) {
            array_splice($store['students'], $index, 1);
            return response()->json(['message' => "Student with ID $id deleted"]);
        }
    }
    return response()->json(['error' => 'Student not found'], 404);
});

Route::patch('/students/{id}', function (Request $request, $id) {
    $store = &app('fakeData');
    foreach ($store['students'] as &$student) {
        if ($student['id'] == $id) {
            $student = array_merge($student, $request->all());
            return response()->json(['message' => 'Student updated', 'student' => $student]);
        }
    }
    return response()->json(['error' => 'Student not found'], 404);
});

// --- TEACHER ROUTES ---

Route::get('/teachers', function () {
    return response()->json(app('fakeData')['teachers']);
});

Route::post('/teachers', function (Request $request) {
    $data = $request->all();
    $store = &app('fakeData');
    foreach ($store['teachers'] as $teacher) {
        if ($teacher['id'] == $data['id']) {
            return response()->json(['error' => 'Teacher ID already exists'], 400);
        }
    }
    $store['teachers'][] = $data;
    return response()->json(['message' => 'Teacher added', 'teacher' => $data]);
});

Route::delete('/teachers/{id}', function ($id) {
    $store = &app('fakeData');
    foreach ($store['teachers'] as $index => $teacher) {
        if ($teacher['id'] == $id) {
            array_splice($store['teachers'], $index, 1);
            return response()->json(['message' => "Teacher with ID $id deleted"]);
        }
    }
    return response()->json(['error' => 'Teacher not found'], 404);
});

Route::patch('/teachers/{id}', function (Request $request, $id) {
    $store = &app('fakeData');
    foreach ($store['teachers'] as &$teacher) {
        if ($teacher['id'] == $id) {
            $teacher = array_merge($teacher, $request->all());
            return response()->json(['message' => 'Teacher updated', 'teacher' => $teacher]);
        }
    }
    return response()->json(['error' => 'Teacher not found'], 404);
});
