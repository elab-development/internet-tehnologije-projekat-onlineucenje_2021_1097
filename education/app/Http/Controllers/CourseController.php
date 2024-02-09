<?php

namespace App\Http\Controllers;

use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json(new CourseCollection($courses));
    }

    public function indexPg()
    {
        $courses = Course::all();
        $courses = Course::paginate(5);
        return response()->json(new CourseCollection($courses));
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
            'description' => 'required|string|max:255',
            'professor' => 'required|string|max:255',
            'school_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $school = School::find($request->school_id);
        if (is_null($school)) {
            return response()->json('Wrong input for school id', 404);
        }

        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'professor' => $request->professor,
            'school_id' => $request->school_id,
        ]);

        return response()->json([
            'message' => 'Course created',
            'course' => new CourseResource($course)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($course_id)
    {
        $course = Course::find($course_id);
        if (is_null($course)) {
            return response()->json('Course not found', 404);
        }
        return response()->json(new CourseResource($course));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'professor' => 'required|string|max:255',
            'school_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $school = School::find($request->school_id);
        if (is_null($school)) {
            return response()->json('Wrong input for school id', 404);
        }

        $course->name = $request->name;
        $course->description = $request->description;
        $course->professor = $request->professor;
        $course->school_id = $request->school_id;

        $course->save();

        return response()->json([
            'message' => 'Course updated',
            'course' => new CourseResource($course)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json('Course deleted');
    }
}
