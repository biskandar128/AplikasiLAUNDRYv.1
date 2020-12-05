<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Transaction</h1>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Detail Laundry</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-1">Tgl. Laundry : <br><?= date('d-m-Y'); ?></div>
                        <div class="col-12 col-md-6 mb-1">
                            <form action="<?= base_url('petugas/prosesLaundry'); ?>" method="post" id="form_laundry">
                            Pilih Tipe Pembayaran <br>
                            <select class="form-control" id="payment_id" name="payment_id" onchange="showDiv();" required>
                                <option selected disabled>-- Pilih Pembayaran --</option>
                                <?php
                                if (!empty($payment)) {
                                    $i = 1;
                                    foreach ($payment as $pay) {
                                        ?>
                                <option value="<?= $pay->payment_id; ?>" data-pay="<?= $pay->name; ?>"><?= $pay->name; ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3">Total Bayar : <br>Rp. <span id="totalTransaction" onkeyup="sum();"></span><span id="discount"></span></div>
                        <div class="col-12 col-md-6 mb-3" id="nominalRow">Nominal Pembayaran <br><input type="number" class="form-control" id="nominal" onkeyup="sum();" placeholder="Nominal"></div>
                        <div class="col-12 col-md-6 mb-3">
                            Pilih Member <br>
                            <select name="pelanggan_id" class="form-control" id="pelanggan_id">
                                <option selected disabled>-- Pilih Member --</option>
                                <?php
                                if (!empty($pelanggan_id)) {
                                    $i = 1;
                                    foreach ($pelanggan_id as $id) {
                                        ?>
                                <option value="<?= $id->pelanggan_id; ?>"><?= $id->pelanggan_id; ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-3" id="kembalianRow">Kembalian Anda <br><input type="text" class="form-control" id="kembalian" placeholder="Kembalian" readonly></div>
                        <div class="col-12 col-md-6 mb-3" id="point">Point Belanja Anda <br><input type="number" id="pointNum" class="form-control" placeholder="Point Member" readonly></div>
                        <div class="col-12 col-md-6 mb-3" id="pointRow">Masukkan Point Untuk Potongan <br><input type="text" name="pointUsed" value="0" class="form-control" onkeyup="sum();" id="pointUsed"></div>
                    </div>
                    <div class="table-responsive">                        
                        
                        <table class="table table-striped" id="dataLaundry">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Packet</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!empty($transactionLaundry)) {
                                    $i = 1;
                                    foreach ($transactionLaundry as $tl) {
                                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tl->name; ?></td>
                                <td><?= $tl->weight; ?></td>
                                <td><?= $tl->price; ?></td>
                                <td id="sumTransactionTotal"><?= $tl->transaction_total; ?></td>
                                <td><a class="btn btn-danger btn-hapus" href="<?= base_url('petugas/deleteDataLaundry/'.$tl->id); ?>">Hapus</a></td>
                            </tr>
                            <?php
                                    }
                                } ?>
                            </tbody>
                        </table>
                        <button class="btn btn-info" name="action" value="selesai" id="btn-selesai">Selesai</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Form Laundry</h6>
                </div>
                <div class="card-body">
                        
                        <div class="form-group">
                            <label for="packets_id">Paket</label>
                            <select class="form-control" id="packets_id" name="packets_id" required>
                                <option selected disabled>-- Pilih Paket --</option>
                                <?php
                                if (!empty($packets)) {
                                    $i = 1;
                                    foreach ($packets as $paket) {
                                        ?>
                                <option value="<?= $paket->packets_id; ?>"><?= $paket->name; ?> : Rp. <?= $paket->price; ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="number" class="form-control" id="weight" name="weight" placeholder="Weight">
                        </div>
                        <button class="btn btn-primary" name="action" value="proses">Proses</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>