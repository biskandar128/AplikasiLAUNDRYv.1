<div class="col-md">
    <div class="card bg-light">
        <div class=" card-header text-white bg-primary">Update Payments</div>
        <form action="<?php echo site_url('petugas/UpdatePackets'); ?>" method="post">
            <div class="card-body">

                <div class="form-group">
                    <input type="hidden" name="packets_id" class="form-control" id="inputEmail3" value="<?php echo $detail['packets_id']; ?>">
                    <label for="recipient-name" class="col-form-label">Packets :</label>
                    <input type="text" name="name" class="form-control" id="inputPassword3" placeholder="Masukkan Paket Laundry" value="<?php echo $detail['name']; ?>">
                </div>

                <div class=" form-group">
                    <label for="recipient-name" class="col-form-label">Price :</label>
                    <input type="text" name="price" class="form-control" id="inputPassword3" placeholder="Masukkan Harga Paket" value="<?php echo $detail['price']; ?>">
                </div>

            </div>
            <div class=" card-footer">
                <button type="submit" name="btn_simpan" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>