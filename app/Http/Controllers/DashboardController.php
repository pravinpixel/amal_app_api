<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $students = Student::get();
        return view('dashboard', $students);
    }

}
