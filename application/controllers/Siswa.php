<?php

class Siswa extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->model('Siswa_model');
        $this->load->library('pagination');
    }

    function ubahpass_siswa(){
        $this->load->view('ubahpass_siswa');
    }

    function updatepass_siswa(){
        $oldpass = md5($this->input->post('passold'));
        $newpass = md5($this->input->post('passnew'));
        $username = $this->session->userdata('username');
        if($oldpass == $this->session->userdata('password')){
            $this->Siswa_model->updatepass($newpass,$username);
            echo "<script>alert('Password Kamu Berhasil di Perbarui!'); window.location = '".base_url('index.php/login/dashboard')."'</script>";
        }else{
            echo "<script>alert('Password Lama Kamu Salah!'); window.location = '".base_url('index.php/siswa/ubahpass')."'</script>";
        }
    }

    function tampil_rapor(){
        $username = $this->session->userdata('username');
        $config = array();
		$config['base_url'] = base_url()."index.php/admin/tampil_rapor_siswa/";
		$config['total_rows'] = $this->Siswa_model->record_count_rapor_siswa($username);
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->Siswa_model->fetch_rapor_siswa($config['per_page'], $page, $username);
		$data['links'] = $this->pagination->create_links();
		$data['page'] = $page;
        $this->load->view('halpor_siswa',$data);
    }

    function cetak_data(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_data_pdf($this->input->post('nis'));
        }else if($pilih == 'excel'){
            $this->cetak_data_excel($this->input->post('nis'));
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/login/dashboard')."'</script>";
        }
    }

    function cetak_data_pdf($nis){
        $this->load->library('parser');
        $result = $this->Siswa_model->get_siswa($nis);
        $pdf='print';
        $output = "<h1>Data Siswa SMAN 23 JAKARTA</h1>";
        $output .= "<table border='1' width='100%' cellpadding='5'>
                   <tr>
                        <th>Nomor Induk Siswa</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                    </tr>";
        foreach ($result as $data){
        $output .= "<tr>
                        <td>$data[0]</td>
                        <td>$data[1]</td>
                        <td>$data[2]</td>
                    </tr>";
        $no++;
        }
        $output .= "</table>";
        if($pdf=='print'){
            $this->_generate_pdf($output);
        }else{
            $this->output->set_output($output);
        }
    }

    function cetak_data_excel($nis){
        $data['title']= 'Biodata Siswa '.$nis;
        $data['result'] = $this->Siswa_model->get_siswa($nis);

        $this->load->view('data_siswa_excel',$data);
    }

    function cetak_rapor(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_rapor_pdf($this->input->post('nis'));
        }else if($pilih == 'excel'){
            $this->cetak_rapor_excel($this->input->post('nis'));
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
        }
    }

    function cetak_rapor_pdf($nis){
        $this->load->library('parser');
        $result = $this->Siswa_model->get_rapor_siswa($nis);
        $pdf='print';
        $output = "<h1>Laporan Hasil Belajar</h1>";
        foreach($result as $data){
        $output .= "<table border='0' width='100%'>
                    <tr>
                    <td valign='top'>
                    NIS :".$data[0]."<br>
                    Nama:".$data[1]."<br>
                    </td>
                    </tr>
                    </table>";
                    break;}
        $output .= "<table border='1' width='100%' cellpadding='5'>
                   <tr>
                        <th>No.</th>
                        <th>Nama Mapel</th>
                        <th>AKM</th>
                        <th>Absen</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Nilai Akhir</th>
                        <th>Keterangan</th>
                    </tr>";
        $no = 1;
        $total = 0;
        $jum = 0;
        foreach ($result as $data){
            $na = ($data[4]+$data[5]+$data[6]+(($data[7]*2)/2))/4;
            $total = number_format($total + $na,1);
            $jum++;
            if($na >= $data[3]){
                $ket = "Terpenuhi";
            }else{
                $ket = "Tidak Terpenuhi";
            }
            $output .= "<tr>
                            <td>$no</td>
                            <td>$data[2]</td>
                            <td>$data[3]</td>
                            <td>$data[4]</td>
                            <td>$data[5]</td>
                            <td>$data[6]</td>
                            <td>$data[7]</td>
                            <td>$na</td>
                            <td>$ket</td>
                        </tr>";
        $no++;
        }
        $rata = $total/$jum;
        $output .="<tr>
                        <td colspan='7' align='right'>Total :</td>
                        <td>$total</td>
                        <td colspan='2'></td>
                    </tr>
                    <tr>
                        <td colspan='7' align='right'>Rata - Rata :</td>
                        <td>".number_format($rata,1)."</td>
                        <td colspan='2'></td>
                    </tr>";
        $output .= "</table>";
        if($pdf=='print'){
            $this->_generate_pdf($output);
        }else{
            $this->output->set_output($output);
        }
    }

    function cetak_rapor_excel($nis){
        $data['title']= 'Rapor Siswa '.$nis;
        $data['result'] = $this->Siswa_model->get_rapor_siswa($nis);

        $this->load->view('rapor_siswa_excel',$data);
    }

    private function _generate_pdf($html,$paper='A4'){
        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPDF('utf-8',$paper);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}


?>