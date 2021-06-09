<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Jobs\NewsLetterMailJob;

class QueueController extends Controller
{
    public function index()
    {
        $data['title']='Queues';
        $data['datas']=Newsletter::where('status',1)->get();
        return view('queue.index',$data);
    }
    public function forcejob(Request $request)
    {
       $nl=Newsletter::find($request->uId);
       $users=Customer::where('user_group', $nl->user_group)->get();
       foreach($users as $user){
        //    echo $user->email.'<br>';
           dispatch(new NewsLetterMailJob($nl->id,$user->email));
       }

       $updated=Newsletter::find($request->uId)->update(['status'=>0]);
       if($updated >=1){
        return redirect('jobs')->with(['success'=>'Updated Successfully']);
    }else{
        return redirect()->back()->with(['error'=>'Please Try Again']);
    }
    }
}
