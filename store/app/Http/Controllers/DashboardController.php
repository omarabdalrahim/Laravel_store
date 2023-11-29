<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){


        // return response:view ,json , redirect,file



        // compact لاحظ أن يمكن تمرير متغير الي الفيو عن طريق المصفوفة او داله
        // return view('dashboard',['user'=>'Omar Abdalrahim']);


        // compact : داله تقوم باارجاع مصفوفة للبيانات او المتغيرات اللي يتم تمررها ليها
        $name = 'Omar Abdalrahim';
        return view('dashboard.index',compact('name'));

    }
}
