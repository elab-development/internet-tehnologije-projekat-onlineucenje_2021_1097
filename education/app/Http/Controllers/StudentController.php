<?php

namespace App\Http\Controllers;

use App\Exports\StudentExport;
use App\Http\Resources\Student\StudentCollection;
use App\Http\Resources\Student\StudentResource;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CSV;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(new StudentCollection($students));
    }

    public function indexPg()
    {
        $students = Student::all();
        $students = Student::paginate(10);
        return response()->json(new StudentCollection($students));
    }

    public function exportCSV()
    {
        return CSV::download(new StudentExport, 'student-records.csv');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth' => 'required|integer|between:1950,2005',
            'course_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $course = Course::find($request->course_id);
        if (is_null($course)) {
            return response()->json('Wrong input for course id', 404);
        }

        $student = Student::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'course_id' => $request->course_id,
        ]);

        return response()->json([
            'message' => 'Student created',
            'student' => new StudentResource($student)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        $student = Student::find($student_id);
        if (is_null($student)) {
            return response()->json('Student not found', 404);
        }
        return response()->json(new StudentResource($student));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth' => 'required|integer|between:1950,2005',
            'course_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $course = Course::find($request->course_id);
        if (is_null($course)) {
            return response()->json('Wrong input for course id', 404);
        }

        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->birth = $request->birth;
        $student->course_id = $request->course_id;

        $student->save();

        return response()->json([
            'message' => 'Student updated',
            'student' => new StudentResource($student)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json('Student deleted');
    }
}
