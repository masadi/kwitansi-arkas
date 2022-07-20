<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tahun_anggaran;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $tahun_anggaran = Tahun_anggaran::find($this->request->tahun_anggaran_id);
        $this->request->session()->put('tahun_anggaran_id', $tahun_anggaran->tahun_anggaran_id);
        $this->request->session()->put('tahun_anggaran', $tahun_anggaran->nama);
        $user = $event->user;
        $user->team = $tahun_anggaran->nama;
        $user->save();
    }
}
