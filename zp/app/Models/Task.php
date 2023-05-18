<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'latex_tasks';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task',
        'solution',
        'images',
        'latex_file_id',
        'points'
    ];

    /**
     * Get the latex file that owns the task.
     */
    public function latexFile()
    {
        return $this->belongsTo(LatexFile::class);
    }
}
