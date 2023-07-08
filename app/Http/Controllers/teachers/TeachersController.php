<?php

namespace App\Http\Controllers\teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherFormRequest;
use App\Models\teachers\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //display all teachers
    public function index()
    {
        $teachers=Teacher::latest()->paginate(10);
        return view('teachers.index',['teachers'=>$teachers,]);
    }

    //create  teachers view
    public function create()
    {
        return view('teachers.create');
    }

    //Store  teachers in database
    public function store(TeacherFormRequest $request)
    {
    
        $request->validate();
        $image = time().'.'.$request->image->extension();
        $request->image->move(public_path('teachers'), $image);
        Teacher::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'middleName'=>$request->middleName,
            'teacherId'=>$request->teacherId,
            'image_url'=>$request->image,
            'courses_id'=>$request->courseId,
        ]);
        return redirect(route('teachers.index'))->with('success','Teacher created successfully');
    
    }

    //show  teacher information
    public function show($id)
    {   $teacher=Teacher::findOrfail($id);
        return view('teachers.show',[
            'teacher'=>$teacher,
        ]);
    }
    //Edit teacher page
    public function edit()
    {
        return view('teachers.edit');
    }
    //display all teachers
    public function update(TeacherFormRequest $request)
    {
        $request->validate();
    }

    //Delete teachers
    public function destroy()
    {
        return view('teachers.index');
    }
    //Search teachers
    public function searchTeacher()
    {
        return view('teachers.search');
    }
}
