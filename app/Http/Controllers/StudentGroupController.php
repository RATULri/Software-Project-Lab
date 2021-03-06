<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\StudentGroup;
use App\Http\Resources\StudentGroup as StudentGroupResource;
use App\Student;
use App\User;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $studentgroup = StudentGroup::where('id', $request->id)->first();

        if($studentgroup == null){
            $studentgroup = new StudentGroup;
            $studentgroup->student_id = $request->student_id;
            $studentgroup->group_id = $request->group_id;
            $studentgroup->active = $request->active;

            if($studentgroup->save()){

                $data['message'] = "Inserted";
                $data['status'] = 1;

                return json_encode($data);
                

            }
            else{
                
                $data['message'] = "Not Inserted";
                $data['status'] = 0;

                return json_encode($data);

            }
        }
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
    
    public function getStudentByGroupId(Request $request){
        $students = StudentGroup::where('group_id',$request->group_id)->get();

        if($students != null){
            
            $data['message'] = "Found";
            $data['status'] = 1;

            foreach ($students as $key=>$student) {
                $data['student'][$key]['student_info'] = Student::find($student->student_id);
             //   $data['student'][$key]['user_info'] = User::find($student->$student_id);
            }
            return json_encode($data);
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $studentgroup = StudentGroup::find($request->id);

        if($studentgroup != null){
            $studentgroup = StudentGroup::where('id', $request->id)->first();
            $studentgroup->student_id = $request->student_id;
            $studentgroup->group_id = $request->group_id;
            $studentgroup->active = $request->active;

            if($studentgroup->save()){

                $data['message'] = "updated";
                $data['status'] = 1;

                return json_encode($data);
                

            }
            else{
                
                $data['message'] = "update failed";
                $data['status'] = 0;

                return json_encode($data);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
