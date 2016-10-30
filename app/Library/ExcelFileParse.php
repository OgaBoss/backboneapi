<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 8/19/16
 * Time: 1:24 PM
 */

namespace App\Library;

use Carbon\Carbon;
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

            // Check for file size
//            $file_size = ($this->request->file('csv')->getClientSize()) / 1000;
//            if($file_size > 1000){
//                return response()->json(['error' => 'Please upload an Excel/CSV file of 1MB or less'], 500);
//            }

            // create file name
            $time  = Carbon::now();
            $time = str_replace(array(':', ' '), '-', $time);
            $file_name = $time.'-'.Random::generateString(6, 'aeosvx').'.'.$file_extension;

            // save file
            // and return file location
            try{
                $uploaded_file = $this->request->file('csv')->move(base_path().'/public/csv-files', $file_name);
                return $uploaded_file->getPathname();
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