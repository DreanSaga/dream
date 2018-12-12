<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($files){

        $basePath = "uploads/".date('Y-m-d',time());
        if(!file_exists($basePath)){
            mkdir($basePath,755,true);
        }
        $filename = "/".date('YmdHis',time()).'.'.$files->getClientOriginalExtension();
        move_uploaded_file($files->path(),$basePath.$filename);
        return "/".$basePath.$filename;

    }
}
