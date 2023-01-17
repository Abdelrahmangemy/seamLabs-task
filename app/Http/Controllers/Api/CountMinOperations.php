<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountMinOperations extends Controller
{
    function countMinOperations($target, $n)
    {
        $result = 0;

        // Keep looping while all elements of target don't become 0.
        while (1)
        {
            $zero_count = 0;
        
            $i = 0;
            for($i = 0; $i < $n; $i++)
            {
                if ($target[$i] & 1)
                    break;
                else if ($target[$i] == 0)
                    $zero_count++;
            }
            if ($zero_count == $n)
                return $result;
            if ($i == $n)
            {
                for ($j = 0; $j < $n; $j++)
                $target[$j] = $target[$j] / 2;
                $result++;
            }
            for ($j = $i; $j < $n; $j++)
            {
                if ($target[$j] & 1)
                {
                    $target[$j]--;
                    $result++;
                }
            }
        }
    }

    function printCount() {
        $arr= array(4);
        $n = sizeof($arr);

        echo "Minimum number of steps required to \n".
            "get the given target array is ".
            $this->countMinOperations($arr, $n);
    }
}
