<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Student extends Model
{
public function user(){
    return $this->belongsTo(User::class);
}
public function comments(){
    return $this->hasMany(Comment::class);
}
}


