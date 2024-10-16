<?php
if (isset($_POST['tambah'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];
    $insert = mysqli_query($koneksi, "INSERT INTO buku (nama_buku, penerbit, tahun_terbit, pengarang,id_kategori) VALUES ('$nama_buku', '$penerbit', '$tahun_terbit', '$pengarang','$id_kategori')");
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
    $id_kategori = $_POST['id_kategori'];
    // ubah user : kolom apa yang mau diubah(SET), yang mau diubah id keberapa
    $update = mysqli_query($koneksi, "UPDATE buku SET nama_buku = '$nama_buku', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit', pengarang = '$pengarang', id_kategori='$id_kategori'  WHERE id ='$id'");
    header("location:?pg=buku&ubah=berhasil");
}

$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku");


?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border p-3">
                <legend class="float-none w-auto px-3"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Peminjaman</legend>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="" class="form-label">No Peminajaman</label>
                                <input type="text" class="form-control" name="no_peminjaman" value="" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" name="tgl_peminjaman" value="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Buku</label>
                                <select name="" id="id_buku" class="form-control">
                                    <option value="">Pilih buku</option>
                                    <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                        <option value="<?php echo $rowBuku['id'] ?>">
                                            <?php echo $rowBuku['nama_buku']; ?>
                                        </option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Anggota</label>
                                <select name="id_anggota" id="" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" name="tgl_peminjaman" value="">
                            </div>
                           
                        </div>
                    </div>
                    <div align="right" class="mb-3">
                        <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
                    </div>
                    <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-row">
                                  
                                </tbody>
                    </table>
                </form>
            </fieldset>
        </div>
    </div>
</div>