<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionWeb extends Model
{
    use HasFactory;

    protected $table = 'sessions_web';
    protected $fillable = [
        'id_user',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
