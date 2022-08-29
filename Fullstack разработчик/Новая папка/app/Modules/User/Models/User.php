<?php

  namespace App\Modules\User\Models;

  use Illuminate\Foundation\Auth\User as Authenticatable;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Support\Facades\Hash;
  use App\Modules\User\Models\ENUM\RolesEnum;
  use Illuminate\Support\Carbon;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  use App\Modules\Comment\Models\Comment;

  /**
 * App\Models\User
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @mixin Eloquent
 * @property int                                                                                      $id
 * @property string                                                                                   $login               Имя или логин
 * @property string                                                                                   $email               Email
 * @property Carbon|null                                                                              $email_verified_at   Дата и время подтверждения email
 * @property string                                                                                   $password            Пароль
 * @property string                                                                                   $password_changed_at Дата и время последнего изменения пароля
 * @property string|null                                                                              $remember_token      Токен сессии аккаунта
 * @property int                                                                                      $is_active           Статус аккаунта
 * @property int                                                                                      $group               Группа аккаунта
 * @property string                                                                                   $registered_at       Дата и время создания аккаунта
 * @property string|null                                                                              $deleted_at
 * @property-read RoleData                                                                            $role
 * @property-read Profile|null                                                                        $profile
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereGroup($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsActive($value)
 * @method static Builder|User whereLogin($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePasswordChangedAt($value)
 * @method static Builder|User whereRegisteredAt($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User profileAndOrders()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\User\Models\User\Ban[]     $bans
 * @property-read int|null                                                                         $bans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\User\Models\User\Balance[] $balances
 * @property-read int|null                                                                         $balances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\User\Models\User\Ban[]     $bans_assigned
 * @property-read int|null                                                                         $bans_assigned_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\User\Models\User\Bonus[]   $bonuses
 * @property-read int|null                                                                         $bonuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property-read int|null $comments_count
 */
  class User extends Authenticatable
  {

    public $timestamps = false;

    protected $fillable = [
      'login',
      'email',
      'password',
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
      $this->attributes['password'] = Hash::make($password);
    }

    public function getRoleAttribute(): string
    {
      return RolesEnum::from($this->group)->group();
    }

    public function comments(): HasMany
    {
      return $this->hasMany(Comment::class);
    }
  }
