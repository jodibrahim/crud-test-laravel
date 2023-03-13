<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;

class UserNew extends Model implements Authenticatable
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'tbl_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'nohp',
        'akses',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	/**
	 * Get the name of the unique identifier for the user.
	 * @return string
	 */
	public function getAuthIdentifierName() {
        return 'id';
	}
	
	/**
	 * Get the unique identifier for the user.
	 * @return mixed
	 */
	public function getAuthIdentifier() {
        return $this->id;
	}
	
	/**
	 * Get the password for the user.
	 * @return string
	 */
	public function getAuthPassword() {
        return $this->password;
	}
	
	/**
	 * Get the token value for the "remember me" session.
	 * @return string
	 */
	public function getRememberToken() {
        return $this->remember_token;
	}
	
	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param string $value
	 * @return void
	 */
	public function setRememberToken($value) {
        $this->remember_token = $value;
	}
	
	/**
	 * Get the column name for the "remember me" token.
	 * @return string
	 */
	public function getRememberTokenName() {
        return 'remember_token';
	}
}
