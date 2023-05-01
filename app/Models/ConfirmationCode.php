<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationCode extends Model
{
    use HasFactory;

    protected $table = 'confirmation_codes';

    protected $fillable = [
        'id_user',
        'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
