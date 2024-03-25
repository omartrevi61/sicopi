<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Panel;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'es_profesor',
        'profesor_id',
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
        'password' => 'hashed',
        'es_profesor' => 'boolean',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        $user = Auth::user();
        // $roles = $user->getRoleNames();

        if ($panel->getId() === 'admin' && $user->es_profesor) {
            return false;
        }
        else {
            return true;
        }

        /* if ($panel->getId() === 'admin' && $roles->contains('Administrador')) {
            return true;
        }
        elseif ($panel->getId() === 'profesor'  && $roles->contains('Profesor')) {
            return true;
        }
        else{
            return false;
        } */
            
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
