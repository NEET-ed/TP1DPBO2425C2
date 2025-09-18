<?php

// =================================================================
// Class BarangElektronik
// =================================================================
class BarangElektronik {
    private $id;
    private $nama;
    private $jenis;
    private $merek;
    private $harga;
    private $gambar;

    public function __construct($id, $nama, $jenis, $merek, $harga, $gambar) {
        $this->id = $id;
        $this->nama = $nama;
        $this->jenis = $jenis;
        $this->merek = $merek;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    // Fungsi Get
    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getJenis() { return $this->jenis; }
    public function getMerek() { return $this->merek; }
    public function getHarga() { return $this->harga; }
    public function getGambar() { return $this->gambar; }
    
    // Fungsi Set
    public function setNama($nama) { $this->nama = $nama; }
    public function setJenis($jenis) { $this->jenis = $jenis; }
    public function setMerek($merek) { $this->merek = $merek; }
    public function setHarga($harga) { $this->harga = $harga; }
    public function setGambar($gambar) { $this->gambar = $gambar; }
}

?>