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
function openEditModal(id, username, password, role) {
    console.log("Open Edit Modal: ", id, username, password, role); // Debugging

    document.getElementById("edit_id_user").value = id;
    document.getElementById("edit_username").value = username;
    document.getElementById("edit_password").value = password;

    // Pilih role yang sesuai
    document.getElementById("edit_kariawan").checked = (role === "kariawan");
    document.getElementById("edit_admin").checked = (role === "admin");

    // Pastikan modal bisa ditampilkan
    document.getElementById("editModal").style.display = "flex";
}

function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// ==================== MODAL HAPUS ====================

function openDeleteModal(id_user) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        window.location.href = 'hapus-user.php?id=' + id_user;
    }
}

function openDeleteModal(id_user) {
    document.getElementById("delete_id_user").value = id_user;
    document.getElementById("deleteModal").style.display = "flex";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

document.getElementById("deleteForm").onsubmit = function(e) {
    e.preventDefault(); // Mencegah reload
    fetch("hapus-user.php", {
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