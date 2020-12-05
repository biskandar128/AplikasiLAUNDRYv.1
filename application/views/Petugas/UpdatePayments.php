<div class="col-md">
    <div class="card bg-light">
        <div class=" card-header text-white bg-primary">Update Payments</div>
        <form action="<?php echo site_url('petugas/UpdatePayments'); ?>" method="post">
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="payment_id" class="form-control" id="inputEmail3" value="<?php echo $detail['payment_id']; ?>">
                    <label class="col-form-label">Method :</label>
                    <select name="name" class="form-control">
                        <option value="Cash">Cash</option>
                        <option value="Bayar Nanti">Bayar Nanti</option>

                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="btn_simpan" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>