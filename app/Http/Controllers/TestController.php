<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TestController extends Controller
{

  use HttpResponses;

  public function index()
  {
    return $this->response('Its working', JsonResponse::HTTP_OK);
  }
}