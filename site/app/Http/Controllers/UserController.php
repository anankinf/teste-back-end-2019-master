<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function me() {
       return responder()->success(User::find(Auth::user()->id), function ($user) {
           return [
               'id' => $user->id,
               'name' => $user->name,
               'email' => $user->email,
           ];
       })->respond();
   }
}
