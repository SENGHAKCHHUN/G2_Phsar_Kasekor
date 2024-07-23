<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'frontuser_id',
        'limit_duration_type_id',
    ];

    public function frontuser()
    {
        return $this->belongsTo(FrontUser::class);
    }

    public function limit_duration
}
