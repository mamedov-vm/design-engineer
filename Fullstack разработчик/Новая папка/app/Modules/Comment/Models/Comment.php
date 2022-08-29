<?php

  namespace App\Modules\Comment\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use App\Modules\User\Models\User;

  /**
   * App\Modules\Comment\Models\Comment
   *
   * @property int       $id
   * @property int       $user_id
   * @property string    $content    Содержимое комментария
   * @property string    $created_at Дата и время создания комментария
   * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
   * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
   * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
   * @method static \Illuminate\Database\Eloquent\Builder|Comment whereContent($value)
   * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
   * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
   * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
   * @mixin \Eloquent
   * @property-read User $user
   */
  class Comment extends Model
  {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
      'user_id',
      'content',
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
  }
