<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CrudLaundryModel');
        $this->load->library('session');
        $this->load->database();
        if ($this->session->userdata('role') !== 'Petugas') {
            redirect('login/');
        }
    }

    public function index()
    {
        $table = 'tbl_transaction';

        $onjoin = [
                'tbl_transaction_detail' => $table.'.transaction_id = tbl_transaction_detail.transaction_id',
                'tbl_user' => $table.'.pelanggan_id = tbl_user.pelanggan_id',
                'tbl_payment' => $table.'.payment_id = tbl_payment.payment_id',
                'tbl_packets' => 'tbl_transaction_detail.packets_id = tbl_packets.packets_id',
            ];

        $date = [
                'month(transaction_date)' => date('m'),
                'year(transaction_date)' => date('Y'),
                ];

        $statusBaru = ['transaction_status' => 'Baru'];

        $statusProses = ['transaction_status' => 'Proses'];

        $statusSelesai = ['transaction_status' => 'Sudah Selesai'];

        $monthTransaction = ['month(transaction_date)' => date('m')];

        $data = [
                'transaction_id' => $this->CrudLaundryModel->getDataJoin($table, $onjoin),
                'monthIncome' => $this->CrudLaundryModel->getDataSum($date, 'tbl_transaction', 'transaction_total'),
                'statusBaru' => $this->CrudLaundryModel->getDataCount($statusBaru, 'tbl_transaction'),
                'statusProses' => $this->CrudLaundryModel->getDataCount($statusProses, 'tbl_transaction'),
                'statusSelesai' => $this->CrudLaundryModel->getDataCount($statusSelesai, 'tbl_transaction'),
                'monthTransaction' => $this->CrudLaundryModel->getDataCount($monthTransaction, 'tbl_transaction'),
                'content' => 'petugas/VBlank',
            ];

        $this->load->view('petugas/VBackend', $data);
    }

    // Form Laundry
    public function formLaundry()
    {
        $table = 'tbl_transaction_detail_temp';

        $onjoin = ['tbl_packets' => $table.'.packets_id = tbl_packets.packets_id'];

        $data['transactionLaundry'] = $this->CrudLaundryModel->getDataJoin($table, $onjoin);

        $data['pelanggan_id'] = $this->CrudLaundryModel->getData('tbl_user')->result();

        $data['packets'] = $this->CrudLaundryModel->getData('tbl_packets')->result();

        $data['payment'] = $this->CrudLaundryModel->getData('tbl_payment')->result();

        $data['content'] = 'petugas/formLaundry';

        $this->load->view('petugas/VBackend', $data);
    }

    public function prosesLaundry()
    {
        $code = (int) $this->CrudLaundryModel->generateCode(20, 'transaction_id', 'tbl_transaction');

        if ($this->input->post('action') === 'proses') {
            $packetPrice = (int) $this->CrudLaundryModel->getDataWhere('tbl_packets', 'packets_id', $this->input->post('packets_id'))->row()->price + 0;

            $weight = (int) $this->input->post('weight') + 0;

            $add = [
                'transaction_id' => $code,
                'packets_id' => $this->input->post('packets_id'),
                'weight' => $weight,
                'transaction_total' => $packetPrice * $weight,
            ];

            $this->CrudLaundryModel->addData('tbl_transaction_detail_temp', $add);

            redirect('petugas/formLaundry');
        } elseif ($this->input->post('action') === 'selesai') {
            $tbl_temp = $this->CrudLaundryModel->getData('tbl_transaction_detail_temp');

            $sum = $this->db->query('select sum(transaction_total) as total from tbl_transaction_detail_temp')->row();

            $pointUsed = $this->input->post('pointUsed');

            $count = $this->CrudLaundryModel->getDataWhere('tbl_user', 'pelanggan_id', $this->input->post('pelanggan_id'))->row()->point;
            // var_dump($count + 0 + 0.1 - $pointUsed);
            // die;
            $transaction = [
                'transaction_id' => $tbl_temp->row()->transaction_id,
                'pelanggan_id' => $this->input->post('pelanggan_id'),
                'payment_id' => $this->input->post('payment_id'),
                'transaction_date' => date('Y-m-d'),
                'transaction_status' => 'Baru',
                'transaction_total' => $sum->total,
            ];

            $this->CrudLaundryModel->addData('tbl_transaction', $transaction);

            for ($i = 0; $i < count($tbl_temp->result()); ++$i) {
                $this->db->query('INSERT INTO tbl_transaction_detail (transaction_id, packets_id, weight, transaction_total) VALUES ('.$tbl_temp->result()[$i]->transaction_id.','.$tbl_temp->result()[$i]->packets_id.','.$tbl_temp->result()[$i]->weight.','.$tbl_temp->result()[$i]->transaction_total.')');
            }

            // $countPoint['point'] = (((int) $this->db->query('select count(transaction_id) as sumPoint from tbl_transaction where pelanggan_id = '.$this->input->post('pelanggan_id'))->row()->sumPoint) * 0.1) - $this->input->post('pointUsed');
            $countPoint['point'] = $count + 0 + 0.1 - $pointUsed;

            $this->CrudLaundryModel->updateData('tbl_user', 'pelanggan_id', $this->input->post('pelanggan_id'), $countPoint);

            $this->CrudLaundryModel->deleteData('tbl_transaction_detail_temp', 'transaction_id', $tbl_temp->row()->transaction_id);

            redirect('petugas/formLaundry');
        }
    }

    public function deleteDataLaundry()
    {
        $id = $this->uri->segment('3');
        $this->CrudLaundryModel->deleteData('tbl_transaction_detail_temp', 'id', $id);

        $this->session->set_flashdata('flash', 'dihapus');

        redirect(base_url('petugas/formLaundry'));
    }

    // Member
    public function dataPoint()
    {
        $data['pelanggan_id'] = $this->CrudLaundryModel->getData('tbl_user')->result();

        $data['content'] = 'petugas/monitoringPoint';

        $this->load->view('petugas/VBackend', $data);
    }

    // History Transaction
    public function dataHistoryTransaction()
    {
        if ($this->uri->segment(4) === 'view') {
            $id = $this->uri->segment(3);
            $data['detail']['transaction'] = $this->CrudLaundryModel->getDataWhere('tbl_transaction', 'transaction_id', $id)->row();

            $data['detail']['member'] = $this->CrudLaundryModel->getDataWhere('tbl_user', 'pelanggan_id', $data['detail']['transaction']->pelanggan_id)->row();

            $data['detail']['payment'] = $this->CrudLaundryModel->getDataWhere('tbl_payment', 'payment_id', $data['detail']['transaction']->payment_id)->row();

            $data['transaction_detail'] = $this->db->query('SELECT * FROM tbl_transaction_detail JOIN tbl_packets ON tbl_transaction_detail.packets_id = tbl_packets.packets_id WHERE tbl_transaction_detail.transaction_id = '.$id)->result();

            $data['content'] = 'petugas/detailTransaction';
        } else {
            $table = 'tbl_transaction';

            $onjoin = [
            'tbl_user' => $table.'.pelanggan_id = tbl_user.pelanggan_id',
            'tbl_payment' => $table.'.payment_id = tbl_payment.payment_id',
        ];

            $data['transaction_id'] = $this->CrudLaundryModel->getDataJoin($table, $onjoin);
            $data['payment'] = $this->CrudLaundryModel->getData('tbl_payment')->result();

            $data['content'] = 'petugas/historyTransaction';
        }

        $this->load->view('petugas/VBackend', $data);
    }

    // Update Status
    public function updateStatus()
    {
        $id = $this->input->post('transaction_id');
        $payment_id = $this->CrudLaundryModel->getDataWhere('tbl_payment', 'name', $this->input->post('payment_id'))->row();
        $update = [
            'payment_id' => $payment_id->payment_id,
            'transaction_status' => $this->input->post('transaction_status'),
        ];
        $this->CrudLaundryModel->updateData('tbl_transaction', 'transaction_id', $id, $update);

        $this->session->set_flashdata('flash', 'diupdate');

        redirect(base_url('petugas/dataHistoryTransaction'));
    }

    // Payments.............................
    public function Payments()
    {
        if ($this->uri->segment(4) == 'view') {
            $payment_id = $this->uri->segment(3);
            $tampil = $this->CrudLaundryModel->getDataWhere('tbl_payment', 'payment_id', $payment_id)->row();
            $data['detail']['payment_id'] = $tampil->payment_id;
            $data['detail']['name'] = $tampil->name;
            $data['content'] = 'Petugas/UpdatePayments';
        } else {
            $data['Payments'] = $this->CrudLaundryModel->getData('tbl_payment')->result();
            $data['content'] = 'Petugas/Payments';
        }

        $this->load->view('Petugas/VBackend', $data);
    }

    public function FormPayments()
    {
        $data['content'] = 'FormPayments';
        $this->load->view('Petugas/VBackend', $data);
    }

    public function addPayments()
    {
        $add['name'] = $this->input->post('name');
        $this->CrudLaundryModel->addData('tbl_payment', $add);
        redirect(site_url('petugas/Payments'));
    }

    public function UpdatePayments()
    {
        $payment_id = $this->input->post('payment_id');
        $update['name'] = $this->input->post('name');
        $this->CrudLaundryModel->updateData('tbl_payment', 'payment_id', $payment_id, $update);
        redirect(site_url('petugas/Payments'));
    }

    public function deletePayments()
    {
        $id = $this->uri->segment('3');
        $this->CrudLaundryModel->deleteData('tbl_payment', 'payment_id', $id);

        $this->session->set_flashdata('flash', 'dihapus');

        redirect(base_url('petugas/payments'));
    }

    // End of Payments.............................

    // Packet Laundry
    public function Packets()
    {
        if ($this->uri->segment(4) == 'view') {
            $packets_id = $this->uri->segment(3);
            $tampil = $this->CrudLaundryModel->getDataWhere('tbl_packets', 'packets_id', $packets_id)->row();
            $data['detail']['packets_id'] = $tampil->packets_id;
            $data['detail']['name'] = $tampil->name;
            $data['detail']['price'] = $tampil->price;
            $data['content'] = 'Petugas/UpdatePackets';
        } else {
            $data['Packets'] = $this->CrudLaundryModel->getData('tbl_packets')->result();
            $data['content'] = 'Petugas/Packets';
        }

        $this->load->view('Petugas/VBackend', $data);
    }

    public function AddPackets()
    {
        $add['name'] = $this->input->post('name');
        $add['price'] = $this->input->post('price');
        $this->CrudLaundryModel->addData('tbl_packets', $add);
        redirect(site_url('petugas/Packets'));
    }

    public function UpdatePackets()
    {
        $packets_id = $this->input->post('packets_id');
        $update['name'] = $this->input->post('name');
        $update['price'] = $this->input->post('price');
        $this->CrudLaundryModel->updateData('tbl_packets', 'packets_id', $packets_id, $update);
        redirect(site_url('petugas/Packets'));
    }

    public function deletePackets()
    {
        $id = $this->uri->segment('3');
        $this->CrudLaundryModel->deleteData('tbl_packets', 'packets_id', $id);

        $this->session->set_flashdata('flash', 'dihapus');

        redirect(base_url('petugas/packets'));
    }

    // End of Pakcet Laundry

    public function laporanTransaction()
    {
        $table = 'tbl_transaction';

        $onjoin = [
            'tbl_user' => $table.'.pelanggan_id = tbl_user.pelanggan_id',
            'tbl_payment' => $table.'.payment_id = tbl_payment.payment_id',
        ];

        $data['transaction_id'] = $this->CrudLaundryModel->getDataJoin($table, $onjoin);

        $data['content'] = 'petugas/laporan';

        $this->load->view('petugas/VBackend', $data);
    }

    // Permintaan Member
    public function permintaan()
    {
        $data = [
            'approve' => $this->CrudLaundryModel->getDataWhere('tbl_user', 'pelanggan_id', null)->result(),
            'content' => 'petugas/permintaanMember',
        ];

        $this->load->view('petugas/VBackend', $data);
    }

    public function approveMember()
    {
        $id = $this->uri->segment(3);

        $update['pelanggan_id'] = (int) $this->CrudLaundryModel->generateCode(10, 'pelanggan_id', 'tbl_user');
        $update['point'] = 5;

        $this->CrudLaundryModel->updateData('tbl_user', 'users_id', $id, $update);
        $this->session->set_flashdata('flash', 'disetujui');
        redirect('petugas/permintaan');
    }

    public function autoSelect($id)
    {
        echo json_encode($this->CrudLaundryModel->getDataWhere('tbl_user', 'pelanggan_id', $id)->result());
    }

    public function logout()
    {
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('pelanggan_id');
        redirect('login/');
    }
}
