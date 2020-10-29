<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function show(Request $request, RentalServer $site)
    {
        return view('sites.show', compact('site'));
    }

    public function create(Request $request)
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
    }

    public function update(Request $request, RentalServer $site)
    {
        return view('sites.update');
    }

    public function delete(Request $request, RentalServer $site)
    {
        return view('sites.delete');
    }
}
