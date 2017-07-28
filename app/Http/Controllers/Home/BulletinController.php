<?php

namespace App\Http\Controllers\Home;

use DDL\Models\Bulletin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BulletinController extends Controller
{


    /**
     * 公告
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $bulletin = Bulletin::orderBy('created_at', 'desc')->first();
        return view('home.bulletin.index')->withBulletin($bulletin);
    }



}
