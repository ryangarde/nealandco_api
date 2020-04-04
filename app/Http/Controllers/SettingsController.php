<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  public function show()
  {
    return auth()->user()->setting;
  }

  public function setEmailReceiver(Request $request)
  {
    $settings = Settings::where('user_id', auth()->user()->id)->first();
    $settings->fill(['emailReceiver' => $request->emailReceiver])->save();

    return auth()->user()->setting;
  }
}
