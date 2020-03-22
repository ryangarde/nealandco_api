<?php

namespace App\Http\Controllers;

use App\Mail\BookAViewing;
use App\Mail\InquireProperties;
use App\Mail\OfferProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  public function offerProperty()
  {
    Mail::to(request()->emailAddress)->send(new OfferProperty(request()));
    return response()->json(['message' => 'Email sent!']);
  }

  public function bookAViewing()
  {
    Mail::to(request()->emailAddress)->send(new BookAViewing(request()));
    return response()->json(['message' => 'Email sent!']);
  }

  public function inquireProperties()
  {
    Mail::to(request()->emailAddress)->send(new InquireProperties(request()));
    return response()->json(['message' => 'Email sent!']);
  }
}
