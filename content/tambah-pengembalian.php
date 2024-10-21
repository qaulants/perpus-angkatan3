<?php
if (isset($_POST['simpan'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $queryPeminjam = mysqli_query($koneksi, "SELECT id, no_peminjaman FROM peminjaman WHERE no_peminjaman='$id_peminjaman'");

    $rowPeminjaman = mysqlI_fetch_assoc($queryPeminjam);
    $id_peminjaman = $rowPeminjaman["id"];
    $denda = $_POST['denda'];
   if ($denda == 0) {
        $status = 0;
   }else{
        $status = 1;
   }
    $insert = mysqli_query($koneksi, "INSERT INTO pengembalian (id_peminjaman, status, denda) VALUES ('$id_peminjaman', '$status', '$denda')");
    $updatePeminjaman = mysqli_query($koneksi, "UPDATE peminjaman SET status = 'Di Kembalikan' WHERE id='$id_peminjaman'");
    header("location:?pg=pengembalian&tambah=berhasil");
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
                                                <label class="form-label" for="">Tanggal Peminjaman</label>
                                                <input class="form-control" type="text" readonly id="tgl_peminjaman" value="">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Denda</label>
                                                <input class="form-control" type="text" readonly id="denda" name="denda" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="">Nama Anggota</label>
                                                <input class="form-control" type="text" readonly id="nama_anggota">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Tanggal Pengembalian</label>
                                                <input class="form-control" type="text" readonly id="tgl_pengembalian">
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
              
                        <table id="table-pengembalian" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Buku</th>
                      
                                </tr>
                            </thead>
                            <tbody class="table-row">

                            </tbody>
                        </table>
                        <div class="mt-3">
                            <button type="submit" name="simpan" class="btn btn-secondary">Simpan</button>
                        </div>
             


                </form>
            </fieldset>
        </div>
    </div>
</div>