<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inc extends Model
{
    use HasFactory;
    protected $fillable = ['id','code','status'];
    // protected $guarded = ['id'];
}
