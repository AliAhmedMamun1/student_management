<?php

namespace App\Http\Controllers\backend;

use App\Model\Syllabus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syllabuses = Syllabus::all();
        return view('backend.syllabuses.manage_syllabus', ['syllabuses' =>$syllabuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.syllabuses.create_syllabus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $syllabues = new Syllabus();
        $syllabues->syllabus_name = $request->input('syllabus_name');
        $syllabues->description = $request->input('description');
        $syllabues->status = $request->input('status');
        $syllabues->save();
        return redirect()->route('syllabus.create')->with('message', "Syllabus Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['syllabus'] = Syllabus::find($id);
        return view('backend.syllabuses.edit_syllabus', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $semester = Syllabus::find($id);
        $semester->syllabus_name = $request->input('syllabus_name');
        $semester->description = $request->input('description');
        $semester->status = $request->input('status');
        $semester->save();
        return redirect()->route("syllabus.index", $id)->with('message', "Syllabus Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syllabus = Syllabus::find($id);
        $syllabus->delete();
        return redirect()->route('syllabus.index')->with('message', "Syllabus Deleted Successfully");
    }

    public  function  changeStatus(Request $request){

        $syllabus =  Syllabus::find($request->id);
        $syllabus->status = !$syllabus->status;
        $syllabus->save();
        return redirect()->route('semester.index');

    }
}