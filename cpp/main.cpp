#include "BarangElektronik.cpp"
#include <bits/stdc++.h>

using namespace std;


int main() {
    vector<BarangElektronik> daftarBarang;
    int nextId = 1;
    int choice;

    do {

        // Print menu
        cout << "\nMenu Toko Elektronik:" << endl;
        cout << "1. Tambah Data" << endl;
        cout << "2. Tampilkan Data" << endl;
        cout << "3. Ubah Data" << endl;
        cout << "4. Hapus Data" << endl;
        cout << "5. Cari Data" << endl;
        cout << "6. Keluar" << endl;
        cout << "Pilih menu: ";
        cin >> choice;

        // Error Handling cpp input
        if (cin.fail()) {
            cin.clear();
            cin.ignore(numeric_limits<streamsize>::max(), '\n');
            cout << "Input tidak valid. Silakan masukkan angka." << endl;
            continue;
        }

        // deklarasi var utk dimasuk ke class
        string nama, jenis, merek;
        double harga;
        int id, foundIndex = -1;
        size_t i;

        switch (choice) {
            case 1: 
            // Tambah Data
                cout << "Masukkan nama barang: ";
                cin.ignore();
                getline(cin, nama);
                cout << "Masukkan jenis (laptop, handphone, dll.): ";
                getline(cin, jenis);
                cout << "Masukkan merek: ";
                getline(cin, merek);
                cout << "Masukkan harga: ";
                cin >> harga;
                
                daftarBarang.push_back(BarangElektronik(nextId++, nama, jenis, merek, harga));
                cout << "Data berhasil ditambahkan!" << endl;
                break;

            case 2: 
            // Tampilkan Data
                if (daftarBarang.empty()) {
                    // kasus no data
                    cout << "Tidak ada data yang tersedia." << endl;
                }else{
                    // var utk kolom tabel
                    int wId = 5, wNama = 10, wJenis = 10, wMerek = 10, wHarga = 12;

                    for (auto& barang : daftarBarang) {
                        wNama = max(wNama, (int)barang.getNama().size() + 2);
                        wJenis = max(wJenis, (int)barang.getJenis().size() + 2);
                        wMerek = max(wMerek, (int)barang.getMerek().size() + 2);
                    }

                    // Cetak header tabel
                    cout << string(wId + wNama + wJenis + wMerek + wHarga + 10, '-') << endl;
                    cout << left << setw(wId) << "ID" << setw(wNama) << "Nama" << setw(wJenis) << "Jenis" << setw(wMerek) << "Merek" << setw(wHarga) << "Harga"  << endl;
                    cout << string(wId + wNama + wJenis + wMerek + wHarga + 10, '-') << endl;

                    // Cetak isi tabel
                    for (auto& barang : daftarBarang) {
                        cout << left << setw(wId) << barang.getId() << setw(wNama) << barang.getNama() << setw(wJenis) << barang.getJenis() << setw(wMerek) << barang.getMerek() << "Rp. " << fixed << setprecision(0) << barang.getHarga() << endl;
                    }
                    cout << string(wId + wNama + wJenis + wMerek + wHarga + 10, '-') << endl;
                }
                break;

            case 3: 
            // Ubah Data
                cout << "Masukkan ID barang yang akan diubah: ";
                cin >> id;

                foundIndex = -1;
                i = 0;
                while (i < daftarBarang.size()) {
                    if (daftarBarang[i].getId() == id) {
                        foundIndex = i;
                        break;
                    }
                    i++;
                }


                if (foundIndex != -1) {
                    // input data yang akan di-update
                    cout << "Masukkan nama baru: ";
                    cin.ignore();
                    getline(cin, nama);
                    cout << "Masukkan jenis baru: ";
                    getline(cin, jenis);
                    cout << "Masukkan merek baru: ";
                    getline(cin, merek);
                    cout << "Masukkan harga baru: ";
                    cin >> harga;
                    
                    daftarBarang[foundIndex].setNama(nama);
                    daftarBarang[foundIndex].setJenis(jenis);
                    daftarBarang[foundIndex].setMerek(merek);
                    daftarBarang[foundIndex].setHarga(harga);
                    cout << "Data berhasil diubah." << endl;
                } else {
                    cout << "ID tidak ditemukan." << endl;
                }
                break;
            
            case 4: 
            // Hapus Data
                cout << "Masukkan ID barang yang akan dihapus: ";
                cin >> id;
                
                // cari data
                foundIndex = -1;
                i = 0;
                while (i < daftarBarang.size()) {
                    if (daftarBarang[i].getId() == id) {
                        foundIndex = i;
                        break;
                    }
                    i++;
                }


                if (foundIndex != -1) {
                    daftarBarang.erase(daftarBarang.begin() + foundIndex);
                    cout << "Data berhasil dihapus." << endl;
                } else {
                    cout << "ID tidak ditemukan." << endl;
                }
                break;

            case 5: 
            // Cari Data
                cout << "Masukkan ID barang yang dicari: ";
                cin >> id;

                // cari data
                foundIndex = -1;
                i = 0;
                while (i < daftarBarang.size()) {
                    if (daftarBarang[i].getId() == id) {
                        foundIndex = i;
                        break;
                    }
                    i++;
                }


                // print data jika ditemukan
                if (foundIndex != -1) {
                    cout << "--------------------------------------------------------" << endl;
                    cout << "Data Ditemukan:" << endl;
                    cout << "ID: " << daftarBarang[foundIndex].getId() << endl;
                    cout << "Nama: " << daftarBarang[foundIndex].getNama() << endl;
                    cout << "jenis: " << daftarBarang[foundIndex].getJenis() << endl;
                    cout << "jenis: " << daftarBarang[foundIndex].getMerek() << endl;
                    cout << "Harga: Rp" << daftarBarang[foundIndex].getHarga() << endl;
                    cout << "--------------------------------------------------------" << endl;
                } else {
                    cout << "ID tidak ditemukan." << endl;
                }
                break;
            
            case 6: 
            // Keluar
                cout << "Program selesai. Sampai jumpa!" << endl;
                break;

            default:
                cout << "Pilihan tidak valid. Silakan coba lagi." << endl;
                break;
        }

    } while (choice != 6);

    return 0;
}