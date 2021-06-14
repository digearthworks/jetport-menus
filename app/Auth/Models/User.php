<?php

namespace App\Auth\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Auth\Concerns\HasPermissionsLabel;
use App\Auth\Concerns\HasRolesLabel;
use App\Auth\Concerns\UserAttribute;
use App\Auth\Concerns\UserMethod;
use App\Auth\QueryBuilders\UserQueryBuilder;
use App\Menus\Concerns\HasMenus;
use App\Support\Concerns\HasUuid;
use Database\Factories\UserFactory;
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
    use GetsAuthConnection,
        HasApiTokens,
        HasFactory,
        HasMenus,
        HasPermissionsLabel,
        HasProfilePhoto,
        HasRoles,
        HasRolesLabel,
        HasUuid,
        Impersonate,
        Notifiable,
        MustVerifyEmail,
        SoftDeletes,
        TwoFactorAuthenticatable,
        UserAttribute,
        UserMethod,
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    protected function canEditContent(): bool
    {
        return $this->hasRole(config('template.auth.access.role.admin'));
    }
}
