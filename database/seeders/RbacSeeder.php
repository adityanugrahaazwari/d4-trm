<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Permissions
        $permissions = [
            [
                'name' => 'Kelola Pengguna & Peran',
                'slug' => 'manage-users',
                'module' => 'Administrasi & Keamanan',
                'description' => 'Membuat, mengubah peran, mengatur hak akses, dan menonaktifkan akun pengelola.',
            ],
            [
                'name' => 'Kelola Konfigurasi Website',
                'slug' => 'manage-settings',
                'module' => 'Konfigurasi Sistem',
                'description' => 'Mengatur identitas situs, logo, favicon, homepage banner hero, dan tautan sosial media.',
            ],
            [
                'name' => 'Kelola Profil Prodi',
                'slug' => 'manage-profile',
                'module' => 'Profil & Informasi',
                'description' => 'Mengelola sejarah, visi misi, sambutan ketua prodi, dan struktur organisasi.',
            ],
            [
                'name' => 'Kelola Data Dosen & Tendik',
                'slug' => 'manage-staff',
                'module' => 'Akademik & Pengajaran',
                'description' => 'Memperbarui profil tenaga pengajar, bidang keahlian dosen, NIDN, dan tenaga kependidikan.',
            ],
            [
                'name' => 'Kelola Kurikulum & Akademik',
                'slug' => 'manage-academic',
                'module' => 'Akademik & Pengajaran',
                'description' => 'Mengelola struktur kurikulum, sebaran SKS mata kuliah, kalender akademik, CPL, dan profil lulusan.',
            ],
            [
                'name' => 'Kelola Berita & Pengumuman',
                'slug' => 'manage-news',
                'module' => 'Konten & Publikasi',
                'description' => 'Menulis, mengedit, mempublikasikan, dan menghapus artikel warta berita, kategori, serta pengumuman.',
            ],
            [
                'name' => 'Kelola Album & Foto Galeri',
                'slug' => 'manage-gallery',
                'module' => 'Konten & Publikasi',
                'description' => 'Mengelola album kegiatan, dokumentasi pameran, dan showcase karya animasi/game mahasiswa.',
            ],
            [
                'name' => 'Kelola Fasilitas & Laboratorium',
                'slug' => 'manage-facilities',
                'module' => 'Sarana & Prasarana',
                'description' => 'Mengelola inventaris studio multimedia, lab komputer rendering, alat rekam audio, dan spesifikasi lab.',
            ],
            [
                'name' => 'Manajemen Berkas Media',
                'slug' => 'upload-media',
                'module' => 'Media & Aset',
                'description' => 'Mengunggah gambar, dokumen pendukung, panduan akademik, dan file aset multimedia ke server.',
            ],
        ];

        $permissionModels = [];
        foreach ($permissions as $p) {
            $permissionModels[$p['slug']] = Permission::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }

        // 2. Seed Roles
        $roles = [
            [
                'name' => 'Super Administrator',
                'slug' => 'superadmin',
                'description' => 'Akses penuh tanpa batas ke semua modul, konfigurasi keamanan, dan hak istimewa sistem.',
                'badge' => 'bg-purple-100 text-purple-800 border-purple-200',
                'permissions' => array_keys($permissionModels), // All permissions
            ],
            [
                'name' => 'Administrator Akademik',
                'slug' => 'admin-akademik',
                'description' => 'Pengelolaan data kurikulum, silabus mata kuliah, kalender akademik, CPL, profil lulusan, dosen & tendik.',
                'badge' => 'bg-blue-100 text-blue-800 border-blue-200',
                'permissions' => ['manage-profile', 'manage-staff', 'manage-academic', 'upload-media'],
            ],
            [
                'name' => 'Administrator Konten & Media',
                'slug' => 'admin-konten',
                'description' => 'Penerbitan warta berita, agenda kegiatan, pengumuman resmi, album dokumentasi galeri, dan berkas media.',
                'badge' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'permissions' => ['manage-news', 'manage-gallery', 'upload-media'],
            ],
            [
                'name' => 'Operator Fasilitas & Laboratorium',
                'slug' => 'operator-lab',
                'description' => 'Pencatatan sarana prasarana, spesifikasi alat multimedia, jadwal studio animasi, dan lab komputer grafik.',
                'badge' => 'bg-amber-100 text-amber-800 border-amber-200',
                'permissions' => ['manage-facilities', 'upload-media'],
            ],
            [
                'name' => 'Editor Publikasi',
                'slug' => 'editor',
                'description' => 'Menyusun draf berita, pengumuman, dan artikel informasi sebelum disetujui untuk dipublikasikan.',
                'badge' => 'bg-slate-100 text-slate-800 border-slate-200',
                'permissions' => ['manage-news', 'upload-media'],
            ],
        ];

        $roleModels = [];
        foreach ($roles as $r) {
            $rolePermSlugs = $r['permissions'];
            unset($r['permissions']);

            $role = Role::updateOrCreate(
                ['slug' => $r['slug']],
                $r
            );

            // Sync permissions for this role
            $permIds = collect($rolePermSlugs)
                ->map(fn ($slug) => $permissionModels[$slug]->id ?? null)
                ->filter()
                ->all();

            $role->permissions()->sync($permIds);
            $roleModels[$r['slug']] = $role;
        }

        // 3. Associate Existing Users to Roles via role_id
        foreach ($roleModels as $slug => $role) {
            User::where('role', $slug)->update(['role_id' => $role->id]);
        }
    }
}
