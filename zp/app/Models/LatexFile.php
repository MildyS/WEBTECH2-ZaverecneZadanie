<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LatexFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}