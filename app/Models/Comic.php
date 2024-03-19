<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'tentruyen', 'tomtat', 'kichhoat', 'slug_truyen', 'hinhanh', 'danhmuc_id' 
    ];
    protected $primaryKey = 'id';
    protected $table = 'truyen';

    public function category(){
        return $this->belongsTo('App\Models\Category', 'danhmuc_id', 'id');
    }

}
