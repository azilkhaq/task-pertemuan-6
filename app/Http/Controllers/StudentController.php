<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Validator; 

class StudentController extends Controller
{
    public function index()
    {

        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

        if ($validator->fails()) {

            $data = [
                'message' => $validator->errors()
            ];

            return response()->json($data, 400);
        }

        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $students = Student::create([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'jurusan' => $jurusan
        ]);

        $data = [
            'message' => 'Student is created successfuly',
            'data' => $students
        ];

        return response()->json($data, 201);
    }

    function update(Request $request, $id)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $students = Student::find($id);

        if(!$students) {

            $data = [
                'message' => 'Student not found',
                'data' => $students
            ];
    
            return response()->json($data, 404);
        } 

        $students->update(
            [
                'nama' => $nama,
                'nim' => $nim,
                'email' => $email,
                'jurusan' => $jurusan
            ]
        );

        $data = [
            'message' => 'Student is updated successfuly',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    function destroy($id)
    {
        $students = Student::find($id);

        if(!$students) {

            $data = [
                'message' => 'Student not found',
                'data' => $students
            ];
    
            return response()->json($data, 404);
        } 

        $students->delete();

        $data = [
            'message' => 'Student is deleted successfuly',
            'data' => $students
        ];

        return response()->json($data, 200);
    }
}
