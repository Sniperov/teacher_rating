<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RatingRequest;

class RatingRequestController extends Controller
{

    public function createRequest(Request $request)
    {
      $data = $request->validated();

      if(!$request->hasFile('image')) 
          return response(['upload_file_not_found'], 400);
      
      $file = $request->file('image');

      if(!$file->isValid()) 
          return response()->json(['invalid_file_upload'], 400);
      
      $path = public_path() . '/uploads/images/store/' ;

      $file->move($path, $file->getClientOriginalName());

      RatingRequest::create(
        ['user_id'  => auth()->user()->id
        ,'status'   => RatingRequest::STATUS_PENDING
        ,'text'     => $data['text']
        ,'photo_url'=> $path . $file->getClientOriginalName()
        ]);

      return response(['success' => true]);

      
    }
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
