<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

<div class="col-md">
    <div class="card shadow ">
        <div class="card-header ">
            <!-- <a href="" class="btn btn-primary float-right"> Add Payment Method </a> -->
            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#AddData" data-whatever="@mdo">Add Laundry Packet</a>
            <h6 class="m-0 font-weight-bold text-primary">Packets Laundry</h6>
        </div>
        <div class="card-body">

            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Packets</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($Packets)) {
                        $i = 1;
                        foreach ($Packets as $Pack) {
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $Pack->name; ?></td>
                                <td><?= $Pack->price; ?></td>
                                <td>
                                    <a href="<?php echo site_url('petugas/Packets/'.$Pack->packets_id.'/view'); ?>" class="btn btn-warning" id="editModal">Update</a>
                                    <a href="<?php echo site_url('petugas/deletePackets/'.$Pack->packets_id); ?>" class="btn btn-google" id="editModal">Delete</a>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Packet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="<?php echo site_url('petugas/AddPackets'); ?>" method="POST">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Packets :</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Paket Laundry">
                            </div>

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Price :</label>
                                <input type="text" name="price" class="form-control" placeholder="Masukkan Harga Paket">
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