<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function registrationForm()
    {
        (!empty($_SESSION["_errors"])) ? $errors = $_SESSION["_errors"] : $errors = [];
        return view("registrationForm", ["errors" => $errors]);
    }

}
