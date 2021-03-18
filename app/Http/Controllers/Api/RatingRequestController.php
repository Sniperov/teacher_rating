<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RatingRequest;

class RatingRequestController extends Controller
{

    public function createRequest(Request $request)
    {
      $data = $request->validated();

      if($request->hasFile('photo')) {
        $ext = $request->file('icon')->getClientOriginalExtension();
        $filename = (string) Str::uuid();
        if($ext) {
          $ext = mb_strtolower($ext);
          $filename = "{$filename}.{$ext}";
        }
        $request->file('photo')->storeAs('public/images', $filename);
        $data['icon'] = "public/images/{$filename}";
      }

      RatingRequest::create(
        ['user_id'  => auth()->user()->id
        ,'status'   => RatingRequest::STATUS_PENDING
        ,'text'     => $data['text']
        ,'photo_url'=> $data['photo']
        ]);

      return response(['success' => true], 201);

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
