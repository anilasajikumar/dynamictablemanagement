<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamicTableRow extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'data'];

    protected $casts = [
        'columns' => 'array',
        'data' => 'array',
    ];

    public function table()
    {
        return $this->belongsTo(DynamicTable::class, 'table_id');
    }

   
}
