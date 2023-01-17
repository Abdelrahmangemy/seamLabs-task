<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountRangeController extends Controller
{
    function count($start_number, $end_number) {
        if ($start_number > $end_number) {
            return ['Warning', 'Start Number must be smaller than the end number']; 
        } else {
            $all = range($start_number, $end_number);
            $exclude = [5];
            $result = array_diff($all, $exclude);
            
            return count($result);
        }
    }
}
