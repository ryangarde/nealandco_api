<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
  public function show()
  {
    $settings = Settings::select('name','value')->get();
    $data = null;
    foreach ($settings as $index => $setting) {
      $data[$setting->name] = $setting->value;
    }

    return $data;
    // return Settings::select('emailReceiver','facebookLink','instagramLink','youtubeLink','twitterLink','linkedInLink')->first();
  }

  public function setEmailReceiver(Request $request)
  {
    $settings = Settings::where('name', 'emailReceiver')->first();
    if($settings) {
      $settings->fill(['value' => $request->emailReceiver])->save();
    } else {
      Settings::create(['name' => 'emailReceiver', 'value' => $request->emailReceiver]);
    }

    return $settings;
  }

  public function setFacebookLink(Request $request)
  {
    $settings = Settings::where('name', 'facebookLink')->first();

    if($settings) {
      $settings->fill(['value' => $request->facebookLink])->save();
    } else {
      Settings::create(['name' => 'facebookLink', 'value' => $request->facebookLink]);
    }

    return $settings;
  }

  public function setYoutubeLink(Request $request)
  {
    $settings = Settings::where('name', 'youtubeLink')->first();

    if($settings) {
      $settings->fill(['value' => $request->youtubeLink])->save();
    } else {
      Settings::create(['name' => 'youtubeLink', 'value' => $request->youtubeLink]);
    }

    return $settings;
  }

  public function setInstagramLink(Request $request)
  {
    $settings = Settings::where('name', 'instagramLink')->first();

    if($settings) {
      $settings->fill(['value' => $request->instagramLink])->save();
    } else {
      Settings::create(['name' => 'instagramLink', 'value' => $request->instagramLink]);
    }

    return $settings;
  }

  public function setTwitterLink(Request $request)
  {
    $settings = Settings::where('name', 'twitterLink')->first();

    if($settings) {
      $settings->fill(['value' => $request->twitterLink])->save();
    } else {
      Settings::create(['name' => 'twitterLink', 'value' => $request->twitterLink]);
    }

    return $settings;
  }

  public function setLinkedInLink(Request $request)
  {
    $settings = Settings::where('name', 'linkedInLink')->first();

    if($settings) {
      $settings->fill(['value' => $request->linkedInLink])->save();
    } else {
      Settings::create(['name' => 'linkedInLink', 'value' => $request->linkedInLink]);
    }

    return $settings;
  }
}
