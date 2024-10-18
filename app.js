// var namavariabel;
// let namavariabel; harus define value di awal
// const namavariabel = 0 nilai yang tidak bisa diubah

let addRow = document.getElementById("add-row");
addRow.addEventListener("click", function() {
    let table = document.getElementById('table').getElementsByTagName("tbody")[0];
    let newRow = table.insertRow(table.rows.length);

    let namaBukuCell = newRow.insertCell(0);
    let aksiCell = newRow.insertCell(1);
    let bukuName = document.getElementById("id_buku");
    bukuName = bukuName.options[bukuName.selectedIndex].text;
    let bukuId = document.getElementById("id_buku").value;
    if (bukuId == "") {
        alert("Nama Buku tidak boleh kosong");
        return false;
    }
    namaBukuCell.innerHTML = bukuName + "<input type='hidden' name='id_buku[]' value='" + bukuId + "'>"; 
    aksiCell.innerHTML = "<button type='button' onclick='deleteRow(this)' class = 'btn btn-sm btn-danger'>Hapus</button>";
});

function deleteRow(button) {
    let row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

// jquery
// $('#id_peminjaman').change(function() {//sama kaya $('#id_peminjaman')
//     let no_peminjaman = $(this).find('option:selected').text();
//     $.ajax({
//         url:"ajax/getPeminjam.php?no_peminjaman=" + no_peminjaman,
//         type: "get",
//         dataType: "json",
//         success:function(res){
//             console.log(res);
//         }
//     });
// });
