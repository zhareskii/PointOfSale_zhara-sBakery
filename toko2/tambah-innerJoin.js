// Ambil elemen modal dan tombol
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var closeBtn = document.getElementsByClassName("close")[0];

// Saat tombol + diklik, tampilkan modal
btn.onclick = function() {
    modal.style.display = "flex";
}

// Saat tombol close (×) diklik, sembunyikan modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Tutup modal jika user klik di luar modal
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

// ==================== MODAL EDIT ====================
function openEditModal(id_transaksi, id_barang, jml_barang, harga_satuan, tgl_transaksi, total_transaksi) {
    console.log("Edit Modal Dibuka dengan ID:", id_transaksi);
    document.getElementById("edit_id_transaksi").value = id_transaksi;
    document.getElementById("edit_id_barang").value = id_barang;
    document.getElementById("edit_jml_barang").value = jml_barang;
    document.getElementById("edit_harga_satuan").value = harga_satuan;
    document.getElementById("edit_tgl_transaksi").value = tgl_transaksi;
    document.getElementById("edit_total_transaksi").value = total_transaksi;
    document.getElementById("editModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

document.getElementById("editForm").onsubmit = function(e) {
    e.preventDefault(); // Mencegah reload
    fetch("edit-InnerJoin-aksi1.php", {
        method: "POST",
        body: new FormData(document.getElementById("editForm"))
    })
    .then(response => response.text())
    .then(() => {
        closeEditModal();
        location.reload();
    });
};

// ==================== MODAL HAPUS ====================

function openDeleteModal(id) {
    if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
        window.location.href = 'delete-InnerJoin1.php?id=' + id;
    }
}

function openDeleteModal(id) {
    document.getElementById("delete_id_transaksi").value = id_transaksi;
    document.getElementById("deleteModal").style.display = "flex";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

document.getElementById("deleteForm").onsubmit = function(e) {
    e.preventDefault(); // Mencegah reload
    fetch("delete-innerJoin.php", {
        method: "POST",
        body: new FormData(document.getElementById("deleteForm"))
    })
    .then(response => response.text())
    .then(() => {
        closeDeleteModal();
        location.reload();
    });
};
