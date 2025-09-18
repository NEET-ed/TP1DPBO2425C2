#include <bits/stdc++.h>

using namespace std;

class BarangElektronik {
    private:
        int id;
        string nama;
        string jenis;
        string merek;
        double harga;

    public:
        // Constructor
        BarangElektronik(int id, string nama, string jenis, string merek, double harga) {
            this->id = id;
            this->nama = nama;
            this->jenis = jenis;
            this->merek = merek;
            this->harga = harga;
        }

        // Setters
        void setNama(string nama) {
            this->nama = nama;
        }
        void setJenis(string jenis) {
            this->jenis = jenis;
        }
        void setMerek(string merek) {
            this->merek = merek;
        }
        void setHarga(double harga) {
            this->harga = harga;
        }

        // Getters
        int getId() {
            return this->id;
        }
        string getNama() {
            return this->nama;
        }
        string getJenis() {
            return this->jenis;
        }
        string getMerek() {
            return this->merek;
        }
        double getHarga() {
            return this->harga;
        }
};
