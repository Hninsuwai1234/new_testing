<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
       // returns("This is Student");
       $student = student::all();
      // dd($student->toArray());
      if($student->count() >0){
        return response()->json([
           
            'status'=>200,
            'students'=>$student,
        ],200);
      }else{
        return response()->json([
            
            'status'=>404,
            'message'=>'Status Not Found'
        ],404);
      }
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=> 'required',
            'course'=>'required',
            'email'=> 'required',
            'phone'=>'required',
            

        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);

        }else{
            $student=student::create([
                'name'=>$request->name,
                'course'=>$request->course,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ]);
        }
        if($student){
            return response()->json([
                'data'=>$student,
                'status'=>200,
                'message'=>'Student Created',
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>'Something Wrong',
            ],500);
        }

    }

    public function show($id){
$student=student::find($id);
if($student){
    return response()->json([
        'status'=>200,
        'message'=>$student
    ],200);
}else{
    return response()->json([
        'status'=>404,
        'message'=>'There is no such data'
    ],404);
}
    }

    public function edit($id){
        $student=student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'message'=>$student
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'There is no such data'
            ],404);
        }
    }
    public function update(Request $request , $id){
        $validator=Validator::make($request->all(),[
            'name'=> 'required',
            'course'=>'required',
            'email'=> 'required',
            'phone'=>'required',
            

        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);

        }else{
            $student=student::find($id);
            $student->update([
                'name'=>$request->name,
                'course'=>$request->course,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ]);
        }
        if($student){
            return response()->json([
                'status'=>200,
                'message'=>$student,
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>'Something Wrong',
            ],500);
        }

    }

    public function delete($id){
        $student=student::find($id);
        if($student){
           $student->delete();
        }else{
            return response()->json([
                'status'=>500,
                'message'=>'Something Wrong',
            ],500);
        }
    }
}
