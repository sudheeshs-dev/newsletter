<?php

namespace App\Console;

use App\Models\Customer;
use App\Models\Newsletter;
use App\Jobs\NewsLetterMailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // DB::table('html_template')->insert(['data'=>strtotime('2021-06-09 08:08:52')]);
            $data=Newsletter::all();
            foreach($data as $news){
                if(strtotime($news->start_date) == strtotime(date('Y-m-d H:i:s'))){
                    $nl=Newsletter::find($news->id);
                    $users=Customer::where('user_group', $nl->user_group)->get();
                    foreach($users as $user){
                        //    echo $user->email.'<br>';
                        dispatch(new NewsLetterMailJob($nl->id,$user->email));
                    }

                    $updated=Newsletter::find($news->id)->update(['status'=>0]);
                
            }
        }
            // DB::table('html_template')->insert(['data'=>strtotime(date('Y-m-d H:i:s'))]);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
