<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah pendapatan (Bulanan) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah pendapatan (Bulanan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp '.number_format($monthIncome->transaction_total, 2, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Transaksi (Baru) -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Proses Transaksi (BARU)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statusBaru; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-battery-empty fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Transaksi (Proses) -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Proses Transaksi (PROSES)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statusProses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-battery-half fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Transaksi (Selesai) -->
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Proses Transaksi (SELESAI)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $statusSelesai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-battery-full fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah transaksi (Mingguan) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Transaksi (Bulan ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $monthTransaction; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="car shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Proses Laundry</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl. Transaksi</th>
                            <th>Transaction ID</th>
                            <th>Member</th>
                            <th>Paket</th>
                            <th>Status</th>
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
                            <td><?= $id->transaction_date; ?></td>
                            <td><?= $id->transaction_id; ?></td>
                            <td><?= $id->pelanggan_id; ?></td>
                            <td><?= $id->name; ?></td>
                            <td><?= $id->transaction_status; ?></td>
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

