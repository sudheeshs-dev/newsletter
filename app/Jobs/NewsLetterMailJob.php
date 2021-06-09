<?php

namespace App\Jobs;

use App\Models\Newsletter;
use App\Mail\NewsLetterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewsLetterMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $id,$mailid;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$mailid)
    {
        $this->id=$id;
        $this->mailid=$mailid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NewsLetterMail($this->id);  
        Mail::to($this->mailid)->send($email);
        // $nl=Newsletter::find($this->id);      
        // Mail::to($this->mailid)->send($nl->template);
    }
}
