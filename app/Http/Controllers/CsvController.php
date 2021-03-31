<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UserImport;
use App\Models\User;
use Excel;
use Validator;

class CsvController extends Controller
{
    public function importUploadForm(){
        
        return view('import-form');
    }

    public function import(Request $request){
        
        $validator = Validator::make($request->all(),[
            'file' => 'required|max:5000|mimes:xlsx, xls, csv'
        ]);


        if($validator->passes()){

            Excel::import(new UserImport, $request->file);

            return response(['message' => 'File imported successfully'], 200);
        }else{

            return response(['message' => 'An errors has occured while importing the file'], 404);
        }
    }
}
