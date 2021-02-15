<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_role'
    ];

    public function UserPermissions()
    {
        return $this->hasMany(UserPermissions::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_type');
    }

    public function websites()
    {
        return $this->hasMany(website::class, 'created_by');
    }
}
