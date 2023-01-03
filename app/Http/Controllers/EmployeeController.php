<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use App\Http\Requests\EmployeeValidator;
use Datatables;
use App\Services\UploadImageService;
use App\Http\Resources\EmployeeResource;
class EmployeeController extends Controller
{
    public function index(Request $request)
        {
             $companies = Company::all();
             return view('Employee.index', compact('companies'));
        } 
        /**
            * Store a newly created resource in storage.
            *
            * @return Response
            */
        public function store(EmployeeValidator $request)
        {
            $validated = $request->validated();
            if($validated)
            {
                $uploadImage = new UploadImageService();
                $url = $uploadImage->Upload($request->file('image'));
                Employee::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'image' => $url,
                    'company_id' => $request->company_id
                ]);   
            }
            return redirect()->route('employee.index');
        }
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function filter(Request $request)
        {          
                $all = Employee::where('company_id',$request->company_id)->with('company')->get();
             $employees =EmployeeResource::collection($all);
            if ($request->ajax()) {
                return Datatables::of($employees)
                ->addColumn('image', function($employees){
                    return '<img class="w-25" src="'.$employees['image'].'"/>';
             })
             ->rawColumns(['image'])
             ->make(true);
            }
            return  redirect()->back();;
        }
    
        /**
            * Update the specified resource in storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function update($id)
        {
            //
        }
    
        /**
            * Remove the specified resource from storage.
            *
            * @param  int  $id
            * @return Response
            */
        public function destroy($id)
        {
            //
        }
}
