<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users',
        'type',
        'is_approve',
        'waktu'
    ];
}
