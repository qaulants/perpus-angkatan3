<?php
$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
?>
<div class="mt-5 container">
    <div class="row">
        <div class="col-sm-12">
            <fieldset class="border border-secondary border-2 p-3">
                <legend class="float-none w-auto px-3">Level</legend>
                <div align="right">
                    <a href="?pg=tambah-level" type="button" class="btn text-light bg-success"><i class="fa-solid fa-plus"></i></a>
                    <!-- <a href="" type="button" class="btn text-light bg-secondary">Recycle</a> -->
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No<i class="bx bxs-sort-alt"></th>
                                <th scope="col">Nama Level<i class="bx bxs-sort-alt"></th>
                                <th scope="col">Aksi<i class="bx bxs-sort-alt"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($level)):
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['nama_level'] ?></td>
                                    <td>
                                        <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini???')" href="?pg=tambah-level&delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="?pg=tambah-level&edit=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>