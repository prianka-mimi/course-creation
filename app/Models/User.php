<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Manager\Constants\GlobalConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function getDashboardCounts()
    {
        $total = self::count();
        $active = self::whereNotNull('email_verified_at')->count();
        $inactive = self::whereNull('email_verified_at')->count();
        return ['total' => $total, 'active' => $active, 'inactive' => $inactive];
    }

    public function getUserList(Request $request)
    {
        $query = self::query();
        return $query->paginate($request->input('per_page', GlobalConstants::DEFAULT_PAGINATION));
    }

    public static function getTotalUsers()
    {
        return self::count();
    }
}
