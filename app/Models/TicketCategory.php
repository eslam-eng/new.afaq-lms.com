<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    public $table = 'ticket_categories';


    public const STATUS_SELECT = [
        '1' => 'Show',
        '0' => 'Hide',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const TYPE_SELECT = [
        'AFAQ'     => 'AFAQ',
        'Business' => 'Business',
    ];
    protected $fillable = [

        'title_ar',
        'title_en',
        'status',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
