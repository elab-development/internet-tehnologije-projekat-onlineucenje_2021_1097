<?php

namespace App\Http\Controllers;

use App\Http\Resources\School\SchoolCollection;
use App\Http\Resources\School\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return response()->json(new SchoolCollection($schools));
    }

    public function indexPg()
    {
        $schools = School::all();
        $schools = School::paginate(5);
        return response()->json(new SchoolCollection($schools));
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
            'name' => 'required|string|max:255|unique:schools',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'founded' => 'required|integer|between:1088,2023',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $school = School::create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'founded' => $request->founded,
        ]);

        return response()->json([
            'message' => 'School created',
            'school' => new SchoolResource($school)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show($school_id)
    {
        $school = School::find($school_id);
        if (is_null($school)) {
            return response()->json('School not found', 404);
        }
        return response()->json(new SchoolResource($school));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'founded' => 'required|integer|between:1088,2023',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $school->name = $request->name;
        $school->country = $request->country;
        $school->city = $request->city;
        $school->address = $request->address;
        $school->founded = $request->founded;

        $school->save();

        return response()->json([
            'message' => 'School updated',
            'school' => new SchoolResource($school)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();

        return response()->json('School deleted');
    }
}
