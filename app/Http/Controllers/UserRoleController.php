<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\UserRole;
use App\Models\UserPermission;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params     =   $request->all();
        $perpage    =   $params['per_page']??10;
        $userrole       =   new UserRole;
        if(!empty($params['search'])){
            $userrole   =   $userrole->where('user_role','like', '%' . $params['search'] . '%');
        }
        $userrole          = $userrole->whereNotIn('id', ['1']);
        $data['userroles'] = $userrole->paginate($perpage);
        return view('roles.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Role';
        $data['action'] = route('roles.store');
        return view('roles.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'user_role' => 'required'
        ]);

        if($validation->fails())
        {
            return redirect('roles')->withErrors($validation)->withInput();
        }
        
        $role = UserRole::create([
            'user_role' => $request->user_role
        ]);

        if($role)
        {
            $user_permission = UserPermission::create([
                'role_id' => $role->id, 
                'role_permissions' => $request->user_permissions
            ]);

            if($user_permission)
            {
                $message = array('message_type'=>'success','message'=> "User has been added successfully.");
            }
            else{
                $message = array('message_type'=>'error','message'  => "Something went wrong!");
            }

            return redirect('roles')->with($message);
        }

        return view('roles.add');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($roleid)
    {
        $data['action'] =   route('roles.update', $roleid);
        $data['title']  =   'Edit Role';
        $permissions    =   UserPermission::where('role_id', $roleid)->first();
        $userrole = UserRole::where('id', $roleid)->first();
        $data['permissions']       =   $permissions['role_permissions'];
        $data['role'] = $userrole->user_role;

        return view('roles.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleid)
    {
        $data = $request->all();

        if(!empty($data))
        {
            $validation = Validator::make($request->all(), [
                'user_role' => 'required'
            ]);

            if($validation->fails())
            {
                return redirect('roles')
                            ->withErrors($validator)
                            ->withInput();
            }

            $user_role = UserRole::where('id', $roleid)->update([
                'user_role' => $request->user_role
            ]); 

            $user_permission = UserPermission::where('role_id', $roleid)->update([ 
                'role_permissions' => $request->user_permissions
            ]);

            if($user_permission)
            {
                $message = array('message_type'=>'success','message'=> "Userroles has been updated successfully.");
            }
            else{
                $message = array('message_type'=>'error','message'  => "Something went wrong!");
            }

            return redirect('roles')->with($message);

        }

        return redirect('roles')->withErrors('something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        UserRole::find($request->rowid)->delete();
        return redirect('roles')->with('success', 'successfully userrole deleted');
    }
}
