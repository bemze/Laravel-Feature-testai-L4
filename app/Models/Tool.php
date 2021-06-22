<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;
    // naudojant vadinamą natural key / custom key laravelyje turime jį nurodyt
    protected $primaryKey = 'name';

    protected $fillable = ['name', 'task'];
}
