<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    public $timestamps = false;
    
   /* protected $casts = [
        'date_of_publication' => 'datetime:d.m.Y', 
    ];*/
}
