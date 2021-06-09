<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data['name']='Users';
        $data['title']='Users List';
        $data['urls']='customers';
        $data['usergroups']=UserGroup::where('status',1)->get();
        $data['datas']=Customer::all();
        return view('customer.index',$data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers|email',
            'user_group'=>'required',
            'status'=>'required'
        ]);
        $cs=new Customer;
        $cs->name=$request->name;
        $cs->email=$request->email;
        $cs->user_group=$request->user;
        $cs->status=$request->status;
        $saved=$cs->save();
        if($saved){
            return redirect('customers')->with(['success'=>'Created Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }

    public function update(Request $request, $id)
    {
        $updated=Customer::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'user_group'=>$request->user,
            'status'=>$request->status
        ]);
        if($updated >=1){
            return redirect('customers')->with(['success'=>'Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }
    public function destroy($id)
    {
        $deleted=Customer::find($id)->delete();
        if($deleted){
            return redirect('customers')->with(['success'=>'Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }
    public function bulkupload()
    {
        $data['title']='Users Bulk Upload';
        return view('customer.bulkupload',$data);
    }
    public function getcsvfile(Request $request)
    {
        $file = $request->file('file');
        $customerArr = $this->csvToArray($file);
        $bulk_data=array();
        for ($i = 0; $i < count($customerArr); $i ++)
        {
            // User::firstOrCreate($customerArr[$i]);  
            // echo "<pre>"; 
            // print_r($customerArr[$i]);
            // echo "</pre>";
            // echo $customerArr[$i]['email'];
            $checkEmail=Customer::where('email',$customerArr[$i]['email'])->first();
            echo $checkEmail;
            if(!empty($checkEmail)){
                return redirect()->back()->with(['error'=>$customerArr[$i]['email'].' Alredy Exists']) ;
            }else{
                $validUsergroup=UserGroup::where('name',$customerArr[$i]['usergroup'])->first();
                if(empty($validUsergroup)){
                    return redirect()->back()->with(['error'=>$customerArr[$i]['usergroup'].' UserGroup Not Found']) ;
                }else{   
               $user=[
                   'name'=>$customerArr[$i]['name'],
                   'email'=>$customerArr[$i]['email'],
                   'user_group'=>UserGroup::where('name',$customerArr[$i]['usergroup'])->value('id'),
                   'status'=>$customerArr[$i]['usergroup'] == 'disabled'?0:1
               ];
               array_push($bulk_data,$user);
            }
            }
        }
        // echo "<pre>"; 
        //     print_r($bulk_data);
        //     echo "</pre>";
        $insertdata=Customer::insert($bulk_data);
        if($insertdata){
            return redirect('customers')->with(['success'=>'Bulk Upload Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    
    }
    function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}
}
