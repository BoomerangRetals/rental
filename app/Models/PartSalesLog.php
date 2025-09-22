<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartSalesLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'staff_id', 'part_id', 'type', 'quantity', 'cost', 'price', 'notes'
    ];

    public function part() { return $this->belongsTo(Part::class); }
    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function staff() { return $this->belongsTo(User::class, 'staff_id'); }
}
