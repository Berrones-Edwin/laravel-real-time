<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Events\UserCreated;
use App\Events\UserUpdated;
use App\Events\UserDeleted;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The event map for the model
     * 
     * Allows for object-based events for native Eloquent events
     * 
     * @var array
     */

     protected $dispatchesEvents=[
        'created'=> UserCreated::class,
        'updated'=> UserUpdated::class,
        'deleted'=> UserDeleted::class
     ];
}
