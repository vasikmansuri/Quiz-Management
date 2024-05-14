<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'answer',
        'question_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function question(){
        return $this->hasOne(Question::class,'id','question_id');
    }
}
