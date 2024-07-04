function formLogout(target) {
    const form = document.getElementById("logoutForm");
    target.preventDefault;
    form.submit();
}

function formDelete(target) {
    const hapusModalForm = document.getElementById("hapusModalForm");
    hapusModalForm.action = target.dataset.url;
}

function getKelurahan(target, type) {
    $.ajax({
        url: `${target.dataset.url}/${target.value}`,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var html =
                '<option value="" disabled selected>-- Pilih Kelurahan --</option>';
            data.forEach(function (item) {
                html +=
                    '<option value="' +
                    item.id +
                    '">' +
                    item.nama +
                    "</option>";
            });
            if (type == 'create') {
                $("#kelurahan_id_create").html(html);
            } else if (type == 'edit') {
                $("#kelurahan_id_edit").html(html);
            } else if (type == 'editgapoktan') {
                $("#kelurahan_id_editgapoktan").html(html);
            } else if (type == 'creategapoktan') {
                $("#kelurahan_id_creategapoktan").html(html);
            } else {
                $("#kelurahan_id").html(html);
            }
        },
    });
}

function getPetani(kelompok_id = 0) {
    const selectedValue = $("#petani").val();

    if (!selectedValue) {
        return; // Jika tidak ada yang dipilih, hentikan eksekusi
    }
    const link = `/admin/get-${selectedValue}`;
    $.ajax({
        url: link,
        type: "GET",
        dataType: "json",
        success: function (data) {
            let html = `<option value="" disabled>-- Pilih ${selectedValue.toUpperCase()} --</option>`;

            if (kelompok_id == 0) {
                data.forEach(function (item) {
                    html += `<option value="${item.id}">${item.nama_petani}</option>`;
                });
            } else {
                data.forEach(function (item) {
                    html += `<option value="${item.id}" ${(kelompok_id == item.id) ? "selected" : ""}>${item.nama_petani}</option>`;
                });
            }

            $("#kelompok_id").html(html);
            if ($("#kelompok_id").data("mode") === "create") {
                $("#kelompok_id").val("");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        },
    });
}

function getPetaniPenyuluh() {
    const selectedValue = $("#petani").val();

    if (!selectedValue) {
        return; // Jika tidak ada yang dipilih, hentikan eksekusi
    }

    const link = `/penyuluh/get-${selectedValue}`;

    $.ajax({
        url: link,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            let html = `<option value="" disabled>-- Pilih ${selectedValue.toUpperCase()} --</option>`;
            if (selectedValue == "poktan") {
                data.forEach(function (item) {
                    console.log(item);
                    html += `<option value="${item.kelompok_id}" ${item.kelompok_id == $("#kelompok_id").data("kelompok_id")
                        ? "selected"
                        : ""
                        }>${item.nama_petani}</option>`;
                });
            } else {
                data.forEach(function (item) {
                    html += `<option value="${item.kelompok_id}" ${
                    item.kelompok_id == $("#kelompok_id").data("kelompok_id")
                        ? "selected"
                        : ""
                }>${item.nama_petani}</option>`;
                });
            }
            $("#kelompok_id").html(html);
            if ($("#kelompok_id").data("mode") === "create") {
                $("#kelompok_id").val("");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        },
    });
}

function getTambahPetani(target) {
    const namaPetani = document.getElementById("nama_petani");
    const rowKedua = document.getElementById("row_kedua");
    const formTambahPetani = document.getElementById("formTambahPetani");
    if (target.value == "poktan") {
        formTambahPetani.action = `/${target.dataset.auth}/poktan`;
        namaPetani.innerHTML = `
        <label for="nama_petani">Nama Petani</label>
        <input type="text" name="nama_petani" id="nama_petani"
            class="form-control shadow-sm mb-3" placeholder="Nama Kelompok Poktan" required>
        `;

        rowKedua.innerHTML = `
        <div class="col-md">
        <label for="luas_lahan_poktan">Luas Lahan Poktan</label>
        <input type="text" name="luas_lahan_poktan" id="luas_lahan_poktan"
            class="form-control shadow-sm mb-3" placeholder="Luas Lahan poktan" required>
        </div>
        <div class="col-md">
            <label for="no_hp_poktan">No HP Poktan</label>
            <input type="number" name="no_hp_poktan" id="no_hp_poktan"
                class="form-control shadow-sm mb-3" placeholder="No HP Poktan" required>
        </div>
        <div class="col-md">
            <label for="alamat_poktan">Alamat Poktan</label>
            <input type="text" name="alamat_poktan" id="alamat_poktan"
                class="form-control shadow-sm mb-3" placeholder="Alamat Poktan" required>
        </div>
        <div class="col-md">
            <label for="status_poktan">Status Poktan</label>
            <input type="text" name="status_poktan" id="status_poktan"
                class="form-control shadow-sm mb-3" placeholder="Status Gapoktan" required>
        </div>
        `;
    } else {
        formTambahPetani.action = `/${target.dataset.auth}/gapoktan`;
        namaPetani.innerHTML = `
        <label for="nama_petani">Nama Petani</label>
        <input type="text" name="nama_petani" id="nama_petani"
            class="form-control shadow-sm mb-3" placeholder="Nama Kelompok Gapoktan" required>
        `;

        rowKedua.innerHTML = `
        <div class="col-md">
        <label for="luas_lahan_gapoktan">Luas Lahan Gapoktan</label>
        <input type="text" name="luas_lahan_gapoktan" id="luas_lahan_gapoktan"
            class="form-control shadow-sm mb-3" placeholder="Luas Lahan Gapoktan" required>
        </div>
        <div class="col-md">
            <label for="no_hp_gapoktan">No HP Gapoktan</label>
            <input type="number" name="no_hp_gapoktan" id="no_hp_gapoktan"
                class="form-control shadow-sm mb-3" placeholder="No HP Gapoktan" required>
        </div>
        <div class="col-md">
            <label for="alamat_gapoktan">Alamat Gapoktan</label>
            <input type="text" name="alamat_gapoktan" id="alamat_gapoktan"
                class="form-control shadow-sm mb-3" placeholder="Alamat Gapoktan" required>
        </div>
        <div class="col-md">
            <label for="status_gapoktan">Status Gapoktan</label>
            <input type="text" name="status_gapoktan" id="status_gapoktan"
                class="form-control shadow-sm mb-3" placeholder="Status Gapoktan" required>
        </div>
          <div class="col-md">
                                    <label for="Nama">Kelompok</label>
                                    <input type="text" name="kelompok_nama" id="nama" class="form-control mb-3"
                                        placeholder="Kelompok" required>
                                </div>
        `;
    }
}

function changeLabelInputFile(target) {
    const label = target.nextElementSibling;
    label.innerHTML = target.files[0].name;
}

function addFotoColumn() {
    const fotoColumn = document.querySelectorAll("#fotoColumn");
    const x = fotoColumn.length;
    console.log(x);
    const html = `<div class="input-group mb-3" id="fotoColumn">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" id="inputFile_${
                            x + 1
                        }" name="foto[]" class="custom-file-input" onchange="changeLabelInputFile(this)" accept="image/png, image/jpg, image/jpeg">
                        <label class="custom-file-label text-truncate" for="inputFile_${
                            x + 1
                        }">
                            Pilih File...
                        </label>
                    </div>
                </div>`;

    fotoColumn[x - 1].insertAdjacentHTML("afterend", html);
    console.log(fotoColumn[x - 1]);
}

function showImageInModal(target) {
    const imageModalContent = document.getElementById("imageModalContent");
    imageModalContent.src = target.dataset.image;
}

function editModalKelForm(target) {
    const editKelurahanModalForm = document.getElementById(
        "editKelurahanModalForm"
    );
    const editNamaKelurahan = document.getElementById("editNamaKelurahan");
    const editNamaKecamatanId = document.getElementById("editNamaKecamatanId");

    editKelurahanModalForm.action = target.dataset.url;

    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);
            editNamaKelurahan.value = data.nama;
            editNamaKecamatanId.value = data.kecamatan_id;
        },
    });
}

function editModalPenyuluhForm(target) {
    const editPenyuluhModalForm = document.getElementById(
        "editPenyuluhModalForm"
    );
    editPenyuluhModalForm.action = target.dataset.url;
    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            editPenyuluhModalForm.nama_penyuluh.value = data.nama_penyuluh;
            editPenyuluhModalForm.nip_penyuluh.value = data.nip_penyuluh;
            editPenyuluhModalForm.no_hp_penyuluh.value = data.no_hp_penyuluh;
            editPenyuluhModalForm.alamat_penyuluh.value = data.alamat_penyuluh;
        },
    });
}

function editModalPoktanForm(target) {
    const editPoktanModalForm = document.getElementById("editPoktanModalForm");
    editPoktanModalForm.action = target.dataset.url;
    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            editPoktanModalForm.nama_petani.value = data.nama_petani;
            editPoktanModalForm.NIK.value = data.nik;
            editPoktanModalForm.luas_lahan_poktan.value =
                data.luas_lahan_poktan;
            editPoktanModalForm.no_hp_poktan.value = data.no_hp_poktan;
            editPoktanModalForm.tempat_lahir.value = data.tempat_lahir;
            editPoktanModalForm.tgl_lahir.value = data.tgl_lahir;
            editPoktanModalForm.alamat_poktan.value = data.alamat_poktan;
            editPoktanModalForm.penyuluh_id.value = data.penyuluh_id;
            editPoktanModalForm.status_poktan.value = data.status_poktan;
            var kelurahan_id = data.kelurahan_id;
            // Get kelompok_nama from table kelompok
            $.ajax({
                url: document.location.href + `/get-kelurahan/${data.kecamatan_id}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var html =
                        '<option value="">-- Pilih Kelurahan --</option>';
                    data.forEach(function (item) {
                        html +=
                            `<option value="${item.id}" ${(item.id == kelurahan_id) ? 'selected' : ''}>${item.nama}</option>`;
                    });

                    $("#kelurahan_id_edit").html(html);
                },
            });
            editPoktanModalForm.kecamatan_id.value = data.kecamatan_id;
        },
    });
}

function editModalGapoktanForm(target) {
    const editGapoktanModalForm = document.getElementById(
        "editGapoktanModalForm"
    );
    editGapoktanModalForm.action = target.dataset.url;
    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            editGapoktanModalForm.nama_petani.value = data.nama_petani;
            editGapoktanModalForm.luas_lahan_gapoktan.value =
                data.luas_lahan_gapoktan;
            editGapoktanModalForm.no_hp_gapoktan.value = data.no_hp_gapoktan;
            editGapoktanModalForm.NIK.value = data.nik;
            editGapoktanModalForm.tempat_lahir.value = data.tempat_lahir;
            editGapoktanModalForm.tgl_lahir.value = data.tgl_lahir;
            editGapoktanModalForm.alamat_gapoktan.value = data.alamat_gapoktan;
            editGapoktanModalForm.status_gapoktan.value = data.status_gapoktan;
            editGapoktanModalForm.penyuluh_id.value = data.penyuluh_id;
            editGapoktanModalForm.kelompok_nama.value = data.kelompok.nama_kelompok;
            var kelurahan_id = data.kelurahan_id;
            // Get kelompok_nama from table kelompok
            $.ajax({
                url: document.location.href + `/get-kelurahan/${data.kecamatan_id}`,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var html =
                        '<option value="">-- Pilih Kelurahan --</option>';
                    data.forEach(function (item) {
                        html +=
                            `<option value="${item.id}" ${(item.id == kelurahan_id) ? 'selected' : ''}>${item.nama}</option>`;
                    });

                    $("#kelurahan_id_editgapoktan").html(html);
                },
            });
            editGapoktanModalForm.kecamatan_id.value = data.kecamatan_id;
        },
    });
}

function editModalBeritaForm(target) {
    const editBeritaModalForm = document.getElementById("editBeritaModalForm");
    const imagePreview = document.getElementById("foto_preview");
    editBeritaModalForm.action = target.dataset.url;
    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            editBeritaModalForm.judul_berita.value = data.judul_berita;
            editBeritaModalForm.isi_berita.innerHTML = data.isi_berita;
            editBeritaModalForm.slug.value = data.slug;
            imagePreview.setAttribute("src", `../${data.foto}`);
        },
    });
}

function editModalKecForm(target) {
    const editKecamatanModalForm = document.getElementById(
        "editKecamatanModalForm"
    );
    const editNamaKecamatan = document.getElementById("editNamaKecamatan");

    editKecamatanModalForm.action = target.dataset.url;
    editNamaKecamatan.value = target.dataset.nama;
}

function detailHasilPanen(target) {
    const luasLahan = document.querySelector("#luasLahan");
    const kelompokTani = document.querySelector("#kelompokTani");
    const alamatUbinan = document.querySelector("#alamatUbinan");
    const gkp = document.querySelector("#gkp");
    const gkg = document.querySelector("#gkg");
    const hasilProduksi = document.querySelector("#hasilProduksi");
    const detailHasilProduksi = document.querySelector("#detailHasilProduksi");
    const urlLokasi = document.querySelector("#urlLokasi");
    const kecamatan = document.querySelector("#kecamatan");
    const kelurahan = document.querySelector("#kelurahan");

    const detailFotoModalBody = document.querySelector("#detailFotoModalBody");

    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            luasLahan.innerHTML = data.luas_lahan;
            kelompokTani.innerHTML = data.kelompok_tani;
            alamatUbinan.innerHTML = data.alamat_ubinan;
            gkp.innerHTML = data.gkp;
            gkg.innerHTML = data.gkg;
            hasilProduksi.innerHTML = data.hasil_produksi;
            detailHasilProduksi.innerHTML = data.detail_hasil_produksi;
            urlLokasi.href = data.url_lokasi;
            kecamatan.innerHTML = data.kecamatan.nama;
            kelurahan.innerHTML = data.kelurahan.nama;

            let html = ``;
            data.foto_hasil.forEach(function (item) {
                html += `<div class="col-12"><img src="${item.nama}" alt="" class="img-fluid mb-3" width="50%"></div>`;
            });

            detailFotoModalBody.innerHTML = html;
        },
    });
}

function editJabatanForm(target) {
    const editJabatanModalForm = document.getElementById(
        "editJabatanModalForm"
    );
    const editNamaJabatan = document.getElementById("editNamaJabatan");

    editJabatanModalForm.action = target.dataset.url;

    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            editNamaJabatan.value = data.nama_jabatan; // Ganti dengan properti yang sesuai
        },
    });
}

function updateVerifikasiForm(target) {
    const updateVerifikasiModalForm = document.getElementById(
        "updateVerifikasiModalForm"
    );
    updateVerifikasiModalForm.action = target.dataset.url;

    $.ajax({
        url: target.dataset.urlajax,
        type: "GET",
        dataType: "json",
        success: function (data) {
            updateVerifikasiModalForm.is_verified.value = data.is_verified;
        },
    });
}


// Untuk filter hasil panen
function searchData() {
    var month = $('#monthFilter').val();
    var year = $('#yearFilter').val();
    // Lakukan aksi pencarian berdasarkan bulan dan tahun
    // Misalnya, panggil ulang DataTables dengan parameter tambahan
    var table = $('#datatableserverside').DataTable();
    table.ajax.url(window.location.href + '?month=' + month + '&year=' + year).load();

    $.ajax({
        url: window.location.href + '/get-total-panen?month=' + month + '&year=' + year,
        type: 'GET', // Metode HTTP GET
        success: function (response) {

            if (response.data.total) {
                $('.text-ket').html('Jumlah total hasil produksi panen dari bulan ' + response.data.bulan + " tahun " + response.data.tahun);
                $('.text-total').html(response.data.total + ' Ton');
            } else if (response.data.total == 0) {
                $('.text-ket').html('Jumlah total hasil produksi panen dari bulan ' + response.data.bulan + " tahun " + response.data.tahun);
                $('.text-total').html(response.data.total + ' Ton');
            } else {
                $('.text-ket').html('Jumlah total semua hasil produksi panen');
                $('.text-total').html(response.data + ' Ton');
            }
        },
        error: function (xhr) {

        }
    });
}


function tambahUserForm() {
    var selectAkun = document.getElementById("akun");
    var selectNamaUser = document.getElementById("nama_user");
    var notelp = document.getElementById("telponnn");

    selectNamaUser.addEventListener("change", function () {
        var selectedOption = this.options[this.selectedIndex]; // Ambil opsi yang dipilih

        // Ambil data nomor telepon dari atribut data-telepon pada opsi yang dipilih

        var nomorTelepon = selectedOption.getAttribute("data-telepon");

        // Perbarui nilai nomor telepon
        notelp.value = nomorTelepon;
    });

    selectAkun.addEventListener("change", function () {
        var akun = this.value;

        // Buat objek FormData
        var formData = new FormData();
        formData.append("akun", akun);

        // Kirim permintaan POST dengan FormData
        fetch("/admin/get-users", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                // Hapus semua opsi sebelum menambahkan yang baru
                selectNamaUser.innerHTML =
                    "<option disabled selected>-- Pilih Data --</option>";

                // Tambahkan opsi baru berdasarkan data yang diterima
                data.forEach(function (user) {
                    var option = document.createElement("option");
                    if (akun == "pegawai") {
                        option.value = user.nama_pegawai;
                        option.text = user.nama_pegawai;
                        option.setAttribute("data-telepon", user.no_hp_pegawai);
                    }
                    if (akun == "kabid") {
                        option.value = user.nama_pegawai;
                        option.text = user.nama_pegawai;
                        console.log(user);
                        option.setAttribute("data-telepon", user.no_hp_pegawai);
                    } else if (akun == "penyuluh") {
                        option.value = user.nama_penyuluh;
                        option.text = user.nama_penyuluh;
                        option.setAttribute(
                            "data-telepon",
                            user.no_hp_penyuluh
                        );
                    } else if (akun == "petani") {
                        option.value = user.nama_petani;
                        option.text = user.nama_petani;
                        option.setAttribute("data-telepon", user.no_hp_poktan ?? user.no_hp_gapoktan);
                    }

                    selectNamaUser.appendChild(option);
                });
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
}

function generateSlug(target, id) {
    const slug = document.getElementById(id);
    const text = target.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, "-") // Ganti karakter non-alfanumerik dengan -
        .replace(/(^-|-$)/g, "");
    slug.value = text;
}

function showTab(event, tabId) {
    event.preventDefault();

    // Hide all tab content
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }

    // Remove active class from all tabs
    var tabs = document.getElementsByClassName("nav-link");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }

    // Show the selected tab content
    document.getElementById(tabId).style.display = "block";

    // Add active class to the clicked tab
    event.currentTarget.classList.add("active");
}
