<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

<div class="col-md">
    <div class="card shadow ">
        <div class="card-header ">
            <!-- <a href="" class="btn btn-primary float-right"> Add Payment Method </a> -->
            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#AddData" data-whatever="@mdo">Add Payment Method</a>
            <h6 class="m-0 font-weight-bold text-primary">Payments Method</h6>
        </div>
        <div class="card-body">

            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td><a href="" class="btn btn-warning"> Update </a></td>
                    </tr> -->
                    <?php
                    if (!empty($Payments)) {
                        $i = 1;
                        foreach ($Payments as $Pay) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $Pay->name; ?></td>
                                <td>
                                    <a href="<?php echo site_url('petugas/Payments/'.$Pay->payment_id.'/view'); ?>" class="btn btn-warning" id="editModal">Update</a>
                                    <a href="<?php echo site_url('petugas/deletePayments/'.$Pay->payment_id); ?>" class="btn btn-google" id="editModal">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="AddData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="<?php echo site_url('petugas/addPayments'); ?>" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Method :</label>
                                <select name="name" class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="Bayar Nanti">Bayar Nanti</option>

                                </select>
                                <!-- <input type="text" class="form-control" id="recipient-name"> -->
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="btn_simpan" class="btn btn-success">Submit</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- End Modal Add -->

    </div>
</div>