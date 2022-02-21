<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contrat extends Model
{
    protected $fillable = ['detail_contrat', 'employe_id', 'post_id'];
    use HasFactory;
}
