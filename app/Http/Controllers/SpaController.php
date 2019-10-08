<?php
/**
 * @author Vitaliy Viznyuk <vitaliyviznyuk@gmail.com>
 * @copyright Copyright (c) 2019 Vitaliy Viznyuk
 */

namespace App\Http\Controllers;

class SpaController extends Controller
{
    public function index()
    {
        return view('spa');
    }
}
