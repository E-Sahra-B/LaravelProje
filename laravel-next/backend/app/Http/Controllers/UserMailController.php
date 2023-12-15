<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMail;

class UserMailController extends Controller
{
    public function addMail(Request $request)
    {
        try {
            UserMail::create([
                'mail' => $request->mail
            ]);
            return response()->json(['status' => 'success', 'message' => 'Ekleme İşlemi Başarılı.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Hatalı İşlem.']);
        }
    }
}
