<?php

namespace App\Models;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = Tables::CATEGORIES;

    public const ID = 'id';
    public const NAME = 'name';
    public const SLUG = 'slug';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::NAME,
        self::SLUG,
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
