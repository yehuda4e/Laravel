<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
	public function editable() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function scopeLastEdit($query) {
		return $query->latest()->first();
	}
}