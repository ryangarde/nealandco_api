<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Testimonial;

class TestimonialsController extends Controller
{
  public function index()
  {
    return Testimonial::all();
  }

  public function indexActive()
  {
    return Testimonial::where('isActive',1)->get();
  }

  public function store()
  {
    request()['roundedValue'] = ceil(request()->stars);
    return Testimonial::create(request()->all());
  }

  public function show(Testimonial $testimonial)
  {
    return $testimonial;
  }

  public function update(Testimonial $testimonial)
  {
    $testimonial->fill(request()->all())->save();
    return $testimonial;
  }

  public function destroy(Testimonial $testimonial)
  {
    $testimonial->delete();
  }
}
