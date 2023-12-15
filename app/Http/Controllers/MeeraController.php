<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class MeeraController extends Controller
{
   public function home(){
    // $student = Student::create(
    //     ['name' => 'meera.mu',
    //     'age' => 26]
    // );

    //$student = Student::where('name','meera.mu')->get();

    $student = Student::where('name','meera.ms')->delete();

    return response()->json($student);
   }
}
