<?php
include 'header.php';
?>



<!-- Content -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="row">
        <h2>Home <i class="fa-solid fa-angle-right"></i> Data Pegawai</h2>
    </div>
    <div class="row" style="padding-bottom: 10px;">
        <div class="col-md-4">
            <button type="button" id="btnaddpegawai" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAdd">Tambah Data</button>
        </div>
        <div class="col-md-4">&nbsp;
        </div>
        <div class="col-md-4">
            <form id="searchData" name="searchData" class="form-inline">
                <input type="text" name="key" id="key" class="form-control mr-2" placeholder="Search..." aria-label="Search">
                <button type="submit" class="btn btn-primary">Search</button>
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
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="formAdd" method="POST">
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
                        <div class="form-group">
                            <button type="submit" id="sendEdit">Update</button>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div id="e-response-add-data" class="text-center alert alert-success"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="sendEditNow">Update Data</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add Data-->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="formAdd" method="POST">
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
                        <div class="form-group">
                            <button type="submit" id="sendAdd">Save</button>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div id="response-add-data" class="text-center alert alert-success"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="sendNow">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>


    <div style="height:350px;">&nbsp;</div>
</main>
<?php
include 'footer.php';
?>
<script>
    $(document).ready(function() {
        hideElements();
        loadData();

        $("#sendNow").on('click', function(e) {
            $('#sendAdd').trigger('click');
        });

        $("#btnaddpegawai").on('click', function(e) {
            setTimeout(function() {
                document.getElementById('nip').focus();
            }, 750);
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
                        $('#response-add-data').html('<p>' + response.message + '</p>');
                        loadData();
                        setTimeout(function() {
                            $('#response-add-data').hide();
                        }, 3000);
                    } else {
                        $('#response-add-data').show();
                        $('#response-add-data').html('<p>' + response.message + '</p>');
                        setTimeout(function() {
                            $('#response-add-data').hide();
                        }, 3000);
                    }
                }
            });
        });

        $('#key').on('keyup', function() {
            console.log($(this).val());
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

    function setData(id, enip, enama, ealamat, ehp) {
        $('#eid').val(id);
        $('#enip').val(enip);
        $('#enama').val(enama);
        $('#ealamat').val(ealamat);
        $('#ehp').val(ehp);
    }

    function hideElements() {
        $('#sendAdd').hide();
        $('#response-add-data').hide();

        $('#sendEdit').hide();
        $('#e-response-add-data').hide();
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