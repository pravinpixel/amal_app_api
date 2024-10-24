<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\State;
use App\Models\City;
use App\Models\Designation;

class EssientialController extends Controller
{
    public function getdata(Request $request)
    {
        $states = State::where('status', 1)->get(['id', 'name']);
        // $departments = Department::where('status', 1)->get(['id', 'name']);
        // $designations = Designation::where('status', 1)->get(['id', 'name']);
        $states = $states->map(function ($state) {
            return [
                'id' => $state->id,
                'label' => $state->name,
            ];
        });
        // $departments = $departments->map(function ($department) {
        //     return [
        //          'id' => $department->id,
        //         'label' => $department->name,
        //     ];
        // });
        // $designations = $designations->map(function ($designation) {
        //     return [
        //          'id' => $designation->id,
        //         'label' => $designation->name,
        //     ];
        // });
        return $this->returnSuccess(
            [
                'states' => $states,
                // 'designations' => $designations,
                // 'departments' => $departments,
            ],
            'Essential data retrieved successfully'
        );
    }
    
    public function getCity(Request $request,$id)
    {       
      try{
        $state_id = $id;
        $cites = City::where('state_id', $state_id)->get(['id', 'name']);
        $cites = $cites->map(function ($city) {
            return [
                'id' => $city->id,
                'label' => $city->name,
            ];
        });
        return $this->returnSuccess(
            [
                'cites' => $cites,
            ],
            'City data retrieved successfully'
        );
      }catch (\Exception $e) {
        return response()->json(['status' => false, 'errors' => $e->getMessage()], 422);
      }
    }
}
