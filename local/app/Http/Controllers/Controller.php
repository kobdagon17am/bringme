<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // echo "Date Diff = ".$this->DateDiff("2023-09-28 13:32:20","2023-09-28 13:32:20")."<br>";
    // echo "Time Diff = ".$this->TimeDiff("00:00","19:00")."<br>";
    // echo "Date Time Diff = ".$this->DateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
    public static function DateDiff($strDate1,$strDate2)
    {
               return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
    }

    public static function TimeDiff($strTime1,$strTime2)
    {
               return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
    }

    public static function DateTimeDiff($strDateTime1,$strDateTime2)
    {
               return (strtotime($strDateTime2) - strtotime($strDateTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
    }

}
