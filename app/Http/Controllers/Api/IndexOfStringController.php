<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexOfStringController extends Controller
{
    function indexOfString($input_string): int {
        $abcUpper = range('A', 'Z');
        $abcLower = range('a', 'z');
        if (ctype_upper($input_string)) return array_search($input_string, $abcUpper) + 1;
        else return array_search($input_string, $abcLower) + 1;
    }
}
