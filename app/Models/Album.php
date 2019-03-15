<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    protected $table = 'albums';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $dates = ['deleted_at'];
	
	public function images(){
	return $this->hasMany(Image::class);}

}
