<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
           
      $gallery = new GalleryImage();

      if($request->hasFile('image')) {
        $images = $request->file('image');
        foreach($images as $image) {
          $path = $image->getClientOriginalName();
          $name = time() . '-' . $path;
          $gallery->image = $image->move(public_path().'/uploads/temp/', $name);
          //$gallery->image = $request->file('image')->storeAs('public/gallery-images', $name);
        }
      }

      $gallery->gallery_id = $request->gallery_id;

      $gallery->save();

      return back()->with('success_message','Images has been uploaded!');
    }
}
