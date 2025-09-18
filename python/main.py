from BarangElektronik import BarangElektronik



def main():
    daftar_barang = []
    next_id = 1

    while True:
        print("\nMenu Toko Elektronik:")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("3. Ubah Data")
        print("4. Hapus Data")
        print("5. Cari Data")
        print("6. Keluar")

        # input awal
        choice = input("Pilih menu: ")

        if choice == "1":  
        # Tambah Barang
            nama = input("Masukkan nama barang: ")
            jenis = input("Masukkan jenis (laptop, handphone, dll.): ")
            merek = input("Masukkan merek: ")
            harga = float(input("Masukkan harga: "))
            daftar_barang.append(BarangElektronik(next_id, nama, jenis, merek, harga))
            next_id += 1
            print("Data berhasil ditambahkan!")

        elif choice == "2":  
        # Tampilkan Data
            if not daftar_barang:
                print("Tidak ada data yang tersedia.")
                return

            width_id = 5
            width_nama = max(10, max(len(b.get_nama()) for b in daftar_barang) + 2)
            width_jenis = max(10, max(len(b.get_jenis()) for b in daftar_barang) + 2)
            width_merek = max(10, max(len(b.get_merek()) for b in daftar_barang) + 2)
            width_harga = 15

            total_width = width_id + width_nama + width_jenis + width_merek + width_harga + 5
            print("-" * total_width)
            print(f"{'ID'.ljust(width_id)}{'Nama'.ljust(width_nama)}{'Jenis'.ljust(width_jenis)}"
                f"{'Merek'.ljust(width_merek)}{'Harga'.ljust(width_harga)}")
            print("-" * total_width)

            for b in daftar_barang:
                print(f"{str(b.get_id()).ljust(width_id)}{b.get_nama().ljust(width_nama)}"
                    f"{b.get_jenis().ljust(width_jenis)}{b.get_merek().ljust(width_merek)}"
                    f"Rp{int(b.get_harga())}".ljust(width_harga))
            print("-" * total_width)

        elif choice == "3":  
        # Update Barang
            idc = int(input("Masukkan ID barang yang akan diubah: "))
            # Cari barang dengan ID
            found = None
            i = 0
            while i < len(daftar_barang):
                if daftar_barang[i].get_id() == idc:
                    found = daftar_barang[i]
                    break
                i += 1
            
            # minta user update jika ditemukan
            if found:
                found.set_nama(input("Masukkan nama baru: "))
                found.set_jenis(input("Masukkan jenis baru: "))
                found.set_merek(input("Masukkan merek baru: "))
                found.set_harga(float(input("Masukkan harga baru: ")))
                print("Data berhasil diubah.")
            else:
                print("ID tidak ditemukan.")

        elif choice == "4":  
        # Hapus Barang
            idc = int(input("Masukkan ID barang yang akan dihapus: "))
            i = 0
            found = False
            while i < len(daftar_barang):
                if daftar_barang[i].get_id() == idc:
                    del daftar_barang[i]
                    print("Data berhasil dihapus.")
                    found = True
                    break
                i += 1

            if not found:
                print("ID tidak ditemukan.")

        elif choice == "5": 
        # Cari Barang
            idc = int(input("Masukkan ID barang yang dicari: "))
            # Cari barang dengan ID
            found = None
            i = 0
            while i < len(daftar_barang):
                if daftar_barang[i].get_id() == idc:
                    found = daftar_barang[i]
                    break
                i += 1
            
            # tampilkan jika ditemukan
            if found:
                print("\nData Ditemukan:")
                print(f"ID: {found.get_id()}")
                print(f"Nama: {found.get_nama()}")
                print(f"Jenis: {found.get_jenis()}")
                print(f"Merek: {found.get_merek()}")
                print(f"Harga: Rp{int(found.get_harga())}")
            else:
                print("ID tidak ditemukan.")

        elif choice == "6":  
        # Keluar
            print("Program selesai. Sampai jumpa!")
            break

        else:
            print("Pilihan tidak valid. Silakan coba lagi.")


if __name__ == "__main__":
    main()
