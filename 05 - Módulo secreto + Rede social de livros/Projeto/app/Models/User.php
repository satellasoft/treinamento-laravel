<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = Tables::USERS;

    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const USERNAME = 'username';
    public const BIO = 'bio';
    public const PHOTO = 'photo';
    public const PASSWORD = 'password';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::USERNAME,
        self::BIO,
        self::PHOTO,
        self::PASSWORD
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setUsernameAttribute(string $value): void
    {
        $this->attributes[self::USERNAME] = strtolower($value);
    }
}
