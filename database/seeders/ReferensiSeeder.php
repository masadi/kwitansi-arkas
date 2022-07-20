<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Program;
use App\Models\Sub_program;
use App\Models\Kegiatan;
use App\Models\Kode_rekening;
use App\Models\Tahun_anggaran;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
class ReferensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sheets = (new FastExcel)->withSheetsNames()->importSheets(public_path('referensi.xlsx'));
        $programs = $sheets['program'];
        foreach($programs as $program){
            Program::updateOrCreate([
                'kode' => $program['KODE'],
                'uraian' => $program['URAIAN'],
            ]);
        }
        $this->command->info('Program injected');
        $sub_programs = $sheets['sub_program'];
        foreach($sub_programs as $sub_program){
            Sub_program::updateOrCreate([
                'kode' => $sub_program['KODE'],
                'uraian' => $sub_program['URAIAN'],
            ]);
        }
        $this->command->info('Sub_program injected');
        $kegiatans = $sheets['kegiatan'];
        foreach($kegiatans as $kegiatan){
            Kegiatan::updateOrCreate([
                'kode' => $kegiatan['KODE'],
                'uraian' => $kegiatan['URAIAN'],
            ]);
        }
        $this->command->info('Kegiatan injected');
        $kode_rekenings = $sheets['kode_rekening'];
        foreach($kode_rekenings as $kode_rekening){
            Kode_rekening::updateOrCreate([
                'kode' => $kode_rekening['KODE'],
                'uraian' => $kode_rekening['URAIAN'],
            ]);
        }
        $this->command->info('Kode_rekening injected');
        $tahun_anggaran = Tahun_anggaran::updateOrCreate([
            'tahun_anggaran_id' => 2022,
            'nama' => 'Tahun Anggaran 2022',
            'periode_aktif' => 1,
        ]);
        $this->command->info('Tahun_anggaran injected');
        $team = Team::updateOrCreate([
            'name' => $tahun_anggaran->nama,
            'display_name' => $tahun_anggaran->nama,
        ]);
        $admin = Role::where('name', 'admin')->first();
        $user = User::updateOrCreate([
            'name' => 'Mas Adi',
            'email' => 'masadi.com@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Bismill4h#'),
        ]);
        $user->attachRole($admin, $team);
    }
}
