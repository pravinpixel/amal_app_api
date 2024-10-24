<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerfiy;
use App\Mail\Thankyou;
use OTPHP\TOTP;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\GenarateOtp;
use Tymon\JWTAuth\Token;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class StudentController extends Controller
{
    public function view(Request $request)
    {
        try {
            $student = Student::all();
            return response()->json(['message' => 'Student data', 'data' => $student]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
        }
    }
    public function emailverfiy(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(starhealth|starinsurance)\.in$|^[a-zA-Z0-9._%+-]+@pixel-studios\.com$/'
                ],
                'token' => 'required|unique:employees',
            ]);
            if ($validator->fails()) {
                $this->error = $validator->errors();
                throw new \Exception('validation Error');
            }
            $student = Student::where('email', $request->email)->first();
            if ($student) {
                if ($student->status == "completed" && $student->profile_photo != null && $student->passport_photo != null) {
                    return $this->returnError(false, 'We had already received your entry and it is in review now', 400, 400);
                }
                $oneMinuteAgo = Carbon::now()->subMinute();
                $oneHourAgo = Carbon::now()->subHour();

                // Count OTPs generated within the last minute
                $onemiutecount = GenarateOtp::where('email', $student->email)
                    ->where('created_at', '>=', $oneMinuteAgo)
                    ->count();

                // Count OTPs generated within the last hour
                $onehourcount = GenarateOtp::where('email', $student->email)
                    ->where('created_at', '>=', $oneHourAgo)
                    ->count();
                if ($onemiutecount < 3 && $onehourcount < 30) {
                    $otp = $this->generateOtp($student->id);
                    $student->session_token = $request->token;
                    $student->save();
                    $data = explode('@', $student->email);
                    Mail::to($student->email)->send(new EmailVerfiy($otp, $data[0]));
                    $student = student::find($student->id);
                    $student->expired_date = Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s');
                    $student->save();
                    $otpstore = new GenarateOtp();
                    $otpstore->email = $student->email;
                    $otpstore->otp = $student->otp;
                    $otpstore->save();
                } else {
                    return $this->returnError('Your otp limit reached.Please try after somethime.');
                }

            } else {
                $employee = new Student();
                $employee->email = $request->input('email');
                $employee->session_token = $request->token;
                $employee->save();
                $otp = $this->generateOtp($employee->id);
                $data = explode('@', $employee->email);
                Mail::to($employee->email)->send(new EmailVerfiy($otp, $data[0]));
                $employee = Student::find($employee->id);
                $employee->expired_date = Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s');
                $employee->save();
                $otpstore = new GenarateOtp();
                $otpstore->email = $employee->email;
                $otpstore->otp = $employee->otp;
                $otpstore->save();
            }
            LogHelper::AddLog('Employee', $employee->id, 'Otp Send', $otp, 'OTP genarate this ' . $employee->email);
            return $this->returnSuccess(
                [],
                'OTP send successfully'
            );
        } catch (\Throwable $e) {
            return $this->returnError($this->error ?? $e->getMessage());
        }
    }
    public static function generateOtp($id)
    {
        $totp = TOTP::create();
        $secret_key = $totp->getSecret();
        $timestamp = time();
        $otp = TOTP::create($secret_key);
        $otp->setDigits(4);
        $code = $otp->at($timestamp);
        $student = Student::find($id);
        $student->otp = $code;
        $student->save();
        return $code;
    }
    public function resendOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(starhealth|starinsurance)\.in$|^[a-zA-Z0-9._%+-]+@pixel-studios\.com$/'
                ],
                'token' => 'required|unique:employees',
            ]);
            if ($validator->fails()) {
                $this->error = $validator->errors();
                throw new \Exception('validation Error');
            }
            $employee = Employee::where('email', $request->email)->first();
            if ($employee->session_token != $request->token) {
                Log::error('Session token mismatch for email: ' . $request->email);
                return $this->returnError('Session token is wrong');
            }
            if ($employee) {
                $oneMinuteAgo = Carbon::now()->subMinute();
                $oneHourAgo = Carbon::now()->subHour();

                // Count OTPs generated within the last minute
                $onemiutecount = GenarateOtp::where('email', $employee->email)
                    ->where('created_at', '>=', $oneMinuteAgo)
                    ->count();

                // Count OTPs generated within the last hour
                $onehourcount = GenarateOtp::where('email', $employee->email)
                    ->where('created_at', '>=', $oneHourAgo)
                    ->count();

                if ($onemiutecount < 3 && $onehourcount < 30) {
                    $otp = $this->generateOtp($employee->id);
                    $employee->save();
                    $data = explode('@', $employee->email);
                    Mail::to($employee->email)->send(new EmailVerfiy($otp, $data[0]));
                    $employee = Employee::find($employee->id);
                    $employee->expired_date = Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s');
                    $employee->save();
                    $otpstore = new GenarateOtp();
                    $otpstore->email = $employee->email;
                    $otpstore->otp = $employee->otp;
                    $otpstore->save();
                    LogHelper::AddLog('Employee', $employee->id, 'Otp Send', $otp, ' Resend OTP genarate this ' . $employee->email);
                } else {
                    return $this->returnError('Your otp limit reached.Please try after somethime.');
                }
            } else {
                return $this->returnError('Employee not found');
            }
            return $this->returnSuccess(
                [],
                'Resend OTP send successfully'
            );
        } catch (\Throwable $e) {
            return $this->returnError($this->error ?? $e->getMessage());
        }
    }

    // Usage example:


    public function otpverfiy(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate request inputs
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@(starhealth|starinsurance)\.in$|^[a-zA-Z0-9._%+-]+@pixel-studios\.com$/'
                ],
                'otp' => 'required|size:4',
                'token' => 'required',
            ]);

            if ($validator->fails()) {
                $this->error = $validator->errors();
                Log::error('Validation Error: ' . json_encode($validator->errors()));
                throw new \Exception('Validation Error');
            }

            // Fetch the employee by email
            $employee = Employee::where('email', $request->email)->first();
            if (!$employee) {
                Log::error('Employee not found for email: ' . $request->email);
                return $this->returnError('Employee not found');
            }

            // Check if OTP has expired
            if (Carbon::parse($employee->expired_date)->lt(Carbon::now())) {
                Log::error('OTP has expired for email: ' . $request->email);
                return $this->returnError('OTP has expired');
            }

            if ($employee->session_token != $request->token) {
                Log::error('Session token mismatch for email: ' . $request->email);
                return $this->returnError('Session token is wrong');
            } else {
                $employee->session_token = null;
            }

            // Verify OTP
            if ($employee->otp == $request->otp) {
                $employee->otp_verified = true;
                if (!$employee->status) {
                    $employee->status = 'basic';
                }

                // Invalidate old token if exists
                if ($employee->token) {
                    try {
                        $token = new Token($employee->token);
                        JWTAuth::setToken($token)->invalidate(true);
                        Log::info('Token invalidated successfully for email: ' . $request->email);
                    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                        Log::error('Token invalidation error for email: ' . $request->email . ' - ' . $e->getMessage());
                        // Handle the case where token is already invalid
                        // You can choose to continue or return an error response
                    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                        Log::error('Token expiration error for email: ' . $request->email . ' - ' . $e->getMessage());
                        // Handle token expired case
                        // Set token to null after expiry
                        $employee->token = null;
                    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                        Log::error('JWT Exception for email: ' . $request->email . ' - ' . $e->getMessage());
                        return $this->returnError('JWT Exception: ' . $e->getMessage());
                    } catch (\Exception $e) {
                        Log::error('General Exception during token invalidation for email: ' . $request->email . ' - ' . $e->getMessage());
                        return $this->returnError('General Exception: ' . $e->getMessage());
                    }
                    // Regardless of success or failure, set token to null
                    $employee->token = null;
                }

                // Generate new token
                $newToken = JWTAuth::fromUser($employee);
                $employee->token = $newToken;

                // Save employee data
                $employee->save();

                DB::commit();
                Log::info('OTP verified and new token generated for email: ' . $request->email);
                return $this->respondWithToken($newToken);
            } else {
                DB::rollback();
                Log::error('Invalid OTP entered for email: ' . $request->email);
                return $this->returnError('Enter Valid OTP');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error('Exception in otpverfiy: ' . $e->getMessage());
            return $this->returnError($e->getMessage());
        }
    }


    public function createRandomToken(Request $request)
    {
        try {

            // ...
            $token = Str::random(60);

            return $this->returnSuccess([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 120
            ], 'Random token create sucessfully');
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            // Log the exception for debugging
            Log::error('JWT Exception: ' . $e->getMessage());

            return response()->json(['error' => 'Could not create token.'], 500);
        }
    }

    protected function respondWithToken($token)
    {
        return $this->returnSuccess([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL()
        ], 'OTP verified successfully.');
    }
    public function getEmployee()
    {
        $user = Auth::guard('api')->user();
        if ($user->state) {
            $state = [
                [
                    'id' => $user->state_id ?? null,
                    'label' => $user->state
                ]
            ];
            $user->state = $state;
        }
        return $this->returnSuccess($user, 'Employee data successfully retrieved');
    }

    public function employeelogout()
    {
        try {
            // Invalidate the token
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->returnSuccess([], 'Successfully logged out');
        } catch (JWTException $e) {
            return $this->returnError('Failed to log out, please try again.');
        }
    }

    public function createStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'phoneNumber' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'dob' => $request->dob,
            'status' => $request->status,
        ]);

        return $this->returnSuccess($student, 'Student created successfully');
    }

    public function getStudentDetails(Request $request)
    {
        $name = $request->filled('name') ? $request->get('name') : null;
        $dob = $request->filled('dob') ? $request->get('dob') : null;
        if ($name && $dob) {
            $student = Student::where(['name' => $name, 'dob' => $dob])->get();
            if (count($student)) {
                return $this->returnSuccess($student, 'Student Retrived Successfully');
            } else {
                $students = Student::where('dob', $dob)->where('name', 'like', '%' . $name . '%')->get();
                return $this->returnSuccess($students, 'Students Retrived Successfully');
            }
        } else {
            return $this->returnError("Name and Dob required");
        }

    }


    public function uploadStudentData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = [];
        $errors = [];
        $errorsData = [];
        $itemsAdded = 0;
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $data[] = $rowData;
        }
        for ($i = 1; $i < count($data); $i++) {
            if (!empty($data[$i][0])) {
                try {
                    $alreadyExist = Student::where('tcslno', $data[$i][1])->first();
                    if ($alreadyExist) {
                        array_push($errorsData, [$data[$i][0] => "Student Already Exist"]);
                        continue;
                    }
                    if (is_string($data[$i][6])) {
                        $errors[] = [$data[$i][0] => "Date Format Invalid"];
                        continue;
                    }
                    $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data[$i][6]);
                    $studentData = [
                        'tcslno' => $data[$i][1] ?? '',
                        'year' => $data[$i][2],
                        'adminNo' => $data[$i][3] ?? null,
                        'regNo' => $data[$i][4] ?? null,
                        'name' => $data[$i][5],
                        'dob' => $date->format('Y-m-d'),
                        'fatherName' => $data[$i][7],
                        'gender' => $data[$i][8],
                        'leaveOfClass' => $data[$i][9],
                        'motherName' => $data[$i][10],
                    ];
                    $student = Student::create($studentData);
                    $itemsAdded += 1;
                } catch (\Exception $e) {
                    array_push($errors, [$data[$i][0] => $e->getMessage()]);
                }
            }
        }
        return response()->json(['status' => true, 'message' => 'Student data uploaded successfully', 'itemsAdded' => $itemsAdded, 'errors' => $errors, 'alreadyExist' => $errorsData]);
    }


}
