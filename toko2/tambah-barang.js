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
function openEditModal(id, nama, harga, stok) {
    console.log("Edit Modal Dibuka dengan ID:", id);
    document.getElementById("edit_id_barang").value = id;
    document.getElementById("edit_nama_barang").value = nama;
    document.getElementById("edit_harga").value = harga;
    document.getElementById("edit_stock").value = stok;
    document.getElementById("editModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

document.getElementById("editForm").onsubmit = function(e) {
    e.preventDefault(); // Mencegah reload
    fetch("edit-barang-aksi.php", {
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
    if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
        window.location.href = 'hapus-barang.php?id=' + id;
    }
}

function openDeleteModal(id) {
    document.getElementById("delete_id_barang").value = id;
    document.getElementById("deleteModal").style.display = "flex";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

document.getElementById("deleteForm").onsubmit = function(e) {
    e.preventDefault(); // Mencegah reload
    fetch("hapus-barang.php", {
        method: "POST",
        body: new FormData(document.getElementById("deleteForm"))
    })
    .then(response => response.text())
    .then(() => {
        closeDeleteModal();
        location.reload();
    });
};

// TUTUP MODAL JIKA KLIK DI LUAR MODAL
window.onclick = function(event) {
    let modals = document.querySelectorAll(".modal");
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
};