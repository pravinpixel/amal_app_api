<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\EducationLevel;
use App\Models\Profession;
use App\Models\Student;
use Illuminate\Http\Request;
use Storage;
use Validator;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function list(Request $request)
    {
        try {
            $search = $request->input('search');
            $status = $request->input('status');
            $perPage = 10;
            $student = Student::query();
            if ($search) {
                $student->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phoneNumber', 'like', '%' . $search . '%');
                });
            }
            dump($status);
            if ($status) {
                $student->where('status', $status);
            }
            $result = $student->orderBy('id', 'desc')->paginate($perPage);
            return view('student.index', ['students' => $result]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
        }
    }


    public function view(Request $request, $id)
    {
        try {
            $result = Student::find($id);
            $professions = Profession::all();
            $countries = Country::all();
            $level = EducationLevel::all();
            return view('student.view', ['student' => $result, 'professions' => $professions, 'countries' => $countries, 'levels' => $level]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $result = Student::where('id', $id)->first();
            $result->delete();
            return response()->json(['status' => true, 'message' => 'Student deleted successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
        }
    }
    public function createStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tcslno' => 'required|string|max:255|unique:students,tcslno',
            'year' => 'required|string',
            'adminNo' => 'required|integer|unique:students,adminNo',
            'regNo' => 'required|integer|unique:students,regNo',
            'fatherName' => 'required|string|max:255',
            'motherName' => 'required|string|max:255',
            'leaveOfClass' => 'required|integer|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'phoneNumber' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image = $request->file('image');
            $path = $this->storeImage($image, 'profile');
        }
        $student = Student::create([
            'tcslno' => $request->tcslno,
            'year' => $request->year,
            'adminNo' => $request->adminNo,
            'regNo' => $request->regNo,
            'fatherName' => $request->fatherName,
            'motherName' => $request->motherName,
            'leaveOfClass' => $request->leaveOfClass,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'dob' => $request->dob,
            'status' => $request->status,
            'image' => $path ?? '',
        ]);

        return $this->returnSuccess($student, 'Student created successfully');
    }


    public function updateStudent(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'tcslno' => 'required|string|max:255|unique:students,tcslno,' . $id . ',id',
            'year' => 'required|string|max:255',
            'adminNo' => 'required|integer|unique:students,adminNo,' . $id . ',id',
            'regNo' => 'required|integer|unique:students,regNo,' . $id . ',id',
            'fatherName' => 'required|string|max:255',
            'motherName' => 'required|string|max:255',
            'leaveOfClass' => 'required|integer|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255,unique:students,email,' . $id . ',id',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'phoneNumber' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        $student = Student::where('id', $request->id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $this->storeImage($image, 'profile');
        }
        $student = $student->update([
            'tcslno' => $request->tcslno,
            'year' => $request->year,
            'adminNo' => $request->adminNo,
            'regNo' => $request->regNo,
            'fatherName' => $request->fatherName,
            'motherName' => $request->motherName,
            'leaveOfClass' => $request->leaveOfClass,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'dob' => $request->dob,
            'status' => $request->status,
            'image' => $path ?? '',
        ]);

        return $this->returnSuccess($student, 'Student updated successfully');
    }
    public function saveStudent(Request $request)
    {
        return view('student.action');
    }

    public function editStudent(Request $request, $id)
    {
        $result = Student::find($id);
        $professions = Profession::all();
        $countries = Country::all();
        $level = EducationLevel::all();
        return view('student.action', ['student' => $result, 'professions' => $professions, 'countries' => $countries, 'levels' => $level]);

    }
}
