import java.util.ArrayList;
import java.util.InputMismatchException;
import java.util.Scanner;

public class Main {
    private static ArrayList<BarangElektronik> daftarBarang = new ArrayList<>();
    private static int nextId = 1;
    private static Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        int pilihan;
        do {
            tampilkanMenu();
            pilihan = bacaPilihan();
            switch (pilihan) {
                case 1:
                    tambahData();
                    break;
                case 2:
                    tampilkanData();
                    break;
                case 3:
                    ubahData();
                    break;
                case 4:
                    hapusData();
                    break;
                case 5:
                    cariData();
                    break;
                case 6:
                    System.out.println("Program selesai. Sampai jumpa!");
                    break;
                default:
                    System.out.println("Pilihan tidak valid. Silakan coba lagi.");
            }
        } while (pilihan != 6);
    }

    private static void tampilkanMenu() {
        System.out.println("\n--- Menu Toko Elektronik ---");
        System.out.println("1. Tambah Data");
        System.out.println("2. Tampilkan Data");
        System.out.println("3. Ubah Data");
        System.out.println("4. Hapus Data");
        System.out.println("5. Cari Data");
        System.out.println("6. Keluar");
        System.out.print("Pilih menu: ");
    }

    private static int bacaPilihan() {
        try {
            return scanner.nextInt();
        } catch (InputMismatchException e) {
            scanner.next(); // Clear the invalid input
            return -1; // Return an invalid choice
        } finally {
            scanner.nextLine(); // Consume the rest of the line
        }
    }

    private static void tambahData() {
        System.out.println("\n--- Tambah Data Barang ---");
        System.out.print("Nama: ");
        String nama = scanner.nextLine();
        System.out.print("Jenis (Laptop, Handphone, dll.): ");
        String jenis = scanner.nextLine();
        System.out.print("Merek: ");
        String merek = scanner.nextLine();
        System.out.print("Harga: ");
        double harga = 0;
        try {
            harga = scanner.nextDouble();
        } catch (InputMismatchException e) {
            System.out.println("Input harga tidak valid. Harga diatur ke 0.");
        } finally {
            scanner.nextLine();
        }
        daftarBarang.add(new BarangElektronik(nextId++, nama, jenis, merek, harga));
        System.out.println("Data berhasil ditambahkan dengan ID: " + (nextId - 1));
    }

    private static void tampilkanData() {
        System.out.println("\n--- Daftar Barang Elektronik ---");
        if (daftarBarang.isEmpty()) {
            System.out.println("Tidak ada data yang tersedia.");
        } else {
            System.out.printf("%-5s | %-20s | %-15s | %-15s | %-15s%n", "ID", "Nama", "Jenis", "Merek", "Harga");
            System.out.println("---------------------------------------------------------------------------------");
            for (BarangElektronik barang : daftarBarang) {
                System.out.printf("%-5d | %-20s | %-15s | %-15s | Rp%,.0f%n", barang.getId(), barang.getNama(), barang.getJenis(), barang.getMerek(), barang.getHarga());
            }
            System.out.println("---------------------------------------------------------------------------------");
        }
    }

    private static void ubahData() {
        System.out.print("\nMasukkan ID barang yang akan diubah: ");
        int idCari = 0;
        try {
            idCari = scanner.nextInt();
        } catch (InputMismatchException e) {
            System.out.println("ID tidak valid. Kembali ke menu utama.");
            return;
        } finally {
            scanner.nextLine();
        }

        BarangElektronik barangToUpdate = null;
        for (BarangElektronik barang : daftarBarang) {
            if (barang.getId() == idCari) {
                barangToUpdate = barang;
                break;
            }
        }

        if (barangToUpdate != null) {
            System.out.println("Data lama: " + barangToUpdate.getNama() + " | " + barangToUpdate.getJenis() + " | " + barangToUpdate.getMerek() + " | Rp" + barangToUpdate.getHarga());
            System.out.print("Masukkan nama baru: ");
            String namaBaru = scanner.nextLine();
            System.out.print("Masukkan jenis baru: ");
            String jenisBaru = scanner.nextLine();
            System.out.print("Masukkan merek baru: ");
            String merekBaru = scanner.nextLine();
            System.out.print("Masukkan harga baru: ");
            double hargaBaru = 0;
            try {
                hargaBaru = scanner.nextDouble();
            } catch (InputMismatchException e) {
                System.out.println("Input harga tidak valid. Harga tidak diubah.");
            } finally {
                scanner.nextLine();
            }
            
            barangToUpdate.setNama(namaBaru);
            barangToUpdate.setJenis(jenisBaru);
            barangToUpdate.setMerek(merekBaru);
            barangToUpdate.setHarga(hargaBaru);
            System.out.println("Data berhasil diubah.");
        } else {
            System.out.println("ID tidak ditemukan.");
        }
    }

    private static void hapusData() {
        System.out.print("\nMasukkan ID barang yang akan dihapus: ");
        int idHapus = 0;
        try {
            idHapus = scanner.nextInt();
        } catch (InputMismatchException e) {
            System.out.println("ID tidak valid. Kembali ke menu utama.");
            return;
        } finally {
            scanner.nextLine();
        }
        
        BarangElektronik barangToRemove = null;
        for (BarangElektronik barang : daftarBarang) {
            if (barang.getId() == idHapus) {
                barangToRemove = barang;
                break;
            }
        }

        if (barangToRemove != null) {
            daftarBarang.remove(barangToRemove);
            System.out.println("Data berhasil dihapus.");
        } else {
            System.out.println("ID tidak ditemukan.");
        }
    }

    // fungsi cari data
    private static void cariData() {
        System.out.print("\nMasukkan ID barang yang dicari: ");
        int idCari = 0;
        try {
            idCari = scanner.nextInt();
        } catch (InputMismatchException e) {
            System.out.println("ID tidak valid. Kembali ke menu utama.");
            return;
        } finally {
            scanner.nextLine();
        }

        BarangElektronik barangDitemukan = null;
        for (BarangElektronik barang : daftarBarang) {
            if (barang.getId() == idCari) {
                barangDitemukan = barang;
                break;
            }
        }

        if (barangDitemukan != null) {
            System.out.println("--- Data Ditemukan ---");
            System.out.println("ID   : " + barangDitemukan.getId());
            System.out.println("Nama : " + barangDitemukan.getNama());
            System.out.println("Jenis: " + barangDitemukan.getJenis());
            System.out.println("Merek: " + barangDitemukan.getMerek());
            System.out.printf("Harga: Rp%,.0f%n", barangDitemukan.getHarga());
        } else {
            System.out.println("ID tidak ditemukan.");
        }
    }
}