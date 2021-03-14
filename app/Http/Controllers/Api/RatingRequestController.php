<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RatingRequest;

class RatingRequestController extends Controller
{
    public function acceptRequest($id)
    {
      RatingRequest::findOrFail($id)->accept();
      return response(['success' => true], 200);
    }

    public function rejectRequest($id)
    {
      RatingRequest::findOrFail($id)->reject();
      return response(['success' => true], 200);
    }

    public function getRequests()
    {
      $requests = RatingRequest::with('user')->paginate(20);

      return response($requests, 200);
    }
}
