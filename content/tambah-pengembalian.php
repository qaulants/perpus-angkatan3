<?php
if (isset($_POST['simpan'])) {
    $no_peminjaman = $_POST['no_peminjaman'];
    $status = $_POST['status'];
    $denda = $_POST['tgl_peminjaman'];
    $id_buku = $_POST['id_buku'];
    $status = "Di Pinjam";
    $insert = mysqli_query($koneksi, "INSERT INTO peminjaman (no_peminjaman, id_anggota, tgl_peminjaman, tgl_pengembalian, status) VALUES ('$no_peminjaman', '$id_anggota', '$tgl_peminjaman', '$tgl_pengembalian', '$status')");
    $id_peminjaman = mysqli_insert_id($koneksi);

    foreach ($id_buku as $key => $buku) {
        $id_buku = $_POST['id_buku'][$key];
        $inserDetail = mysqli_query($koneksi, "INSERT INTO detail_peminjaman(id_peminjaman, id_buku) VALUES ('$id_peminjaman', '$id_buku')");
    }
    header("location:?pg=peminjaman&tambah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id='$id'");
    header("location:?pg=peminjaman&hapus=berhasil");
}

$id = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryPeminjaman = mysqli_query($koneksi, "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE peminjaman.id='$id'");

$rowPeminjam = mysqli_fetch_assoc($queryPeminjaman);

$queryDetailPinjam = mysqli_query($koneksi, "SELECT buku.nama_buku, detail_peminjaman.* FROM detail_peminjaman LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku WHERE id_peminjaman = '$id'");


$queryBuku = mysqli_query($koneksi, "SELECT * FROM buku");
$queryKodePinjam = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='Di Pinjam'");



$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota");
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border p-3">
                <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Pengembalian</legend>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">No Peminajaman</label>
                                <select name="id_peminjaman" id="id_peminjaman" class="form-control">
                                    <!-- data option diambil dari table peminjaman -->
                                    <?php while($rowPeminjaman = mysqli_fetch_assoc($queryKodePinjam)): ?>
                                    <option value="<?php echo $rowPeminjaman['no_peminjaman'] ?>"><?php echo $rowPeminjaman['no_peminjaman'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            </div>
                           
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    Data Peminjam
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">No Peminjaman</label>
                                                <input class="form-control" type="text" readonly id="no_pinjam">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Nama Anggota</label>
                                                <input class="form-control" type="text" readonly id="nama_anggota">
                                            </div>
                                          
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Tanggal Peminjaman</label>
                                                <input class="form-control" type="text" readonly id="nama_anggota">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Tanggal Pengembalian</label>
                                                <input class="form-control" type="text" readonly id="nama_anggota">
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- ini table dari query dengan php -->
                    <?php if (!empty($_GET['detail'])): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Nama Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($rowDetailPeminjaman = mysqli_fetch_assoc($queryDetailPinjam)): ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $rowDetailPeminjaman['nama_buku'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>

                    <?php else: ?>
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
                        <div class="mt-3">
                            <button type="submit" name="simpan" class="btn btn-secondary">Simpan</button>
                        </div>
                    <?php endif ?>


                </form>
            </fieldset>
        </div>
    </div>
</div>