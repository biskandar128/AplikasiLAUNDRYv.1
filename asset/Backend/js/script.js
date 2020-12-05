$('#transaction_status').on('show.bs.modal', function(e) {
    let button = $(e.relatedTarget);
    let member = button.data('pelanggan');
    let id = button.data('transaction');
    let payment = button.data('payment');
    let status = button.data('status');

    console.log(document.getElementById('payment_id').value = payment);
    console.log(document.getElementById('transaction_statusData').value = status);

    document.getElementById('transaction_id').value = id;
    document.getElementById('member_id').value = member;
    document.getElementById('transaction_status').value = status;

    $('#transaction_status').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });
});

$('#pelanggan_id').select2();

$('#packets_id').select2();

const flashdata = $('.flash-data').data('flashdata');
if (flashdata) {
    Swal.fire({
        icon: 'success',
        title: 'Data berhasil ' + flashdata,
        showConfirmButton: false,
        timer: 1500
    });
}


$('.btn-hapus').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ingin menghapus data ini?',
        text: "Data akan hilang selamanya",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus saja!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});

$('.btn-approve').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        text: "Apakah anda yakin ingin mengkonfirmasi member ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Saya yakin'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
        }
    });
});

function showDiv() {
    let e = document.getElementById('payment_id');
    let text = e.options[e.selectedIndex].text;
    if (text === 'Cash') {
        $('#nominalRow').show();
        $('#kembalianRow').show();
        $('#pointRow').show();
    } else if (text === 'Bayar Nanti') {
        $('#nominalRow').hide();
        $('#kembalianRow').hide();
        $('#pointRow').hide();
    }
};

let totalValue = 0;
$('tr #sumTransactionTotal').each(function() {
    let currentRow = parseInt($(this).text());
    totalValue += currentRow;
});

document.getElementById('totalTransaction').innerHTML = totalValue;

function sum() {
    let total = document.getElementById('totalTransaction').innerHTML;
    let point = document.getElementById('pointUsed').value || 0;
    let bayar = document.getElementById('nominal').value || 0;
    let discount = parseInt(total) - (parseInt(total) * Number(point));
    let kembali = parseInt(bayar) - parseInt(discount);

    console.log(discount, total, discount < total, Number(point), kembali);

    if (!isNaN(kembali)) {
        document.getElementById('kembalian').value = kembali;
        document.getElementById('discount').innerHTML = (discount < total) ? ' || Diskon (' + discount + ')' : ' (Tidak ada diskon)';
    }


};

$('#btn-selesai').on('click', function(e) {
    // e.preventDefault();
    let member = document.getElementById('pelanggan_id').value;
    let nominal = document.getElementById('nominal').value;
    let pointNum = document.getElementById('pointNum').value;
    let pointUsed = document.getElementById('pointUsed').value;
    let pay = document.getElementById('payment_id');
    let payment = pay.options[pay.selectedIndex].text;
    let payVal = pay.value;
    let data = document.getElementById('dataLaundry').rows.length;

    console.log(Boolean(pointNum), pointUsed < 1);

    if (data < 1) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: `Data Tidak boleh kosong!`
        });
    } else if (!Boolean(member.match(/\d/g))) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: `Data Pelanggan Tidak boleh kosong!`
        });
    } else if (Boolean(payVal.match(/\d/g)) === false) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: `Data Payment Tidak boleh kosong!`
        });
    } else if (Boolean(payVal.match(/\d+/g))) {
        if (payment == 'Cash') {
            if (Boolean(nominal.match(/\d+/g)) === false) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: `Nominal Tidak boleh kosong!`
                });
            } else {
                if ($('#nominal').val() >= totalValue && pointUsed <= pointNum && pointUsed < 1) {

                    $('#form_laundry').submit();

                } else {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: `Uang pembayaran tidak boleh kurang dari total bayar dan Point member tidak boleh lebih dari jumlah!`
                    });
                }
            }
        } else if (payment == 'Bayar Nanti') {
            $('#form_laundry').submit();
        }
    }

});

$('#pelanggan_id').on('change', function(e) {
    let id = e.target.value;

    $.get('../petugas/autoSelect/' + id, function(data) {
        console.log(id);
        console.log(data);

        $('#point').empty();
        $.each(JSON.parse(data), function(index, el) {
            $('#point').append(`Point Belanja Anda <br><input type="number" id="pointNum" class="form-control" id="point" placeholder="Point Member" value="${el.point}" readonly>`);
            console.log(el.point);
        });
    });

});