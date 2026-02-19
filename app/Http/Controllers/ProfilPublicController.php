<?php

namespace App\Http\Controllers;

class ProfilPublicController extends Controller
{
    public function profilPpid()
    {
        return view('profil-ppid');
    }

    public function tugasTanggungJawab()
    {
        return view('profil-tugas-tanggung-jawab');
    }

    public function visiMisi()
    {
        return view('profil-visi-misi');
    }

    public function strukturOrganisasi()
    {
        return view('profil-struktur-organisasi');
    }

    public function regulasi()
    {
        return view('profil-regulasi');
    }

    public function kontak()
    {
        return view('profil-kontak');
    }
}
