<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->count() > 0) {

            # code...
            return response()->json([
                'status' => 200,
                'students' => $students,
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 404,
                'message' => 'data tidak ditemukan',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            # code...
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            # code...
            $students = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if ($students) {

                # code...
                return response()->json([
                    'status' => 200,
                    'message' => "Tambah data Berhasil"
                ], 200);
            } else {

                # code...
                return response()->json([
                    'status' => 500,
                    'message' => "Tambah data gagal"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {

            # code...
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 404,
                'message' => "Data siswa tidak ditemukan"
            ], 404);
        }
    }

    public function edit($id)
    {
        $student = Student::find($id);

        if ($student) {

            # code...
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 404,
                'message' => "Data siswa tidak ditemukan"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if ($validator->fails()) {

            # code...
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            # code...
            $students = Student::find($id);

            if ($students) {

                # code...
                $students->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "edit data Berhasil"
                ], 200);
            } else {

                # code...
                return response()->json([
                    'status' => 404,
                    'message' => "Data gagal ditemukan"
                ], 404);
            }
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {

            # code...
            $student->delete();

            return response()->json([
                'status' => 200,
                'message' => "Data Berhasil diHapus"
            ], 200);
        } else {

            # code...
            return response()->json([
                'status' => 404,
                'message' => "Data siswa tidak ditemukan"
            ], 404);
        }
    }
}
