<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// KeberatanController telah dihapus dari sistem.
// Seluruh fitur Ajukan Keberatan tidak lagi digunakan.
class KeberatanController extends Controller
{
    public function __call($method, $args)
    {
        abort(404);
    }
}
