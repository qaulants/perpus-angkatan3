<?php
if (isset($_POST['simpan'])) {
    $no_peminjaman = $_POST['no_peminjaman'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
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
$queryKodePinjam = mysqli_query($koneksi, "SELECT MAX(id)  AS id_pinjam FROM peminjaman");
$rowPeminjaman = mysqli_fetch_assoc($queryKodePinjam);
$id_pinjam = $rowPeminjaman['id_pinjam'];
$id_pinjam++;

$kode_pinjam = "PJM/" . date('dmy') . "/" .sprintf("%03s", $id_pinjam);

$queryAnggota = mysqli_query($koneksi, "SELECT * FROM anggota");
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border p-3">
                <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Peminjaman</legend>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="" class="form-label">No Peminajaman</label>
                                <input type="text" class="form-control" name="no_peminjaman" value="<?php echo isset($_GET['detail']) ? $rowPeminjam['no_peminjaman'] : $kode_pinjam ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal Peminjaman</label>
                                <input required type="date" class="form-control" name="tgl_peminjaman" value="<?php echo isset($_GET['detail']) ? $rowPeminjam['tgl_peminjaman'] : "" ?>" 
                                <?php echo isset($_GET['detail'])? 'readonly' : ''?>>
                            </div> 
                            <?php if(empty($_GET['detail'])): ?>
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Buku</label>
                                    <select name="" id="id_buku" class="form-control" required readonly>
                                        <option value="">Pilih buku</option>
                                        <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                            <option value="<?php echo $rowBuku['id'] ?>">
                                                <?php echo $rowBuku['nama_buku']; ?>
                                            </option>
                                        <?php endwhile ?>
                                    </select>
                                </div>      
                            <?php endif ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Anggota</label>
                                <?php if (!isset($_GET['detail'])): ?>
                                <select name="id_anggota" id="" class="form-control" required readonly>
                                    <option value="">Pilih Anggota</option>
                                    <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)): ?>
                                    <option value="<?php echo $rowAnggota['id'] ?>">
                                        <?php echo $rowAnggota['nama_anggota']; ?>
                                    </option>
                                    <?php endwhile ?>
                                </select>
                                <?php else: ?>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowPeminjam['nama_anggota'] ?>">
                                <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" name="tgl_pengembalian" value="<?php echo isset($_GET['detail']) ? $rowPeminjam['tgl_pengembalian'] : "" ?>" required 
                                <?php echo isset($_GET['detail'])? 'readonly' : ''?>>
                            </div>
                           
                        </div>
                    </div>
                    <?php if (!isset($_GET['detail'])):?>
                    <div align="right" class="mb-3">
                        <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
                    </div>
                    <?php endif ?>
                    <!-- ini table dari query dengan php -->
                    <?php if (!empty($_GET['detail'])):?>
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Nama Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while($rowDetailPeminjaman = mysqli_fetch_assoc($queryDetailPinjam)):?>
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