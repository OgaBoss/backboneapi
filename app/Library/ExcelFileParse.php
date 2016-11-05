<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 8/19/16
 * Time: 1:24 PM
 */

namespace App\Library;

use Carbon\Carbon;
use App\NhisTracker;
use Illuminate\Http\Request;
use Webcraft\Random\RandomFacade as Random;
use Maatwebsite\Excel\Files\ExcelFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ExcelFileParse extends ExcelFile {
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request){
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFile(){
        if($this->request->hasFile('csv')){
            $file_extension = $this->request->file('csv')->getClientOriginalExtension();

            // check if file extension is .xlsx or .xls
            $extension_type_array = ['xlsx', 'xls', 'csv'];
            if(!in_array($file_extension, $extension_type_array)){
                return response()->json(['error' => 'Please upload an Excel/CSV file only'], 500);
            }

            //Check for file size
            $file_size = ($this->request->file('csv')->getClientSize()) / 1000;
            if($file_size > 500){
                return response()->json(['error' => 'Please upload an Excel/CSV file of 500KB or less. You can break up the file into other smaller files'], 500);
            }

            // Get file name
            $file_name = $this->request->file('csv')->getClientOriginalName();

            //Check if this file has been uploaed b4
            $data = NhisTracker::where('file_name',$file_name)->get();
            if(count($data) > 0){
                return response()->json(['error' => 'Ths file was already uploaded. If you are sure it is a new File please change the file name and upload again, Thank you.'], 400);
            }else{
                NhisTracker::create(['file_name' => $file_name, 'hmo_id' => $this->request->hmo_id]);
            }

            // save file
            // and return file location
            try{
                $uploaded_file = $this->request->file('csv')->move(base_path().'/public/csv-files', $file_name);
                return [$uploaded_file->getPathname(), $file_name];
            }catch(FileException $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }else{
            return response()->json(['error' => 'No csv file found'], 500);
        }
    }

    protected function uploadFile($file){

    }
}