<?php

namespace App\Models;

use App\Models\Concerns\Attribute\UserAttribute;
use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasMenus;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\IsWinkAuthor;
use App\Models\Concerns\Method\UserMethod;
use App\Models\Concerns\Scope\UserScope;
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
        HasMenus,
        HasProfilePhoto,
        HasRoles,
        HasUuid,
        Impersonate,
        IsWinkAuthor,
        Notifiable,
        MustVerifyEmail,
        SoftDeletes,
        TwoFactorAuthenticatable,
        UserAttribute,
        UserMethod,
        UserScope,
        Userstamps;

    public const TYPE_ADMIN = 'admin';

    public const TYPE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        // 'name',
        // 'email',
        // 'password',
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
        'active' => 'boolean',
        'last_login_at' => 'datetime',
        'to_be_logged_out' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected function canEditContent()
    {
        return $this->hasRole(config('template.auth.access.role.admin'));
    }
}
