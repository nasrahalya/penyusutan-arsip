<?php

namespace App\Http\Controllers;

use App\Models\TertibArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TertibArsipController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:tertibArsip-list|tertibArsip-create|tertibArsip-edit|tertibArsip-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:tertibArsip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tertibArsip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tertibArsip-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TertibArsip::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if (Auth::user()->can('tertibArsip-edit')) {
                        $actionBtn = '<a href="' . route('tertibArsip.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if (Auth::user()->can('tertibArsip-list')) {
                        $actionBtn .= '<a href="' . route('tertibArsip.show', $row->id) . '" class="delete btn btn-primary btn-sm">Show</a>';
                    }
                    if (Auth::user()->can('tertibArsip-delete')) {
                        $actionBtn .= '<form action="' . route('tertibArsip.destroy', $row->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</button>
                    </form>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view(('tertibArsip.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tertibArsip.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_klasifikasi' => 'required',
            'uraian_klasifikasi' => 'required',
            'klasifikasi_keamanan'=> 'required',
            'hak_akses'=> 'required',
            'jadwal_aktif'=> 'required',
            'jadwal_inaktif'=> 'required',
            'ket'=> 'required',
        ]);

        TertibArsip::create($request->all());
        return redirect()->route('tertibArsip.index') 
                        ->with('success','Data Telah Disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TertibArsip $tertibArsip)
    {
        return view('tertibArsip.show',compact('tertibArsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TertibArsip $tertibArsip)
    {
        return view('tertibArsip.edit',compact('tertibArsip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TertibArsip $tertibArsip)
    {
        $request->validate([
            'kd_klasifikasi' => 'required',
            'uraian_klasifikasi' => 'required',
            'klasifikasi_keamanan'=> 'required',
            'hak_akses'=> 'required',
            'jadwal_aktif'=> 'required',
            'jadwal_inaktif'=> 'required',
            'ket'=> 'required',
        ]);

        $tertibArsip->update($request->all()); 
     
        return redirect()->route('tertibArsip.index') 
                        ->with('success','Tertib Arsip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TertibArsip $tertibArsip)
    {
        $tertibArsip->delete(); 
     
        return redirect()->route('tertibArsip.index') 
                        ->with('success','Tertib Arsip deleted successfully');
    }
}
