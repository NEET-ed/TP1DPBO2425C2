class BarangElektronik:
    def __init__(self, id, nama, jenis, merek, harga):
        self.id = id
        self.nama = nama
        self.jenis = jenis
        self.merek = merek
        self.harga = harga

    # Fungsi Getter 
    def get_id(self):
        return self.id

    def get_nama(self):
        return self.nama

    def get_jenis(self):
        return self.jenis

    def get_merek(self):
        return self.merek

    def get_harga(self):
        return self.harga
    
    # Fungsi Setter
    def set_nama(self, nama):
        self.nama = nama

    def set_jenis(self, jenis):
        self.jenis = jenis

    def set_merek(self, merek):
        self.merek = merek

    def set_harga(self, harga):
        self.harga = harga
