<?php
require('BarangElektronik.php');

session_start();

// Ensure the data array and ID counter exist in the session
if (!isset($_SESSION['daftarBarang'])) {
    $_SESSION['daftarBarang'] = [];
    $_SESSION['nextId'] = 1;
}

// CRUD

// Cari barang melalui ID
function findBarangById($id) {
    $iterator = new ArrayIterator($_SESSION['daftarBarang']);
    while ($iterator->valid()) {
        $barang = $iterator->current();
        if ($barang->getId() == $id) {
            return $barang;
        }
        $iterator->next();
    }
    return null;
}

// Untuk upload gambar
function handleImageUpload($file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            return $uploadFile;
        }
    }
    return '';
}

// POST request untuk tambah/update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jenis = $_POST['jenis'] ?? '';
    $merek = $_POST['merek'] ?? '';
    $harga = $_POST['harga'] ?? 0;
    
    $gambarPath = '';
    if (isset($_FILES['gambar'])) {
        $gambarPath = handleImageUpload($_FILES['gambar']);
    }

    if ($action == 'add') {
        $newBarang = new BarangElektronik($_SESSION['nextId']++, $nama, $jenis, $merek, $harga, $gambarPath);
        $_SESSION['daftarBarang'][] = $newBarang;
    } elseif ($action == 'update') {
        $id = $_POST['id'] ?? 0;
        $editBarang = findBarangById($id);
        if ($editBarang) {
            $editBarang->setNama($nama);
            $editBarang->setJenis($jenis);
            $editBarang->setMerek($merek);
            $editBarang->setHarga($harga);
            if (!empty($gambarPath)) {
                $editBarang->setGambar($gambarPath);
            }
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// GET request untuk Edit/Hapus/Cari
$editBarang = null;
$searchResult = null;
$action = $_GET['action'] ?? '';

if ($action == 'edit') {
    $id = $_GET['id'] ?? 0;
    $editBarang = findBarangById($id);
} elseif ($action == 'delete') {
    $id = $_GET['id'] ?? 0;
    $foundKey = -1;
    $iterator = new ArrayIterator($_SESSION['daftarBarang']);
    while ($iterator->valid()) {
        $barang = $iterator->current();
        if ($barang->getId() == $id) {
            $foundKey = $iterator->key();
            break;
        }
        $iterator->next();
    }
    if ($foundKey != -1) {
        unset($_SESSION['daftarBarang'][$foundKey]);
        $_SESSION['daftarBarang'] = array_values($_SESSION['daftarBarang']);
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
} elseif ($action == 'search') {
    $id = $_GET['searchId'] ?? 0;
    $searchResult = findBarangById($id);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Elektronik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h1>Toko Elektronik Nurul</h1>
    </div>

    <div class="container">
        
        <h2><?php echo ($editBarang ? 'Ubah' : 'Tambah'); ?> Data Barang</h2>
        <div class="form-container">
            <form action="web-main.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="<?php echo ($editBarang ? 'update' : 'add'); ?>">
                <?php if ($editBarang): ?>
                    <input type="hidden" name="id" value="<?php echo $editBarang->getId(); ?>">
                <?php endif; ?>

                <label for="nama">Nama Barang:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $editBarang ? htmlspecialchars($editBarang->getNama()) : ''; ?>" required>
                
                <label for="jenis">Jenis:</label>
                <input type="text" id="jenis" name="jenis" value="<?php echo $editBarang ? htmlspecialchars($editBarang->getJenis()) : ''; ?>" required>
                
                <label for="merek">Merek:</label>
                <input type="text" id="merek" name="merek" value="<?php echo $editBarang ? htmlspecialchars($editBarang->getMerek()) : ''; ?>" required>
                
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" value="<?php echo $editBarang ? htmlspecialchars($editBarang->getHarga()) : ''; ?>" required>
                
                <label for="gambar">Gambar:</label>
                <input type="file" id="gambar" name="gambar">

                <br> <button type="submit"><?php echo ($editBarang ? 'Ubah Data' : 'Tambah Data'); ?></button>
            </form>
        </div>
    </div>

        
    <div class="container">
        <h2>Cari Data Barang</h2>
        <div class="search-container">
            <form action="web-main.php" method="GET">
                <input type="hidden" name="action" value="search">
                <input type="number" name="searchId" placeholder="Masukkan ID Barang">
                <button type="submit" class="search-btn">Cari</button>
            </form>
        </div>

        <?php if ($searchResult): ?>
            <div class="search-result">
                <h3>Data Ditemukan:</h3>
                <ul>
                    <li><strong>ID:</strong> <?php echo htmlspecialchars($searchResult->getId()); ?></li>
                    <li><strong>Nama:</strong> <?php echo htmlspecialchars($searchResult->getNama()); ?></li>
                    <li><strong>Jenis:</strong> <?php echo htmlspecialchars($searchResult->getJenis()); ?></li>
                    <li><strong>Merek:</strong> <?php echo htmlspecialchars($searchResult->getMerek()); ?></li>
                    <li><strong>Harga:</strong> Rp<?php echo number_format($searchResult->getHarga()); ?></li>
                    <?php if (!empty($searchResult->getGambar())): ?>
                        <li><strong>Gambar:</strong> <img src="<?php echo htmlspecialchars($searchResult->getGambar()); ?>" alt="Gambar Barang" class="product-img"></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php elseif (isset($_GET['searchId'])): ?>
            <p>Data dengan ID tersebut tidak ditemukan.</p>
        <?php endif; ?>
    </div>

        
    <div class="container">
        <h2>Daftar Barang Elektronik</h2>
        <?php if (empty($_SESSION['daftarBarang'])): ?>
            <p>Tidak ada data yang tersedia. Silakan tambahkan data terlebih dahulu.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['daftarBarang'] as $barang): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($barang->getId()); ?></td>
                        <td><?php echo htmlspecialchars($barang->getNama()); ?></td>
                        <td><?php echo htmlspecialchars($barang->getJenis()); ?></td>
                        <td><?php echo htmlspecialchars($barang->getMerek()); ?></td>
                        <td>Rp<?php echo number_format($barang->getHarga()); ?></td>
                        <td>
                            <?php if (!empty($barang->getGambar())): ?>
                                <img src="<?php echo htmlspecialchars($barang->getGambar()); ?>" alt="Gambar Barang" class="product-img">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?action=edit&id=<?php echo $barang->getId(); ?>" class="action-btn edit-btn">Ubah</a>
                            <a href="?action=delete&id=<?php echo $barang->getId(); ?>" class="action-btn delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>

</body>
</html>