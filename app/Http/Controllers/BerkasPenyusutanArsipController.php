<?php

namespace App\Http\Controllers;

use App\Models\BerkasPenyusutanArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BerkasPenyusutanArsipController extends Controller
{

    function __construct()
    {
        $this->middleware(
            'permission:penyusutan-list|penyusutan-create|penyusutan-edit|penyusutan-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:penyusutan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:penyusutan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:penyusutan-delete', ['only' => ['destroy']]);
        $this->middleware('permission:penyusutan-kirim', ['only' => ['create','store']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BerkasPenyusutanArsip::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = "";
                    if (Auth::user()->can('penyusutan-edit')) {
                        $actionBtn .= '<a href="' . route('penyusutan.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }

                    if (Auth::user()->can('penyusutan-list')) {
                        $actionBtn .= '<a href="' . route('penyusutan.show', $row->id) . '" class="list btn btn-secondary btn-sm">Tampilan</a> ';
                    }
    
                    if (Auth::user()->can('penyusutan-kirim')) {
                        $actionBtn .= '<a href="' . route('penyusutan.kirim', $row->id) . '" class="kirim btn btn-primary btn-sm">Kirim</a> ';
                    }
    
                    if (Auth::user()->can('penyusutan-delete')) {
                        $actionBtn .= '<form action="' . route('penyusutan.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="delete btn btn-danger btn-sm">Hapus</button>
                        </form>';
                    }
    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('berkasPenyusutan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('berkasPenyusutan.create');
    }

    public function kirim($id){
        BerkasPenyusutanArsip::where('id','=',$id)->update([
            'status_kirim' => 'success'
        ]);

        return redirect()->back()->with('message','status updated to success');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_naskah' => 'required',
            'no_naskah' => 'required',
            'hal' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'file_arsip_inaktif' => 'required|mimes:pdf|max:2048',
            'file_berita_acara' => 'required|mimes:pdf|max:2048',
            'lampiran' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('file_arsip_inaktif')) {
            $file_arsip_inaktif = $request->file('file_arsip_inaktif');
            $file_arsip_inaktif_name = "inaktif". "-" . date('Y-m-d-H-i-s') . "." . $file_arsip_inaktif->getClientOriginalExtension();
            $file_arsip_inaktif->move('file_arsip_inaktif', $file_arsip_inaktif_name);
            $input['file_arsip_inaktif'] = $file_arsip_inaktif_name;
        }

        if ($request->hasFile('file_berita_acara')) {
            $file_berita_acara = $request->file('file_berita_acara');
            $file_berita_acara_name = "berita_acara_" . "-" . date('Y-m-d-H-i-s') . "." . $file_berita_acara->getClientOriginalExtension();
            $file_berita_acara->move('file_berita_acara', $file_berita_acara_name);
            $input['file_berita_acara'] = $file_berita_acara_name;
        }

        if ($request->hasFile('status_penandatanganan')) {
            $status_penandatanganan = $request->file('status_penandatanganan');
            $status_penandatanganan_name = "status_penandatanganan_" . "-" . date('Y-m-d-H-i-s') . "." . $status_penandatanganan->getClientOriginalExtension();
            $status_penandatanganan->move('status_penandatanganan', $status_penandatanganan_name);
            $input['status_penandatanganan'] = $status_penandatanganan_name;
        }

        if ($request->hasFile('lampiran')) {
            $file_lampiran = $request->file('lampiran');
            $file_lampiran_name = "lampiran_" .  "-" . date('Y-m-d-H-i-s') . "." . $file_lampiran->getClientOriginalExtension();
            $file_lampiran->move('lampiran', $file_lampiran_name);
            $input['lampiran'] = $file_lampiran_name;
        }
        $input['status_kirim'] = "on process";

        BerkasPenyusutanArsip::create($input);
        return redirect()->route('penyusutan.index')->with('success', 'Data Telah Disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berkasPenyusutanArsip = BerkasPenyusutanArsip::findOrFail($id);
        return view('berkasPenyusutan.show', compact('berkasPenyusutanArsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $berkasPenyusutanArsip = BerkasPenyusutanArsip::findOrFail($id);
        return view('berkasPenyusutan.edit', compact('berkasPenyusutanArsip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $input = $request->all();
        if ($file_arsip_inaktif = $request->file('file_arsip_inaktif')) {
            $destinationPath = 'file_arsip_inaktif/';
            $file_arsip_inaktif_name = "inaktif". "-" . date('Y-m-d-H-i-s') . "." . $file_arsip_inaktif->getClientOriginalExtension();
            $file_arsip_inaktif->move($destinationPath, $file_arsip_inaktif_name);
            $input['file_arsip_inaktif'] = $file_arsip_inaktif_name;
        }
        if ($file_berita_acara = $request->file('file_berita_acara')) {
            $destinationPath = 'file_berita_acara/';
            $file_berita_acara_name = "berita_acara_" . "-" . date('Y-m-d-H-i-s') . "." . $file_berita_acara->getClientOriginalExtension();
            $file_berita_acara->move($destinationPath, $file_berita_acara_name);
            $input['file_berita_acara'] = $file_berita_acara_name;
        }

        if ($request->hasFile('lampiran')) {
            $file_lampiran = $request->file('lampiran');
            $file_lampiran_name = "lampiran_" .  "-" . date('Y-m-d-H-i-s') . "." . $file_lampiran->getClientOriginalExtension();
            $file_lampiran->move('lampiran', $file_lampiran_name);
            $input['lampiran'] = $file_lampiran_name;
        }

        if ($request->hasFile('status_penandatanganan')) {
            $status_penandatanganan = $request->file('status_penandatanganan');
            $status_penandatanganan_name = "status_penandatanganan_" . "-" . date('YmdHis') . "." . $status_penandatanganan->getClientOriginalExtension();
            $status_penandatanganan->move('status_penandatanganan/', $status_penandatanganan_name);
            $input['status_penandatanganan'] = $status_penandatanganan_name;
        }else{
            $input['status_penandatanganan'] = "konvensional";
        }
        $berkasPenyusutanArsip = BerkasPenyusutanArsip::findOrFail($id)->update($input);
        // dd();
        // $berkasPenyusutanArsip->update($input);

        return redirect()->route('penyusutan.index')
            ->with('success', 'Berkas Penyusutan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berkasPenyusutanArsip = BerkasPenyusutanArsip::findOrFail($id);
        $berkasPenyusutanArsip->delete();
        return redirect()->route('penyusutan.index')
            ->with('success', 'Berkas Penyusutan deleted successfully');
    }
}
