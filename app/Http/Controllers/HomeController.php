<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // return view('home');
        $user = Auth::user();
        $folders = Folder::all();
        // ログインユーザーに紐づくフォルダを一つ取得する
        $folder = $user->folders->first();

        // まだ一つもフォルダを作っていなければホームページをレスポンスする
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダがあればそのフォルダのタスク一覧にリダイレクトする
        return redirect()->route('tasks.index', [
            'folders' => $folders,
            'id' => $folder->id,
        ]);
    }
}
