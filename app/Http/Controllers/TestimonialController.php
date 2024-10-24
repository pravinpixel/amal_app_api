<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use App\Models\State;
use App\Models\Insurance;
use App\Models\Language;
use App\Models\TestimonialCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class TestimonialController extends Controller
{
    public function list(Request $request)
    {
      $search = $request->input('search');
      $insurance_type = $request->input('insurance_type');
      $state = $request->input('state');
      $language = $request->input('language');
      $testimonial_category = $request->input('testimonial_category');
      $perPage = 10;
      $query = Testimonial::query();
      if ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('age', 'like', '%' . $search . '%')
            ->orWhere('language', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('state', 'like', '%' . $search . '%')
            ->orWhere('testimonial_category', 'like', '%' . $search . '%')
            ->orWhere('insurance_type', 'like', '%' . $search . '%');
        });
      }
      if ($insurance_type) {
        $query->where('insurance_type', $insurance_type);
      }
      if ($state) {
        $query->where('state', $state);
      }
      if ($language) {
        $query->where('language', $language);
      }
      if ($testimonial_category) {
        $query->where('testimonial_category', $testimonial_category);
      }
      $testimonials = $query->orderBy('id', 'desc')->paginate($perPage);
      $currentPage = $testimonials->currentPage();
      $states = State::where('status', 1)->get(['id', 'name']);
      $insurances = Insurance::where('status', 1)->get(['id', 'name']);
      $languages = Language::get(['id', 'name']);
      $testimonialCategoryes = TestimonialCategory::get(['id', 'name']);
      $serialNumberStart = ($currentPage - 1) * $perPage + 1;
      return view('testimonial.index', [
        'testimonials' => $testimonials,
        'search' => $search,
        'states' => $states,
        'languages' => $languages,
        'testimonialCategoryes' => $testimonialCategoryes,
        'insurances' => $insurances,
        'serialNumberStart' => $serialNumberStart,
      ]);
    }
    public function create(Request $request)
    { 
       $states = State::where('status', 1)->get(['id', 'name']);
       $insurances = Insurance::where('status', 1)->get(['id', 'name']);
       $languages = Language::get(['id', 'name']);
       $testimonialCategoryes = TestimonialCategory::get(['id', 'name']);
      return view('testimonial.action',
      ['states' => $states,
      'insurances' => $insurances,
      'testimonialCategoryes' => $testimonialCategoryes,
      'languages' => $languages
    ]);
    }
    public function save(Request $request)
        {
      try{
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required|max:2',
            'state' =>'required',
            'insurance_type' => 'required',
            'testimonial_category' => 'required',
            'language'=>'required',
            'title'=>'required',
           'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=50,height=50',
            'video_url'=>'required|url',
            'status'=>'required'
          ],[
            'name.required' => 'Customer name is required ',
            'age.required' => 'Customer age is required',
          ]);
        if($validator->fails()) {
            $this->error = $validator->errors();
            throw new \Exception('validation Error');
        }
          $testimonial=new Testimonial;
          $testimonial->name=$request->input('name');
          $testimonial->age=$request->input('age');
          $testimonial->state=$request->input('state');
          $testimonial->insurance_type=$request->input('insurance_type');
          $testimonial->testimonial_category=$request->input('testimonial_category');
          $testimonial->language=$request->input('language'); 
          $testimonial->title=$request->input('title'); 
          $testimonial->video_url=$request->input('video_url'); 
          $testimonial->status=$request->input('status'); 
        //   if ($request->file('image')) {
        //                 $image=$request->image;
        //                 $fileName = "customer_image_" . uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
        //                 $filePath = 'customer/' . $fileName;
        //                 Storage::disk('s3')->put($filePath, file_get_contents($image));
        //                 $testimonial->image = $filePath;
        //   }
        if ($request->hasFile('image')) {
          $imageFile = $request->file('image');
          $image = Image::read($imageFile->getRealPath());
          $image->resize(50, 50);
          $fileName = "image_" . uniqid() . "_" . time() . "." . $imageFile->extension();
          $path = storage_path('app/public/customer/' . $fileName);
          $image->save($path);
          $testimonial->image = 'customer/' . $fileName;
        }
          $testimonial->save();    
          return $this->returnSuccess(
            [],'Testimonial Create successfully');
        } catch (\Exception $e) {
            return $this->returnError($this->error ?? $e->getMessage());
        }
    }
    public function view(Request $request,$id)
      {
        $testimonial=Testimonial::find($id);
        return view('testimonial.view',['testimonial'=>$testimonial]);
    }
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'age' => 'required',
                'state' => 'required',
                'insurance_type' => 'required',
                'testimonial_category' => 'required',
                'language' => 'required',
                'title' => 'required',
                'video_url' => 'required|url',
                'status' => 'required'
            ], [
                'name.required' => 'Customer name is required ',
                'age.required' => 'Customer age is required',
            ]);
    
            if ($validator->fails()) {
                $this->error = $validator->errors();
                throw new \Exception('Validation Error');
            }
    
            $id = $request->id;
            $testimonial = Testimonial::find($id);
            $testimonial->name = $request->input('name');
            $testimonial->age = $request->input('age');
            $testimonial->state = $request->input('state');
            $testimonial->insurance_type = $request->input('insurance_type');
            $testimonial->testimonial_category = $request->input('testimonial_category');
            $testimonial->language = $request->input('language');
            $testimonial->title = $request->input('title');
            $testimonial->video_url = $request->input('video_url');
            $testimonial->status = $request->input('status');
    
            if ($request->hasFile('image')) {
                $validator = Validator::make($request->all(), [
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:width=50,height=50',
                ]);
    
                if ($validator->fails()) {
                    $this->error = $validator->errors();
                    throw new \Exception('Validation Error');
                }
                if ($testimonial->image) {
                    $data = explode('storage/', $testimonial->image);
                    if (file_exists(storage_path('/app/public/' . $data[1]))) {
                        unlink(storage_path('/app/public/' . $data[1]));
                    }
                }
    
                $imageFile = $request->file('image');
                $image = Image::read($imageFile->getRealPath());
                $image->resize(50, 50);
                $fileName = "image_" . uniqid() . "_" . time() . "." . $imageFile->extension();
                $path = storage_path('app/public/customer/' . $fileName);
                $image->save($path);
                $testimonial->image = 'customer/' . $fileName;
            }
    
            $testimonial->save();
    
            return $this->returnSuccess([], 'Testimonial updated successfully');
        } catch (\Exception $e) {
            return $this->returnError($this->error ?? $e->getMessage());
        }
    }
    
    
    public function delete(Request $request,$id)
    {
      try{
        $testimonial=Testimonial::find($id)->delete();
        return response()->json(['message' => 'Testimonial deleted successfully']);
      }catch (\Exception $e) {
      return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
      }

    }
    public function Getone(Request $request,$id)
      {
        $testimonial=Testimonial::find($id);
        $states=State::where('status', 1)->get();
        $languages = Language::get(['id', 'name']);
        $insurances = Insurance::where('status', 1)->get(['id', 'name']);
        $testimonialCategoryes = TestimonialCategory::get(['id', 'name']);
        return view('testimonial.action',
        [
          'testimonial'=>$testimonial,
          'states'=>$states,
          'languages'=>$languages,
          'testimonialCategoryes'=>$testimonialCategoryes,
          'insurances'=>$insurances
      ]);
    }
}
