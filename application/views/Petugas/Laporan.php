<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Transaction</h1>
    </div>
    
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Laporan Laundry</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">                       
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaction ID</th>
                                    <th>Pelanggan ID</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($transaction_id)) {
                                    $i = 1;
                                    foreach ($transaction_id as $id) {
                                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $id->transaction_id; ?></td>
                                    <td><?= $id->pelanggan_id; ?></td>
                                    <td><?= $id->name; ?></td>
                                    <td><?= $id->transaction_date; ?></td>
                                    <td><?= $id->transaction_status; ?></td>
                                    <td><?= $id->transaction_total; ?></td>
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
