public class BarangElektronik {
    private int id;
    private String nama;
    private String jenis;
    private String merek;
    private double harga;
    // Constructor
    public BarangElektronik(int id, String nama, String jenis, String merek, double harga) {
        this.id = id;
        this.nama = nama;
        this.jenis = jenis;
        this.merek = merek;
        this.harga = harga;
    }
    // Getters
    public int getId() {
        return id;
    }
    public String getNama() {
        return nama;
    }
    public String getJenis() {
        return jenis;
    }
    public String getMerek() {
        return merek;
    }
    public double getHarga() {
        return harga;
    }
    // Setters
    public void setNama(String nama) {
        this.nama = nama;
    }
    public void setJenis(String jenis) {
        this.jenis = jenis;
    }
    public void setMerek(String merek) {
        this.merek = merek;
    }
    public void setHarga(double harga) {
        this.harga = harga;
    }
}