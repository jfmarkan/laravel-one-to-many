<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Type;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "projects";

    protected $fillable = ['repo', 'title', 'language', 'date', 'image', 'type_id'];

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
