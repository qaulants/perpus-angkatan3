<?php
session_start();
if (empty($_SESSION['NAMA'])) {
    header("location:login.php?access=failed");
}
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="bootstrap-5.3.3/dist/css//bootstrap.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <!-- <h2 class="text-center mt-4">Welcome to <?php echo $_SESSION['nama']; ?></h2> -->
    <!-- <a href="controller/logout.php" class="btn btn-danger btn-sm">Log out</a> -->
    <div class="content">
        <?php
        if (isset($_GET['pg'])) {
            if (file_exists('content/' . $_GET['pg'] . '.php')) {
                include 'content/' . $_GET['pg'] . '.php';
            }
        } else {
            include 'content/dashboard.php';
        }
        ?>

    </div>



    <?php include 'layout/footer.php'; ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->
    <script src="bootstrap-5.3.3/dist/js/jquery-3.7.1.min.js"></script>
    <script src="bootstrap-5.3.3/dist/js/moment.js"></script>
    <script src="bootstrap-5.3.3/dist/js/bootstrap.bundle.js"></script>
    <script src="app.js"></script>
    <script>
        $('#id_peminjaman').change(function() { //sama kaya $('#id_peminjaman')
            let no_peminjaman = $(this).find('option:selected').val();
            let tbody = $('tbody'),
                newRow = "";
            $.ajax({
                url: "ajax/getPeminjam.php?no_peminjaman=" + no_peminjaman,
                type: "get",
                dataType: "json",
                success: function(res) {
                    $('#no_pinjam').val(res.data.no_peminjaman);
                    $('#tgl_peminjaman').val(res.data.tgl_peminjaman);
                    $('#tgl_pengembalian').val(res.data.tgl_pengembalian);
                    $('#nama_anggota').val(res.data.nama_anggota);
                    //console.log(res)

                    let tanggal_kembali = new moment(res.data.tgl_pengembalian);

                    let currentDate = new Date().toJSON().slice(0, 10);
                    console.log(currentDate);

                    let tanggal_di_kembalikan = new moment(currentDate)
                    let selisih = tanggal_di_kembalikan.diff(tanggal_kembali, "days");

                    if (selisih < 0) {
                        selisih = 0;
                    }
                    
                    let biaya_denda = 10000;
                    let totalDenda = selisih * biaya_denda;
                    $('#denda').val(totalDenda);

                    $.each(res.detail_peminjaman, function(key, val) {
                        newRow += "<tr>";
                        newRow += "<td>" + val.nama_buku + "</td>";
                        newRow += "</tr>";
                    });
                    tbody.html(newRow);
                }
            });
        });
    </script>
</body>

</html>