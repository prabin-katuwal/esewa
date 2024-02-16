<?php

namespace Prabin\Esewa\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EsewaController extends Controller
{
    public function success()
    {
        return 'ok';
    }
    public function failure(){
        return 'oko';
    }
}
