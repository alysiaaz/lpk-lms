<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * URL foto profil. Kalau belum upload foto, jatuh ke avatar
     * berbentuk inisial nama (dibuat otomatis, tanpa layanan luar).
     */
    public function avatarUrl(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        $initial = strtoupper(substr($this->name ?? 'U', 0, 1));

        return 'data:image/svg+xml;base64,' . base64_encode(
            '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200"><rect width="200" height="200" fill="#2f5850"/><text x="50%" y="54%" font-family="sans-serif" font-size="90" fill="#f8f9f8" text-anchor="middle" dominant-baseline="middle">' . $initial . '</text></svg>'
        );
    }

    public function kursuses()
    {
        return $this->belongsToMany(Kursus::class, 'enrollments', 'user_id', 'kursus_id')
                    ->withPivot('status', 'created_at')
                    ->withTimestamps();
    }
}
