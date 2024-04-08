<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Tasks;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
\Illuminate\Support\Facades\Schedule::call(function () {
    try {
        $tasks = Tasks::where('status', 1)->get();
        $today = Carbon::now();

        foreach ($tasks as $task){
            if($task['finalDate'] == null){
                $expectedFinalDate = Carbon::parse($task['expectedFinalDate']);
                if($expectedFinalDate->greaterThan($today)){

                    try {

                        echo Tasks::find($task->id)->update('status', 2);
                    }catch (Exception $exception){
                        echo 'aaaa';
                        echo $exception->getMessage();
                    }

                }
            }
        }
        return true;
    }catch (\Exception $exception){
        echo $exception->getMessage();
    }

})->everyMinute();
