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
    Mail::to(env('MAIL_USERNAME'))->send(new OfferProperty(request()));
    return response()->json(['message' => 'Email sent!', 'status' => true]);
  }

  public function bookAViewing()
  {
    Mail::to(env('MAIL_USERNAME'))->send(new BookAViewing(request()));
    return response()->json(['message' => 'Email sent!', 'status' => true]);
  }

  public function inquireProperties(Request $request)
  {
    if($request->origin == 'Contact Us') {
      $request->validate([
        'emailAddress' => 'required|email',
        'fullName' => 'required',
        'address' => 'required',
        'contactNumber' => 'required|numeric',
      ]);
    }
    
    if($request->origin == 'Inquire Property') {
      $request->validate([
        'emailAddress' => 'required|email',
        'firstName' => 'required',
        'lastName' => 'required',
        'contactNumber' => 'required|numeric',
      ]);
    }

    Mail::to(env('MAIL_USERNAME'))->send(new InquireProperties(request()));
    return response()->json(['message' => 'Email sent!', 'status' => true]);
  }
}
