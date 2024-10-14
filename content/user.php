<?php
  $user = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
?>
<div class="mt-5 container">
    <div class="row">
      <div class="col-sm-12">
        <fieldset class="border border-secondary border-2 p-3">
          <legend class="float-none w-auto px-3">Table Anggota</legend>
          <div align="right">
            <a href="?pg=tambah-user" type="button" class="btn text-light bg-success"><i class="fa-solid fa-plus"></i></a>
            <!-- <a href="" type="button" class="btn text-light bg-secondary">Recycle</a> -->
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mt-3">
              <thead>
                <tr>
                  <th scope="col">No<i class="bx bxs-sort-alt"></th>
                  <th scope="col">Telepon<i class="bx bxs-sort-alt"></th>
                  <th scope="col">Nama<i class="bx bxs-sort-alt"></th>
                  <th scope="col">Email<i class="bx bxs-sort-alt"></th>
                  <th scope="col">Jenis Kelamin<i class="bx bxs-sort-alt"></th>
                  <th scope="col">Aksi<i class="bx bxs-sort-alt"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($rowUser = mysqli_fetch_assoc($user)):
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $rowUser['telepon'] ?></td>
                  <td><?php echo $rowUser['nama'] ?></td>
                  <td><?php echo $rowUser['email'] ?></td>
                  <td><?php echo $rowUser['jenis_kelamin'] ?></td>
                  <td>
                    <a onclick="return confirm('Apakah Anda yakin akan menghapus data ini???')" href="?pg=tambah-user&delete=<?php echo $rowUser['id'] ?>" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="?pg=tambah-user&edit=<?php echo $rowUser['id'] ?>" class="btn btn-primary btn-sm">
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