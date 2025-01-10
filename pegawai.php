<?php
include 'header.php';
?>



<!-- Content -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <h2><i class="fa-solid fa-house-chimney-window"></i> Home <i class="fa-solid fa-angle-right"></i> Data Pegawai</h2>
    </div>
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-md-4">
            <button type="button" id="btnaddpegawai" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa-regular fa-square-plus"></i> Tambah Data</button>
        </div>
        <div class="col-md-4">&nbsp;
        </div>
        <div class="col-md-4">
            <form id="searchData" name="searchData" class="form-inline">
                <input type="text" name="key" id="key" class="form-control mr-2" placeholder="Search..." aria-label="Search">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="hasilpencarian">

            </tbody>
        </table>
    </div>

    <!-- Modal: Edit Data-->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEdit" method="POST">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="enip">NIP</label>
                            <input type="hidden" id="eid" name="eid">
                            <input type="text" class="form-control" id="enip" name="enip" placeholder="Ketik NIP" required>
                        </div>
                        <div class="form-group">
                            <label for="enama">NAMA</label>
                            <input type="text" class="form-control" id="enama" name="enama" placeholder="Ketik Nama Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="ealamat">Alamat</label>
                            <textarea class="form-control" id="ealamat" name="ealamat" placeholder="Ketik Alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ehp">No. HP</label>
                            <input type="text" class="form-control" id="ehp" name="ehp" placeholder="Ketik No.HP" required>
                        </div>

                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div id="response-edit-data" class="text-center alert alert-success"></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="sendEditNow">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Add Data-->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formAdd" method="POST">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddLabel">Tambah Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Ketik NIP" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">NAMA</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Ketik Nama Pegawai" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Ketik Alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="hp">No. HP</label>
                            <input type="text" class="form-control" id="hp" name="hp" placeholder="Ketik No.HP" required>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <div id="response-add-data" class="text-center alert alert-success"></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="sendNow">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: hapus data-->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formDelete" method="POST">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="delid" id="delid">
                            <p>Apakah anda yakin ingin menghapus data pegawai <b><label id="identitaspegawai"></label></b></p>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="delNow">Hapus Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- blank div 350px -->
    <div style="height:350px;">&nbsp;</div>
</main>
<?php
include 'footer.php';
?>
<script>
    $(document).ready(function() {
        hideElements();
        loadData();

        $("#btnaddpegawai").on('click', function(e) {
            setTimeout(function() {
                document.getElementById('nip').focus();
            }, 750);
        });

        $("#formDelete").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'AppActions.php',
                type: 'POST',
                data: $('#formDelete').serialize() + "&action=deleteData",
                success: function(response) {
                    //console.log(response);
                    if (response.status === "success") {
                        loadData();
                        $('#modalDelete').modal('hide');
                    }
                }
            });
        });

        $('#formAdd').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'AppActions.php',
                type: 'POST',
                data: $('#formAdd').serialize() + "&action=saveData",
                success: function(response) {
                    //console.log(response);
                    if (response.status === "success") {
                        //window.location.href = "pegawai.php";
                        $('#response-add-data').show();
                        $('#response-add-data').html(response.message);
                        loadData();
                        setTimeout(function() {
                            $('#response-add-data').hide();
                        }, 3000);
                    } else {
                        $('#response-add-data').show();
                        $('#response-add-data').html(response.message);
                        setTimeout(function() {
                            $('#response-add-data').hide();
                        }, 3000);
                    }
                }
            });
        });

        $('#formEdit').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'AppActions.php',
                type: 'POST',
                data: $('#formEdit').serialize() + "&action=updateData",
                success: function(response) {
                    //console.log(response);
                    if (response.status === "success") {
                        //window.location.href = "pegawai.php";
                        $('#response-edit-data').show();
                        $('#response-edit-data').html(response.message);
                        loadData();
                        setTimeout(function() {
                            $('#response-edit-data').hide();
                        }, 3000);
                    } else {
                        $('#response-edit-data').show();
                        $('#response-edit-data').html(response.message);
                        setTimeout(function() {
                            $('#response-edit-data').hide();
                        }, 3000);
                    }
                }
            });
        });

        $('#key').on('keyup', function() {
            //console.log($(this).val());
            $.ajax({
                url: 'AppActions.php',
                type: 'POST',
                data: "key=" + $(this).val() + "&action=cariData",
                success: function(response) {
                    console.log(response.result);
                    $('#hasilpencarian').html('');
                    $('#hasilpencarian').html(response.result);
                }
            });
        });
    });

    function modalHapusData(id, nip, nama) {
        $("#delid").val(id);
        $("#identitaspegawai").html("[" + nip + "] " + nama + "?");
    }

    function setData(id, enip, enama, ealamat, ehp) {
        $('#eid').val(id);
        $('#enip').val(enip);
        $('#enama').val(enama);
        $('#ealamat').val(ealamat);
        $('#ehp').val(ehp);
    }

    function hideElements() {
        $('#response-add-data').hide();
        $('#response-edit-data').hide();
        $('#response-del-data').hide();
    }

    function loadData() {
        $.ajax({
            url: 'AppActions.php',
            type: 'POST',
            data: {
                cmd: "init",
                action: "getAllData"
            },
            success: function(response) {
                $('#hasilpencarian').html(response.result);
            }
        });
    }
</script>
<?php
include 'ends.php';
?>