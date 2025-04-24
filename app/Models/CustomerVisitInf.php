<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerVisitInf extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id', 'stylist_name', 'shimei', 'menu', 'price',
        'needed_time', 'memo', 'file_path1', 'file_path2', 'file_path3',
        'book_time', 'update_time',
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerInf::class, 'customer_id');
    }
}
