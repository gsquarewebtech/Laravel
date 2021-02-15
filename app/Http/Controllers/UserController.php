<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Auth\Events\Registered;
use App\Mail\WelcomeMail;
use App\Models\UserRole;
use App\Models\UserPermission;
use Auth;


class UserController extends Controller
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
        $User       =   new User;
        if(!empty($params['search'])){
            $User   =   $User->where('email','like', '%' . $params['search'] . '%')
                            ->orWhere('first_name','like', '%' . $params['search'] . '%')
                            ->orWhere('last_name','like', '%' . $params['search'] . '%');

        }
        $User          = $User::whereNotIn('id', ['1'])->with('userrole');
        $users = $User->paginate($perpage);
        $role = Auth::user()->user_type;
        if($role != 1)
        {
            $prms = UserPermission::where('role_id', $role)->first();
            $permissions = $prms->role_permissions;
            return view('users.list',compact('users', 'permissions'));
        }
        else{
            $permissions = '';
            return view('users.list',compact('users', 'permissions'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  =   'Add User';
        $data['method'] = 'post';
        $data['action'] =   route('user.store');
        $data['roles'] = UserRole::all()->except(1);
        $role = Auth::user()->user_type;
        if($role != 1)
        {
            $prms = UserPermission::where('role_id', $role)->first();
            $data['permissions'] = $prms->role_permissions;
            return view('users.add',$data);
        }
        else{
            $permissions = '';
            return view('users.add',$data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if(!empty($data)){
           
            $validator = Validator::make($data, [
                'first_name'        => 'required',
                'email'             => 'required|unique:users',
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|same:password'
                
            ]);
    
            if ($validator->fails()) {
                return redirect('user/add')
                            ->withErrors($validator)
                            ->withInput();
            }

            $User = User::create([
                'first_name'    =>  $data['first_name'],
                'last_name'     =>  $data['last_name'],
                'password'      =>  Hash::make($data['password']),
                'email'         =>  $data['email'],
                'user_type'     =>  $data['user_type'],
                'added_by'      =>  auth()->user()->id
            ]);
            
            $response           = $User->save();

            if($response){
                event(new Registered($User));
                $message = array('message_type'=>'success','message'=> "User has been added successfully.");
            }else{
                $message = array('message_type'=>'error','message'  => "Something went wrong!");
            }
            return redirect('user')->with($message);
        }

        return view('users.list');
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
    public function edit($id)
    {
        $data['title']  =   'Edit User';
        $data['method'] = 'put';
        $data['user'] = User::find($id);
        $data['action'] = route('user.update',$id);
        $data['roles'] = UserRole::all()->except(1);
        $role = Auth::user()->user_type;
        if($role != 1)
        {
            $prms = UserPermission::where('role_id', $role)->first();
            $data['permissions'] = $prms->role_permissions;
            return view('users.add',$data);
        }
        else{
            $permissions = '';
            return view('users.add',$data);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        if(!empty($data)){
           
            $validator = Validator::make($data, [
                'first_name'        => 'required',
            ]);
            $passupdateData = array();
            if(!empty($data['password'])){
                $validator = Validator::make($data, [
                    'password'          => 'required|min:6',
                    'confirm_password'  => 'required|same:password'
                ]);
                $passupdateData =   array('password' =>  Hash::make($data['password']));
            }

            if ($validator->fails()) {
                return redirect('user')
                            ->withErrors($validator)
                            ->withInput();
            }            

            $updateData =   array(
                            'first_name'    =>  $data['first_name'],
                            'last_name'     =>  $data['last_name'],
                            'user_type'     =>  $data['user_type']
                            );
            $updateData = array_merge($updateData,$passupdateData);                    

            $users = User::where('id',$id)->first();

            $response           = $users->toQuery()->update($updateData);

            if($response){
                $message = array('message_type'=>'success','message'=> "User has been updated successfully.");
            }else{
                $message = array('message_type'=>'error','message'  => "Something went wrong!");
            }
            return redirect('user')->with($message);
        }

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::find($request->rowid)->delete();
        return redirect('user')->with('success', 'successfully user deleted');
    }
}


