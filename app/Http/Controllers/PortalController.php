<?php

namespace App\Http\Controllers;

class PortalController extends Controller
{
    public function index()
    {
        $data = config('portal');
        return view('portal.index', [
            'kabupaten'  => $data['kabupaten'],
            'provinsi'   => $data['provinsi'],
            'kecamatan'  => $data['kecamatan'],
        ]);
    }
}
