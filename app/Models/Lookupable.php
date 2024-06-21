<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lookupable extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'lookupables';

    protected $fillable = [
        'lookupable_type ',
        'lookupable_id ',
        'lookup_id', 'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
