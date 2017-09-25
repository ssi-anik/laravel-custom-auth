<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';

	public function user () {
		return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
