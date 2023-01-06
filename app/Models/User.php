<?php

namespace App\Models;

use App\Models\Department;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'identity_type',
        'identity_number',
        'issue_date',
        'house_no',
        'street_no',
        'phone',
        'email',
        'position',
        'department_id',
        'profile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }


    public function getFullNameAttribute(){
        return $this->name.' '.$this->last_name;
    }
}
