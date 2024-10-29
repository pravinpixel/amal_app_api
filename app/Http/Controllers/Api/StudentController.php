<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicDetail;
use App\Models\Country;
use App\Models\DemographicDetail;
use App\Models\Document;
use App\Models\EducationLevel;
use App\Models\Otp;
use App\Models\Profession;
use App\Models\ProfessionalDetail;
use App\Models\School;
use App\Models\SessionToken;
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
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
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

use Barryvdh\DomPDF\Facade\Pdf as PDFData;


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
                'email' => 'required|email',
                'studentId' => 'required',
            ]);
            if ($validator->fails()) {
                $this->error = $validator->errors();
                throw new \Exception('validation Error');
            }
            $student = Student::where('id', $request->studentId)->first();
            if ($student) {
                $oneMinuteAgo = Carbon::now()->subMinute();
                $oneHourAgo = Carbon::now()->subHour();
                $onemiutecount = Otp::where('email', $student->email)
                    ->where('created_at', '>=', $oneMinuteAgo)
                    ->count();
                $onehourcount = Otp::where('email', $student->email)
                    ->where('created_at', '>=', $oneHourAgo)
                    ->count();
                if ($onemiutecount < 3 && $onehourcount < 30) {
                    $otp = $this->generateOtp($student->id);
                    $student->otp = $otp;
                    $data = explode('@', $student->email);
                    Mail::to($student->email)->send(new EmailVerfiy($otp, $data[0]));
                    $student->otpExpiredDate = Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s');
                    $student->save();
                    $otpstore = new Otp();
                    $otpstore->studentId = $student->id;
                    $otpstore->email = $student->email;
                    $otpstore->otp = $student->otp;
                    $otpstore->save();
                } else {
                    return $this->returnError('Your otp limit reached.Please try after somethime.');
                }

            } else {
                return $this->returnError('Invalid student id');
            }
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


    // Usage example:


    public function otpverify(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate request inputs
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'otp' => 'required|size:4',
            ]);

            if ($validator->fails()) {
                $this->error = $validator->errors();
                Log::error('Validation Error: ' . json_encode($validator->errors()));
                throw new \Exception('Validation Error');
            }
            $student = Student::where('email', $request->email)->first();
            if (!$student) {
                Log::error('Student not found for email: ' . $request->email);
                return $this->returnError('Student not found');
            }
            // if (Carbon::parse($student->otpExpiredDate)->lt(Carbon::now())) {
            //     Log::error('OTP has expired for email: ' . $request->email);
            //     return $this->returnError('OTP has expired');
            // }
            // if ($student->otp == $request->otp) {
            if ($student->otp == 1111) {
                $student->otpVerified = 1;
                $student->save();
                $newToken = JWTAuth::fromUser($student);
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

    public function studentlogout()
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
        $schoolId = $request->filled('schoolId') ? $request->get('schoolId') : null;
        if ($name && $dob && $schoolId) {
            $student = Student::where(['name' => $name, 'dob' => $dob, 'schoolId' => $schoolId])->get();
            if (count($student)) {
                return $this->returnSuccess($student, 'Student Retrived Successfully');
            } else {
                $students = Student::where(['schoolId' => $schoolId, 'dob' => $dob])->where('name', 'like', '%' . $name . '%')->get();
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

    public function addAcademicDetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'studentId' => 'required|integer|exists:students,id',
                'details' => 'required|array',
                'details.*.id' => 'nullable|integer|exists:academic_details,id',
                'details.*.pursuing' => 'required|boolean',
                'details.*.level' => 'required|string|max:100',
                'details.*.institutionName' => 'required|string|max:100',
                'details.*.course' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return $this->returnError($validator->errors());
            }
            $student = Student::where('id', $request->studentId)->first();
            if (!$student) {
                return $this->returnError('Student Not Found');
            }
            foreach ($request->details as $detail) {
                if (isset($detail['id']) && (int) $detail['id']) {
                    $academicDetail = AcademicDetail::where(['studentId' => $request->studentId, 'id' => $detail['id']])->first();
                    if ($academicDetail) {
                        $academicDetail->update([
                            'pursuing' => $detail['pursuing'],
                            'level' => $detail['level'],
                            'institutionName' => $detail['institutionName'],
                            'course' => $detail['course'],
                        ]);
                    }
                } else {
                    $academicDetail = AcademicDetail::create([
                        'studentId' => $request->studentId,
                        'pursuing' => $detail['pursuing'],
                        'level' => $detail['level'],
                        'institutionName' => $detail['institutionName'],
                        'course' => $detail['course'],
                    ]);
                }

                return $this->returnSuccess($student, 'Academic Detail Added Successfully');
            }

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }

    }

    public function addProfessionalDetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'studentId' => 'required|integer|exists:students,id',
                'details' => 'required|array',
                'details.*.id' => 'nullable|integer|exists:professional_details,id',
                'details.*.type' => 'required|string|max:100',
                'details.*.organisation' => 'required|string|max:100',
                'details.*.designation' => 'required|string|max:100',
                'details.*.experience' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return $this->returnError($validator->errors());
            }
            $student = Student::where('id', $request->studentId)->first();
            if (!$student) {
                return $this->returnError('Student Not Found');
            }
            foreach ($request->details as $detail) {
                if (isset($detail['id']) && (int) $detail['id']) {
                    $professionalDetail = ProfessionalDetail::where(['studentId' => $request->studentId, 'id' => $detail['id']])->first();
                    if ($professionalDetail) {
                        $professionalDetail->update([
                            'type' => $detail['type'],
                            'organisation' => $detail['organisation'],
                            'designation' => $detail['designation'],
                            'experience' => $detail['experience'],
                        ]);
                    }
                } else {
                    $professionalDetail = ProfessionalDetail::create([
                        'studentId' => $request->studentId,
                        'type' => $detail['type'],
                        'organisation' => $detail['organisation'],
                        'designation' => $detail['designation'],
                        'experience' => $detail['experience'],
                    ]);
                }
            }
            return $this->returnSuccess($professionalDetail, 'Professional Detail Added Successfully');

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function addDemographicDetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'studentId' => 'required|integer|exists:students,id',
                'residingInIndia' => 'required|integer',
                'addressLine1' => 'required|string|max:255',
                'addressLine2' => 'required|string|max:255',
                'countryId' => 'required|integer',
                'postalcode' => 'required|string|max:10',
            ]);

            if ($validator->fails()) {
                return $this->returnError($validator->errors());
            }
            $demographicDetail = DemographicDetail::where('studentId', $request->studentId)->first();
            if ($demographicDetail) {
                $demographicDetail->update([
                    'residingInIndia' => $request->residingInIndia,
                    'addressLine1' => $request->addressLine1,
                    'addressLine2' => $request->addressLine2,
                    'countryId' => $request->countryId,
                    'postalcode' => $request->postalcode,
                ]);
                return $this->returnSuccess($demographicDetail, 'Demographic Detail Updated Successfully');
            } else {
                $demographicDetail = DemographicDetail::create([
                    'studentId' => $request->studentId,
                    'residingInIndia' => $request->residingInIndia,
                    'addressLine1' => $request->addressLine1,
                    'addressLine2' => $request->addressLine2,
                    'countryId' => $request->countryId,
                    'postalcode' => $request->postalcode,
                ]);
                return $this->returnSuccess($demographicDetail, 'Demographic Detail Added Successfully');
            }
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function addDocuments(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'studentId' => 'required|integer|exists:students,id',
                'profileImage' => 'nullable',
                'documents' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return $this->returnError($validator->errors());
            }
            $student = Student::where('id', $request->studentId)->first();
            if (!$student) {
                return $this->returnError('Student Not Found');
            }
            if ($request->hasFile('profileImage')) {
                $image = $request->file('profileImage');
                $image = $request->file('profileImage');
                $path = $this->storeImage($image, 'profile');
                $student->image = $path;
                $student->save();
            }

            if ($request->hasFile('documents')) {
                for ($i = 0; $i < sizeof($request->documents); $i++) {
                    $documents[$i] = $this->storeDocument(
                        $request->file('documents')[$i],
                        'documents'
                    );
                    $document = Document::create([
                        'studentId' => $request->studentId,
                        'document' => $documents[$i],
                    ]);
                }
            }
            DB::commit();
            return $this->returnSuccess([], 'Document Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnError($e->getMessage());
        }
    }

    public function getEssentials(Request $request)
    {
        $type = $request->get('type');
        if ($type == 'school') {
            $school = School::get();
            return $this->returnSuccess($school, 'School Retrived Successfully');
        } else if ($type == 'country') {
            $country = Country::get();
            return $this->returnSuccess($country, 'Country Retrived Successfully');
        } else if ($type == 'profession') {
            $profession = Profession::get();
            return $this->returnSuccess($profession, 'Profession Retrived Successfully');
        } else if ($type == 'level') {
            $level = EducationLevel::get();
            return $this->returnSuccess($level, 'Education Level Retrived Successfully');
        } else {
            return $this->returnError('Type Not Found');
        }
    }

    public function generateSessionToken(Request $request)
    {
        $sessionToken = Str::random(60);
        $expiresAt = Carbon::now()->addMinutes(5); // Token expires in 120 minutes
        $session = SessionToken::create([
            'token' => $sessionToken,
            'expiry' => $expiresAt
        ]);
        return $this->returnSuccess($session, 'Session Token Generated Successfully');
    }

    public function createIdcard(Request $request, $id)
    {
        $student = Student::where('id', $id)->first();
        if (!$student) {
            return $this->returnError('Student Not Found');
        }

        $pdf = PDFData::loadView('pdf.idcard', ['student' => $student]);

        return $pdf->download('student_idcard.pdf');
    }

}
