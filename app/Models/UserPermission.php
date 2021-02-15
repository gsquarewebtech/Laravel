<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id', 'role_permissions'
    ];

    protected $casts = [
        'role_permissions' => 'array'
    ];

    // protected $appends = ['rolepermission'];

    public function UserRole()
    {
       return $this->belongsTo(UserPermission::class);
    }

    public static function getRolePermissionAttribute()
    {
        $role = Auth::user()->user_type;
        if($role != 1)
        {
            $permissions = UserPermission::where('role_id', $role)->first();
            return $prms = $permissions->role_permissions;
        }
       
    }
    // $role = Auth::user()->user_type;
        
    // if($role != 1)
    // {   
    //     foreach($menu as $key => $m)
    //     {
    //         $permissions = UserPermission::where('role_id', $role)->first();
    //         $prms = $permissions['role_permissions'];
    //         $route = $m['route'];
    //         if(in_array($route,$prms))
    //         {
    //             dd($m);
    //             return $m;
    //         }
    //         else{
    //             return redirect()->route('dashboard');
    //         }
    //     }
    // }
    //  $role = Auth::user()->user_type;
        // if($role != 1)
        // {
        //     $permissions = UserPermission::where('role_id', $role)->first();
        //     return $prms = $permissions->role_permissions;
        // }


         // $menu = array (
                            // array('name' => 'Users', 'icon' => 'si si-users', 'route' => 'user'),
                            // array('name' => 'Websites', 'icon' => 'si si-globe', 'route' => 'Website'),
                            // array('name' => 'Sitemaps', 'icon' => '', 'route' => 'sitemaps'),
                            // array('name' => 'Website Feeds', 'icon' => '', 'route' => 'websitefeeds'),
                            // );

                            // \App\Models\UserPermission::getRolePermissionAttribute($menu)
}
