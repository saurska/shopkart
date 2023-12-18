<?php

namespace App\Http\Controllers\Profile;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request) :RedirectResponse{
      $path =  $request->file('avatar')->store('avatars','public');
      if($oldAvatar = $request->user()->avatar){
        Storage::disk('public')->delete($oldAvatar);
      }
      auth()->user()->update(['avatar' => $path]);

    //   dd($path);
        return back();

        
    }
}
