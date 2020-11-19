<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
   public function getCms(int $type = 0)
   {
       $cmsObj = new Cms;
       $data = $cmsObj->getCms($type)->get();

       return response()->json(['data' => $data,
       'status'=>true], $this->successStatus);
   }
}
