<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'part_id', 'type', 'quantity', 'cost', 'price', 'notes'
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
