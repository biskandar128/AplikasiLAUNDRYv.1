<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-12 col-sm-12">

            <!-- <div class="card bg-light">
                <div class="card-header"> Profile Account </div> -->

            <div class="card shadow text-white bg-dark">

                <div class="card-body mb-4">


                    <h3 class="profile-username text-center">
                        <img class="img-profile rounded-circle centered w-50" src="<?= base_url('asset/backend/img/undraw_profile.svg'); ?>" alt="User profile picture">
                    </h3>

                    <p class="text-center mt-5">Member Laundry Amanah <br> <?= $pelanggan_id->name; ?></p>
                    <p class="text-center">No. <?= $pelanggan_id->pelanggan_id; ?></p>
                    <ul class="list-group text-white">
                        <li class="list-group-item list-group-item-dark">
                            <b>No. HP : 0<?= $pelanggan_id->no_hp; ?></b> <br>
                            <i class="pull-right"></i>
                        </li>
                        <li class="list-group-item list-group-item-dark">
                            <b>Alamat : <?= $pelanggan_id->alamat; ?></b> <br>
                            <i class="pull-right"></i>
                        </li>
                        <li class="list-group-item list-group-item-dark">
                            <b>Point : <?= $pelanggan_id->point; ?></b> <br>
                            <i class="pull-right"></i>
                        </li>
                    </ul>

                    <!-- <a href="<?= base_url('Welcome/profil'); ?>" class="btn btn-primary btn-block"><b>Laundry</b></a> -->
                </div>
                <!-- /.box-body -->
            </div>

            <!-- </div> -->
        </div>

        <div class="col-md-9 col-12 col-sm-12">

            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">History Transaction</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (!empty($history)) {
                                    $i = 1;
                                    foreach ($history as $id) {
                                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $id->transaction_date; ?></td>
                                    <td><?= $id->transaction_id; ?></td>
                                    <td><?= $id->transaction_status; ?></td>
                                    <td><?= $id->transaction_total; ?></td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>