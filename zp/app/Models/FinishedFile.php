<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FinishedFile extends Model
{
    protected $fillable = ['user_id', 'file_id', 'points'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function file() {
        return $this->belongsTo(LatexFile::class, 'file_id');
    }
}
