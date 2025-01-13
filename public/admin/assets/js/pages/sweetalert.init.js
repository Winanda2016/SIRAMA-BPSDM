document.addEventListener("DOMContentLoaded", function () {
    // Membaca session success dan error dari data-atribut di body
    var successMessage = document.body.getAttribute("data-success");
    var errorMessage = document.body.getAttribute("data-error");

    // Menampilkan SweetAlert jika ada session success
    if (successMessage) {
        Swal.fire({
            title: "Berhasil!",
            text: successMessage,
            icon: "success",
            confirmButtonColor: "#5156be",
        });
    }

    // Menampilkan SweetAlert jika ada session error
    if (errorMessage) {
        Swal.fire({
            title: "Gagal!",
            text: errorMessage,
            icon: "error",
            confirmButtonColor: "#5156be",
        });
    }

    // ----------------------------------------------------------------------------------------------------------------------------

    document
        .querySelectorAll(".sa-warning")
        .forEach(function (saWarningButton) {
            saWarningButton.addEventListener("click", function () {
                var dataId = saWarningButton.getAttribute("data-id");
                var formId = saWarningButton.closest("form").id;

                Swal.fire({
                    title: "Apakah yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan lagi!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#2ab57d",
                    cancelButtonColor: "#fd625e",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                }).then(function (e) {
                    if (e.value) {
                        document.getElementById(formId).submit();
                    }
                });
            });
        });
});
