<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
<<<<<<< HEAD
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

=======
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
    
>>>>>>> master
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
