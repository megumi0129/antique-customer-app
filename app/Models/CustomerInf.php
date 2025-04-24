<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInf extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'salon_id', 'name', 'tel', 'tel2', 'tel3', 'email', 'birth',
        'memo', 'detail_memo', 'uptime', 'lastdate',
    ];

    public function visits()
    {
        return $this->hasMany(CustomerVisitInf::class, 'customer_id')
        ->orderByDesc('book_time');
    }
}
