<?php

namespace App\Http\Controllers;

use App\Http\Resources\SourceTypeResource;
use App\Models\SourceType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SourceTypeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $type =  SourceType::get();
        return SourceTypeResource::collection($type);
    }
}
