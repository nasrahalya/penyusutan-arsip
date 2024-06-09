@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Berkas Penyusutan</h2>
            </div>
            </br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('penyusutan.index') }}">back</a>
            </div>
            </br>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your
            input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penyusutan.update', $berkasPenyusutanArsip->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Naskah:</strong>
                    <input type="date" name="tgl_naskah" value="{{ $berkasPenyusutanArsip->tgl_naskah }}"
                        class="form-control" placeholder="Tanggal Naskah">
                </div>
                <div class="form-group">
                    <strong>Nomor Naskah:</strong>
                    <input type="text" name="no_naskah" value="{{ $berkasPenyusutanArsip->no_naskah }}"
                        class="form-control" placeholder="Nomor Naskah">
                </div>
                <div class="form-group">
                    <strong>Hal:</strong>
                    <input type="text" name="hal" value="{{ $berkasPenyusutanArsip->hal }}" class="form-control"
                        placeholder="Hal">
                </div>
                <div class="form-group">
                    <strong>Unit Pengirim:</strong>
                    <input type="text" name="pengirim" value="{{ $berkasPenyusutanArsip->pengirim }}"
                        class="form-control" placeholder="Unit Pengirim">
                </div>
                <div class="form-group">
                    <strong>Unit Penerima:</strong>
                    <input type="text" name="penerima" value="{{ $berkasPenyusutanArsip->penerima }}"
                        class="form-control" placeholder="Unit Penerima">
                </div>
                @if (Auth::user()->can('upload-file-arsip-inaktif'))
                    <div class="form-group">
                        <strong>File Arsip Inaktif:</strong>
                        <input type="file" name="file_arsip_inaktif"
                            value="{{ $berkasPenyusutanArsip->file_arsip_inaktif }}" class="form-control"
                            placeholder="File Arsip Inaktif">
                    </div>
                @endif
                @if (Auth::user()->can('upload-file-berita-acara'))
                    <div class="form-group">
                        <strong>File Berita Acara:</strong>
                        <input type="file" name="file_berita_acara"
                            value="{{ $berkasPenyusutanArsip->file_berita_acara }}" class="form-control"
                            placeholder="File Berita Acara">
                    </div>
                @endif
                @if (Auth::user()->can('upload-file-tanda-tangan'))
                    <div class="form-group">
                        <strong>Status Penandatanganan:</strong>
                        <select id="statusDropdown" class="form-control" name="status_dropdown">
                            <option value="digital">Digital</option>
                            <option value="physical">Konvensional</option>
                        </select>
                    </div>
                    <div class="form-group" id="statusPenandatangananField" style="display: none;">
                        <strong>Status Penandatanganan:</strong>
                        <input type="file" name="status_penandatanganan"
                            value="{{ $berkasPenyusutanArsip->status_penandatanganan }}" class="form-control"
                            placeholder="Status Penandatanganan">
                    </div>
                @endif

            </div>
            @if (Auth::user()->can('upload-file-lampiran'))
                <div class="form-group">
                    <strong>Lampiran:</strong>
                    <input type="file" name="lampiran" value="{{ $berkasPenyusutanArsip->lampiran }}"
                        class="form-control" placeholder="Lampiran">
                </div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </div>

    </form>

    <script>
        document.getElementById('statusDropdown').addEventListener('change', function() {
            var selectedOption = this.value;

            // Show the statusPenandatangananField if "digital" is selected, hide it otherwise
            var statusPenandatangananField = document.getElementById('statusPenandatangananField');
            if (selectedOption === 'digital') {
                statusPenandatangananField.style.display = 'block';
            } else {
                statusPenandatangananField.style.display = 'none';
            }
        });
    </script>

@endsection
