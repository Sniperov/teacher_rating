<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingRequest extends Model
{
  const STATUS_PENDING = 1;
  const STATUS_REJECTED = 2;
  const STATUS_DONE = 3;

  protected $fillable = [
      'user_id', 'status', 'text', 'photo_url'
  ];

}
