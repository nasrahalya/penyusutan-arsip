<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [ 
            'role-list', 
            'role-create', 
            'role-edit', 
            'role-delete',
            'tertibArsip-list', 
            'tertibArsip-create', 
            'tertibArsip-edit', 
            'tertibArsip-delete', 
            'daftarArsip-list', 
            'daftarArsip-create', 
            'daftarArsip-edit', 
            'daftarArsip-delete',
            'arsipInaktif-list', 
            'arsipInaktif-create', 
            'arsipInaktif-edit', 
            'arsipInaktif-delete',
            'penyusutan-list', 
            'penyusutan-create', 
            'penyusutan-edit', 
            'penyusutan-delete',
            'penyusutan-kirim',
            'user-list', 
            'user-create', 
            'user-edit', 
            'user-delete',
            'upload-file-arsip-inaktif',
            'upload-file-berita-acara',
            'upload-file-lampiran',
            'upload-file-tanda-tangan',

         ]; 
       
         foreach ($permissions as $permission) { 
              Permission::create(['name' => $permission]); 
         } 
    } 
}
