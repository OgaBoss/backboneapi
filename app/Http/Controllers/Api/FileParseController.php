<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use Illuminate\Http\Request;
use App\Library\ExcelFileParse;
use App\Repositories\HmoRepository;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class FileParseController extends Controller
{
    //
    protected $parse;
    protected $request;
    protected $hmoRepository;

    public function __construct(ExcelFileParse $parse, Request $request, HmoRepository $hmoRepository){
        $this->middleware('jwt.auth');
        $this->parse = $parse;
        $this->request = $request;
        $this->hmoRepository = $hmoRepository;
    }

    public function store(){
        $location  = $this->parse->getFile();

        Excel::load($location, function($reader) {
            // Getting all results
            $results = $reader->toArray();

            array_map([$this, 'parseIcdNine'], $results);

            // 1 Loop through each of the array result
            // 2 Create The Entity
            // 3 Attach a user to the entity
            // 4 Send email and sms on success of the 2 and 3
        });

    }

    protected function parseIcdNine($data){
        $createData = [];

        $createData['code'] = $data['diagnosis_code'];
        $createData['long_desc'] = $data['long_description'];
        $createData['short_desc'] = $data['short_description'];

        Disease::create($createData);
    }

}
