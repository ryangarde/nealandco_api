<?php

namespace App\Http\Controllers;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
  public function index()
  {
    return Testimonial::all();
  }

  public function indexActive()
  {
    return Testimonial::where('isActive',1)->get()->take(9);
  }

  public function store(Request $request)
  {
    $path = Storage::putFile('public/testimonial_images', request()->file('image'));
    
    return Testimonial::create([
      'name' => $request->name,
      'description' => $request->description,
      'stars' => $request->stars,
      'roundedValue' => ceil(request()->stars),
      'image' => str_replace("public/","",$path),
    ]);
  }

  public function show(Testimonial $testimonial)
  {
    return $testimonial;
  }

  public function update(Testimonial $testimonial, Request $request)
  {
    $testimonial->fill($request->all())->save();

    return $testimonial;
  }

  public function updateImage(Testimonial $testimonial)
  {
    $path = Storage::putFile('public/testimonial_images', request()->file('image'));
    $testimonial->fill(['image' => str_replace("public/","",$path)])->save();

    return $testimonial;
  }

  public function destroy(Testimonial $testimonial)
  {
    $testimonial->delete();
  }
}
