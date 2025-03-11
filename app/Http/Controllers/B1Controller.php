<?php

namespace App\Http\Controllers;

use App\Models\b1;
use Illuminate\Http\Request;

class B1Controller extends Controller
{
    public function index()
    {
        return response()->json(b1::all(), 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
