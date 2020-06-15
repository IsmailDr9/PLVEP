<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    final public function upload($request, $path, $newName = null)
    {
        $newName === null ? $newName = time() : $newName;
    }
}
