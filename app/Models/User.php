<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Tarea;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $guarded = [];

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

    /**
     * Get the tareas for the User.
     *
     * @return HasMany
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'user_id', 'id');
    }

    /**
     * Get all Users with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getUsers()
    {
        return User::paginate(10);
    }

    /**
     * Get all Operarios with pagination.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getOperarios()
    {
        return User::where('rol', '=', 'O')->paginate(10);
    }

    /**
     * Get the authenticated User's data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMyData()
    {
        return User::where('id', Auth::user()->id)->get();
    }
}
