<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Point Member</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Data Point Member</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">                       
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Member ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!empty($approve)) {
                                    $i = 1;
                                    foreach ($approve as $id) {
                                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $id->username; ?></td>
                                <td><?= $id->name; ?></td>
                                <td><?php if ($id->pelanggan_id === null) {
                                            echo 'Non-member';
                                        } ?></td>
                                <td><a class="btn btn-approve btn-facebook" href="<?= base_url('petugas/approveMember/'.$id->users_id); ?>">Approve</a></td>
                            </tr>
                            <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>