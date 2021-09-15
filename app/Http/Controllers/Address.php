<?php

namespace App\Http\Controllers;

use App\Models\Address;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->model == Address::class;
    }

}
