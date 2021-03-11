<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingRequest extends Model
{
  const STATUS_PENDING = 1;
  const STATUS_REJECTED = 2;
  const STATUS_ACCEPTED = 3;

  protected $fillable = [
      'user_id', 'status', 'text', 'photo_url'
  ];

  public function reject()
  {
    $this->status = RatingRequest::STATUS_REJECTED;
    $this->update();
  }

  public function accept($value='')
  {
    $this->status = RatingRequest::STATUS_ACCEPTED;
    $this->update();
  }
}
