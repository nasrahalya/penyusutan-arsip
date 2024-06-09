<?php

namespace App\Http\Controllers;

use App\Models\DaftarArsipInaktif;
use Illuminate\Http\Request;

class DaftarArsipInaktifController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:arsipInaktif-list|arsipInaktif-create|arsipInaktif-edit|arsipInaktif-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:arsipInaktif-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:arsipInaktif-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:arsipInaktif-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarArsipInaktif $daftarArsipInaktif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarArsipInaktif $daftarArsipInaktif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarArsipInaktif $daftarArsipInaktif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarArsipInaktif $daftarArsipInaktif)
    {
        //
    }
}
