<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['name']='User Group';
        $data['urls']='usergroup';
        $data['datas']=UserGroup::all();
        return view('usergroup.index',$data);
    }

    public function store(Request $request)
    {
        $ug=new UserGroup;
        $ug->name=$request->name;
        $ug->status=$request->status;
        $saved=$ug->save();
        if($saved){
            return redirect('usergroup')->with(['success'=>'Created Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }

    public function update(Request $request, $id)
    {
        $updated=UserGroup::find($id)->update([
            'name'=>$request->name,
            'status'=>$request->status
        ]);
        if($updated >=1){
            return redirect('usergroup')->with(['success'=>'Updated Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }
    public function destroy($id)
    {
        $deleted=UserGroup::find($id)->delete();
        if($deleted){
            return redirect('usergroup')->with(['success'=>'Deleted Successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Please Try Again']);
        }
    }
}
