<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = Tables::BOOKS;

    public const ID = 'id';
    public const TITLE = 'title';
    public const AUTHOR = 'author';
    public const COVER = 'cover';
    public const DESCRIPTION = 'description';
    public const CATEGORY_ID = 'category_id';
    public const USER_ID = 'user_id';
    public const COMPLETE = 'complete';
    public const FAVORITE = 'favorite';
    public const STARS = 'stars';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::TITLE,
        self::AUTHOR,
        self::COVER,
        self::DESCRIPTION,
        self::CATEGORY_ID,
        self::USER_ID,
        self::COMPLETE,
        self::FAVORITE,
        self::STARS,
    ];

    protected $casts = [
        self::COMPLETE => 'boolean',
        self::FAVORITE => 'boolean',
        self::STARS => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
