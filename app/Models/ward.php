<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    protected $table = 'wards';
    protected $primaryKey = 'code';
    public $incrementing = false;
    
    public function provinces(){
        return $this->belongsTo(District::class , 'district_code' , 'code' );
    }
}
