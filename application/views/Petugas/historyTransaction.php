<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>



<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">History Transaction</h1>
    </div>
    
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">History Laundry Member</h6>
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
                                    <th>Aksi</th>
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
                                    <td><a href="<?= base_url('petugas/dataHistoryTransaction/'.$id->transaction_id.'/view'); ?>" class="btn btn-info">Detail</a> <button type="button" data-toggle="modal" data-target="#transaction_status" data-pelanggan="<?= $id->pelanggan_id; ?>" data-transaction="<?= $id->transaction_id; ?>" data-payment="<?= ($id->name); ?>" data-status="<?= $id->transaction_status; ?>" class="btn btn-facebook">Update</a></td>
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


<div id="transaction_status" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="modalTransactionStatus" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransactionStatus">Update Transaction Status</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('petugas/updateStatus'); ?>" method="post">
                    <div class="form-group">
                        <label for="transaction_id" class="col-form-label">Transaction ID</label>
                        <input type="text" id="transaction_id" name="transaction_id" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="member_id" class="col-form-label">Member ID</label>
                        <input name="pelanggan_id" id="member_id" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="payment_id" class="col-form-label">Payment</label>
                        <select name="payment_id" id="payment_id" class="form-control">
                            <option value="Cash">Cash</option>
                            <option value="Bayar Nanti">Bayar Nanti</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="transaction_status" class="col-form-label">Status</label>
                        <select name="transaction_status" id="transaction_statusData" class="form-control">
                            <option value="Baru">Baru</option>
                            <option value="Proses">Proses</option>
                            <option value="Sudah Selesai">Sudah Selesai</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary">Update</button>   
            </form>
            </div>
        </div>
    </div>
</div>