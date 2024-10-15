<?php
if (isset($_POST['tambah'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $insert = mysqli_query($koneksi, "INSERT INTO buku (nama_buku, penerbit, tahun_terbit, pengarang) VALUES ('$nama_buku', '$penerbit', '$tahun_terbit', '$pengarang')");
    header("location:?pg=buku&tambah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location:?pg=buku&hapus=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editBuku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");

$rowEdit = mysqli_fetch_assoc($editBuku);

if (isset($_POST['edit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    // ubah user : kolom apa yang mau diubah(SET), yang mau diubah id keberapa
    $update = mysqli_query($koneksi, "UPDATE buku SET nama_buku = '$nama_buku', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit', pengarang = '$pengarang' WHERE id ='$id'");
    header("location:?pg=buku&ubah=berhasil");
}
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border p-3">
                <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Buku</legend>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Buku</label>
                        <input type="text" class="form-control" name="nama_buku" placeholder="Masukkan nama buku" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_buku'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" placeholder="Masukkan penerbit" value="<?php echo isset($_GET['edit']) ? $rowEdit['penerbit'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tahun Tebit</label>
                        <input type="text" class="form-control" name="tahun_terbit" placeholder="Masukkan tahun buku" value="<?php echo isset($_GET['edit']) ? $rowEdit['tahun_terbit'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" name="pengarang" placeholder="Masukkan nama pengarang" value="<?php echo isset($_GET['edit']) ? $rowEdit['pengarang'] : '' ?>">
                    </div>
                   
                    <div class="mb-3">
                        <button name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn text-light bg-secondary"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?></button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>