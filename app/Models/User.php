<?php

namespace App\Models;

use App\Models\Traits\Attribute\UserAttribute;
use App\Models\Traits\Connection\AuthConnection;
use App\Models\Traits\Method\UserMethod;
use App\Models\Traits\Relationship\UserRelationship;
use App\Models\Traits\Scope\UserScope;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable
{
    use AuthConnection,
        HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        HasRoles,
        Impersonate,
        Notifiable,
        MustVerifyEmail,
        SoftDeletes,
        TwoFactorAuthenticatable,
        UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        Userstamps;

    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
