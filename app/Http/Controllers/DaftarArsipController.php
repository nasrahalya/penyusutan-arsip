<?php

namespace App\Http\Controllers;

use App\Models\DaftarArsip;
use App\Models\TertibArsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DaftarArsipController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:daftarArsip-list|daftarArsip-create|daftarArsip-edit|daftarArsip-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:daftarArsip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:daftarArsip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:daftarArsip-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DaftarArsip::with('tertib')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Auth::user()->can('daftarArsip-edit')) {
                        $actionBtn = '<a href="' . route('daftarArsip.edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a> ';
                    }
                    if (Auth::user()->can('daftarArsip-list')) {
                        $actionBtn .= '<a href="' . route('daftarArsip.show', $row->id) . '" class="delete btn btn-primary btn-sm">Show</a>';
                    }
                    if (Auth::user()->can('daftarArsip-delete')) {
                        $actionBtn .= '<form action="' . route('daftarArsip.destroy', $row->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</button>
                    </form>';
                    }
                    return $actionBtn;
                })->addColumn('kd_klasifikasi', function ($row) {
                    return $row->tertib->kd_klasifikasi;
                })->addColumn('uraian_klasifikasi', function ($row) {
                    return $row->tertib->uraian_klasifikasi;
                })->addColumn('klasifikasi_keamanan', function ($row) {
                    return $row->tertib->klasifikasi_keamanan;
                })->addColumn('hak_akses', function ($row) {
                    return $row->tertib->hak_akses;
                })->addColumn('ket', function ($row) {
                    return $row->tertib->ket;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view(('daftarArsip.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tertib = TertibArsip::get();
        return view('daftarArsip.create', compact('tertib'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tertib' => 'required',
            'uraian_informasi_berkas' => 'required',
            'no_berkas' => 'required',
            'no_item_berkas' => 'required',
            'tanggal' => 'required',
            'tingkat_perkembangan' => 'required',
            'jmlh_berkas' => 'required',
            'lokasi_simpan' => 'required',
            "file_arsip" => 'required|mimes:pdf|max:5120',
        ]);


        $input = $request->all();

        if ($file_arsip = $request->file('file_arsip')) {
            $destinationPath = 'file_arsip/';
            $file_arsip_name = $input["uraian_informasi_berkas"] . "-" . date('YmdHis') . "." . $file_arsip->getClientOriginalExtension();
            $file_arsip->move($destinationPath, $file_arsip_name);
            $input['file_arsip'] = $file_arsip_name;
        }

        $tertib = TertibArsip::find($request->id_tertib);
        $aktif = $tertib->jadwal_aktif;
        $inaktif = $tertib->jadwal_inaktif;

        $aktif_years = [
            '1 tahun' => 1,
            '2 tahun' => 2,
            '3 tahun' => 3,
            '4 tahun' => 4,
            '5 tahun' => 5,
            '6 tahun' => 6,
            '7 tahun' => 7,
            '8 tahun' => 8,
            '9 tahun' => 9,
            '10 tahun' => 10
        ];

        if (isset($aktif_years[$aktif])) {
            $aktif = $aktif_years[$aktif];
            $tanggal = $request->tanggal;
            $jadwal_aktif = date('Y-m-d', strtotime($tanggal . ' + ' . $aktif . ' years'));
        }

        if (isset($aktif_years[$inaktif])) {
            $inaktif = $aktif_years[$inaktif];
            $jadwal_inaktif = date('Y-m-d', strtotime($jadwal_aktif . ' + ' . $inaktif . ' years'));
        }


        $input['jadwal_aktif'] = $jadwal_aktif;
        $input['jadwal_inaktif'] = $jadwal_inaktif;

        DaftarArsip::create($input);
        return redirect()->route('daftarArsip.index')
            ->with('success', 'Data Telah Disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarArsip $daftarArsip)
    {
        $tertib = TertibArsip::get();
        return view('daftarArsip.show', compact('daftarArsip', 'tertib'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarArsip $daftarArsip)
    {
        $tertib = TertibArsip::get();
        return view('daftarArsip.edit', compact('daftarArsip', 'tertib'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarArsip $daftarArsip)
    {
        $request->validate([
            'id_tertib' => 'required',
            'uraian_informasi_berkas' => 'required',
            'no_berkas' => 'required',
            'no_item_berkas' => 'required',
            'tanggal' => 'required',
            'tingkat_perkembangan' => 'required',
            'jmlh_berkas' => 'required',
            'lokasi_simpan' => 'required',
            "file_arsip" => 'required|mimes:pdf|max:5120',
        ]);

        $input = $request->all();
        if ($file_arsip = $request->file('file_arsip')) {
            $destinationPath = 'file_arsip/';
            $file_arsip_name = $input["uraian_informasi_berkas"] . "-" . date('YmdHis') . "." . $file_arsip->getClientOriginalExtension();
            $file_arsip->move($destinationPath, $file_arsip_name);
            $input['file_arsip'] = $file_arsip_name;
        }

        $daftarArsip->update($input);

        return redirect()->route('daftarArsip.index')
            ->with('success', 'Daftar Arsip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarArsip $daftarArsip)
    {
        $daftarArsip->delete();

        return redirect()->route('daftarArsip.index')
            ->with('success', 'Daftar Arsip deleted successfully');
    }

    public function daftararsipinaktif(){
        $data = DaftarArsip::whereNotNull('jadwal_inaktif')->with("tertib")->get();

        // return response()->json($data);
        return view('daftararsip.daftararsipinaktif',compact('data'));
    }
}
