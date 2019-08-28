<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PieChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        function addBasicAuth($header, $username, $password) {
            $header['Authorization'] = 'Basic '.base64_encode("$username:$password");
            return $header;
        }
       
        return view('PieChart');
    }
}
