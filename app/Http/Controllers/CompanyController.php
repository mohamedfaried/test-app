<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use Datatables;
use App\Services\UploadImageService;
use App\Http\Requests\CompanyValidator;
use App\Http\Resources\CompanyResource;
class CompanyController extends Controller
{
         /**
        * Display a listing of the resource.
        *
        * @return Response
        */
        public function index(Request $request)
        {
            $all = Company::all();
             $companies =CompanyResource::collection($all);
            if ($request->ajax()) {
                return Datatables::of($companies)
                ->addColumn('logo', function($companies){
                    return '<img class="w-25" src="'.$companies['logo'].'"/>';
             })
             ->rawColumns(['logo'])
             ->make(true);
            }
             return view('Company.index');
        }
    
        /**
            * Store a newly created resource in storage.
            *
            * @return Response
            */
        public function store(CompanyValidator $request)
        {
            $validated = $request->validated();
            if($validated)
            {
                $uploadImage = new UploadImageService();
                $url = $uploadImage->Upload($request->file('logo'));
                Company::create([
                    'name' => $request->name,
                    'address' => $request->address,
                    'logo' => $url,
                ]);   
            }
            return redirect()->route('company.index');
        }
        
        /**
            * Display the specified resource.
            *
            * @param  int  $id
            * @return Response
            */
        public function show($id)
        {
            //
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
