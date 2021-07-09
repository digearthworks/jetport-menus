<?php

namespace Turbine\Auth\Models;

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
use Turbine\Auth\Concerns\GetsAuthConnection;
use Turbine\Auth\Concerns\HasPermissionsLabel;
use Turbine\Auth\Concerns\HasRolesLabel;
use Turbine\Auth\Concerns\UserAttribute;
use Turbine\Auth\Concerns\UserMethod;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\QueryBuilders\UserQueryBuilder;
use Turbine\Concerns\CachesQueries;
use Turbine\Concerns\HasChildren;
use Turbine\Concerns\HasUuid;
use Turbine\Menus\Concerns\HasMenuItems;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable
{
    use GetsAuthConnection;
    use HasChildren;
    use HasApiTokens;
    use HasFactory;
    use HasMenuItems;
    use HasPermissionsLabel;
    use HasProfilePhoto;
    use HasRoles;
    use HasRolesLabel;
    use HasUuid;
    use Impersonate;
    use Notifiable;
    use MustVerifyEmail;
    use SoftDeletes;
    use TwoFactorAuthenticatable;
    use UserAttribute;
    use UserMethod;
    use CachesQueries;
    use Userstamps;

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

    protected $table = 'users';

    protected $childTypes = [
        'admin' => Admin::class,
        'user' => User::class,
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
        'type' => UserTypeEnum::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $parentalGlobalScopeFunctionName = 'ParentalInheritance';

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

    public function guardName()
    {
        return 'web';
    }
}
