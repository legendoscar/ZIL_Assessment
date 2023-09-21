<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'email',
        'password',
        'photo',
        'type'
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


    /**
     * Retrieve the default photo from storage.
     * Supply a base64 png image if the `photo` column is null.
     * @return string
     */
    public function getAvatarAttribute($value): string
    {
        $user_id = auth()->user()->id;
        $avatar = User::find($user_id)->photo;
        
        return $avatar !== '' ? $avatar = $avatar: $avatar = 'default.png';

    }

    /**
     * Returns the first, middle initial, and last name of the user.
     *  
     * @param  string  $value
     * @return string
     */
    public function getFullnameAttribute($value): string
    {

        $user_id = auth()->user()->id;
        $firstname = User::find($user_id)->firstname;
        $middlename = User::find($user_id)->middlename;
        $lastname = User::find($user_id)->lastname;

        
        return $middlename !== NULL ? $firstname . ' ' . substr($middlename, 0, 1) . '. ' . $lastname 
            : $firstname . ' ' . substr($middlename, 0, 1) . ' ' . $lastname ;

    }

    /**
     * Returns the user's middle initial.
     *
     * @param  string  $value
     * @return string
     */
    public function getMiddleinitialAttribute($value): string
    {
        $user_id = auth()->user()->id;
        $middlename = User::find($user_id)->middlename;

        
        return ucfirst(substr($middlename, 0, 1));
    }

    /**
     * Returns the lists of users.
     *
     * @param  string  $value
     * @return array
     */
    public function getAllUsers()
    {
        return User::paginate(10);
    }

    /**
     * Returns the single user.
     *
     * @param  string  $value
     * @return array
     */
    public function getSingleUser($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Returns the lists of trashed users.
     *
     * @param  string  $value
     * @return array
     */
    public function getTrashedUsers()
    {
        // return User::onlyTrashed()->paginate(10);
        return User::onlyTrashed()->paginate(10)->count() >= 1 ? User::onlyTrashed()->paginate(10) : 0;
    }

    /**
     * Returns the lists of trashed users.
     *
     * @param  string  $value
     * @return array
     */
    public function restoreTrashedUsers($id)
    {
        return User::where('id', $id)->restore();
    }

     /**
     *Force delete a user.
     *
     * @param  string  $value
     * @return array
     */
    public function forceDeleteUser($id)
    {
        return User::where('id', $id)->forceDelete();
    }


    public function userDetail() 
    {
        return $this->hasMany(Detail::class);
    }
    
}
