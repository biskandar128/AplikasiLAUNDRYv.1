<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaction</h1>
        <a href="<?= base_url('petugas/dataHistoryTransaction'); ?>" class="btn btn-google">Kembali</a>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">History Laundry Member</h6>
                </div>
                <div class="card-body">
                <table class="table mb-5">
                    <tr>
                        <td class="w-25">Transaction ID</td>
                        <td><?= $detail['transaction']->transaction_id; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Transaction Date</td>
                        <td><?= $detail['transaction']->transaction_date; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Member ID</td>
                        <td><?= $detail['member']->pelanggan_id; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?= $detail['member']->name; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?= $detail['transaction']->transaction_status; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Transaction Total</td>
                        <td><?= $detail['transaction']->transaction_total; ?></td>
                        <td>Pembayaran</td>
                        <td><b><?= $detail['payment']->name; ?></b></td>
                    </tr>
                </table>
                    <div class="table-responsive">                       
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paket</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($transaction_detail)) {
                                    $i = 1;
                                    foreach ($transaction_detail as $id) {
                                        ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $id->name; ?></td>
                                    <td><?= $id->weight; ?></td>
                                    <td><?= $id->price; ?></td>
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