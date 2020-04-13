<?php

namespace App\Http\Controllers;

use App\Mail\BookAViewing;
use App\Mail\InquireProperties;
use App\Mail\OfferProperty;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  public function offerProperty(Request $request)
  {
    $request->validate([
      'primaryAddress' => 'required|max:255',
      'barangay' => 'required|max:255',
      'city' => 'required|max:255',
      'region' => 'required|max:255',
      'postalCode' => 'required|max:255',
      'propertyType' => 'required|max:255',
      'year' => 'required|numeric',
      'lotArea' => 'required|numeric',
      'floorArea' => 'required|numeric',
      'price' => 'required|numeric',
      'firstName' => 'required|max:255',
      'lastName' => 'required|max:255',
      'emailAddress' => 'required|email',
      'contactNumber' => 'required|numeric',
      'age' => 'required|numeric',
      'gender' => 'required|max:255',
      'occupation' => 'required|max:255',
    ]);

    $settings = Settings::where('name', 'emailReceiver')->first();
    Mail::to($settings->value)->send(new OfferProperty(request()));
    return response()->json(['message' => 'Email sent!', 'status' => true]);
  }

  public function bookAViewing(Request $request)
  {
    $request->validate([
      'propertyNumber' => 'required|max:255',
      'location' => 'required|max:255',
      'propertyType' => 'required|max:255',
      'firstName' => 'required|max:255',
      'lastName' => 'required|max:255',
      'minPrice' => 'required|numeric',
      'maxPrice' => 'required|numeric',
      'emailAddress' => 'required|email',
      'contactNumber' => 'required|numeric',
      'age' => 'required|numeric',
      'gender' => 'required|max:255',
      'occupation' => 'required|max:255',
      'schedule' => 'required|max:255',
      'notes' => 'required',
    ]);

    $settings = Settings::where('name', 'emailReceiver')->first();
    Mail::to($settings->value)->send(new BookAViewing(request()));
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

    $settings = Settings::where('name', 'emailReceiver')->first();
    Mail::to($settings->value)->send(new InquireProperties(request()));
    return response()->json(['message' => 'Email sent!', 'status' => true]);
  }
}
