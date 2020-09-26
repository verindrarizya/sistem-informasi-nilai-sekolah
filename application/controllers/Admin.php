<?php

class Admin extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('Admin_model');
    }

    function tampil_siswa(){
        $config = array();
		$config['base_url'] = base_url()."index.php/admin/tampil_siswa/";
		$config['total_rows'] = $this->Admin_model->record_count_siswa();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->Admin_model->fetch_sis($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		$data['page'] = $page;
        $this->load->view('halsis_admin',$data);
    }

    function submit_siswa(){
        $this->Admin_model->add_siswa($this->input->post('var'));
        echo "<script>alert('Data Berhasil DiInput!'); window.location = '".base_url('index.php/admin/tampil_siswa')."'</script>";
    }

    function ubah_siswa(){
        $this->Admin_model->update_siswa($this->input->post('var'),$this->input->post('oldusername'));
        echo "<script>alert('Data Berhasil DiUpdate!'); window.location = '".base_url('index.php/admin/tampil_siswa')."'</script>";
    }

    function hapus_siswa(){
        $this->Admin_model->delete_siswa($this->uri->rsegment(3));
        echo "<script>alert('Data Berhasil DiHapus!'); window.location = '".base_url('index.php/admin/tampil_siswa')."'</script>";
    }

    function tampil_mapel(){
        $config = array();
		$config['base_url'] = base_url()."index.php/admin/tampil_mapel/";
		$config['total_rows'] = $this->Admin_model->record_count_mapel();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->Admin_model->fetch_pel($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		$data['page'] = $page;
        $this->load->view('halpel_admin',$data);
    }


    function submit_mapel(){
        $this->Admin_model->add_mapel($this->input->post('var'));
        echo "<script>alert('Data Berhasil DiInput!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
    }

    function ubah_mapel(){
        $this->Admin_model->update_mapel($this->input->post('var'),$this->input->post('kdmapel'));
        echo "<script>alert('Data Berhasil DiUpdate!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
    }

    function hapus_mapel(){
        $this->Admin_model->delete_mapel($this->uri->rsegment(3));
        echo "<script>alert('Data Berhasil DiHapus!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
    }

    function pilih_rapor(){
        $data['siswa'] = $this->Admin_model->tampil_siswa();
        $data['mapel'] = $this->Admin_model->tampil_mapel();
        $this->load->view('pilih_rapor',$data);
    }

    function tampil_rapor_siswa(){
        $nis = $this->input->post('pilih');
        $config = array();
		$config['base_url'] = base_url()."index.php/admin/tampil_rapor_siswa/";
		$config['total_rows'] = $this->Admin_model->record_count_rapor_siswa($nis);
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->Admin_model->fetch_rapor_siswa($config['per_page'], $page, $nis);
		$data['links'] = $this->pagination->create_links();
		$data['page'] = $page;
        $this->load->view('halpor_admin_siswa',$data);
    }

    function tampil_rapor_mapel(){
        $kdmapel = $this->input->post('pilih');
        $config = array();
		$config['base_url'] = base_url()."index.php/admin/tampil_rapor_mapel/";
		$config['total_rows'] = $this->Admin_model->record_count_rapor_mapel($kdmapel);
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['results'] = $this->Admin_model->fetch_rapor_mapel($config['per_page'], $page, $kdmapel);
		$data['links'] = $this->pagination->create_links();
		$data['page'] = $page;
        $this->load->view('halpor_admin_mapel',$data);
    }

    function submit_nilai(){
        $this->Admin_model->add_rapor($this->input->post('var'));
        echo "<script>alert('Data Nilai Berhasil DiInput!'); window.location = '".base_url('index.php/admin/pilih_rapor')."'</script>";
    }

    function hapus_nilai(){
        $this->Admin_model->delete_nilai($this->uri->rsegment(3),$this->uri->rsegment(4));
        echo "<script>alert('Data Berhasil DiHapus!'); window.location = '".base_url('index.php/admin/pilih_rapor')."'</script>";
    }

    function cetak_siswa(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_siswa_pdf();
        }else if($pilih == 'excel'){
            $this->cetak_siswa_excel();
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/admin/tampil_siswa')."'</script>";
        }
    }

    function cetak_siswa_pdf(){
        $this->load->library('parser');
        $result = $this->Admin_model->get_siswa();
        $pdf='print';
        $output = "<h1>Data Siswa SMAN 23 Jakarta</h1>";
        $output .= "<table border='1' width='100%' cellpadding='5'>
                   <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>NAMA</th>
                        <th>Alamat</th>
                    </tr>";
        $no = 1;
        foreach ($result as $data){
        $output .= "<tr>
                        <td>$no</td>
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

    function cetak_siswa_excel(){
        $data['title']= 'Data Siswa';
        $data['result'] = $this->Admin_model->get_siswa();

        $this->load->view('siswa_excel',$data);
    }

    function cetak_mapel(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_mapel_pdf();
        }else if($pilih == 'excel'){
            $this->cetak_mapel_excel();
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
        }
    }

    function cetak_mapel_excel(){
        $data['title']= 'Data Mapel';
        $data['result'] = $this->Admin_model->get_mapel();

        $this->load->view('mapel_excel',$data);
    }

    function cetak_mapel_pdf(){
        $this->load->library('parser');
        $result = $this->Admin_model->get_mapel();
        $pdf='print';
        $output = "<h1>Data Mata Pelajaran</h1>";
        $output .= "<table border='1' width='100%' cellpadding='5'>
                   <tr>
                        <th>No.</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Angka Ketuntasan Minimal</th>
                    </tr>";
        $no = 1;
        foreach ($result as $data){
        $output .= "<tr>
                        <td>$no</td>
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

    function cetak_nilai_siswa(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_nilai_siswa_pdf($this->input->post('nis'));
        }else if($pilih == 'excel'){
            $this->cetak_nilai_siswa_excel($this->input->post('nis'));
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
        }
    }

    function cetak_nilai_siswa_excel($nis){
        $data['title']= 'Laporan Hasil Belajar'.$nis;
        $data['result'] = $this->Admin_model->get_nilai_siswa($nis);

        $this->load->view('nilai_siswa_excel',$data);
    }

    function cetak_nilai_siswa_pdf($nis){
        $this->load->library('parser');
        $result = $this->Admin_model->get_nilai_siswa($nis);
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

    function cetak_nilai_mapel(){
        $pilih = $this->input->post('pilih');
        if($pilih == 'pdf'){
            $this->cetak_nilai_mapel_pdf($this->input->post('kdmapel'));
        }else if($pilih == 'excel'){
            $this->cetak_nilai_mapel_excel($this->input->post('kdmapel'));
        }else{
            echo "<script>alert('Cetak Error!'); window.location = '".base_url('index.php/admin/tampil_mapel')."'</script>";
        }
    }

    function cetak_nilai_mapel_excel($kdmapel){
        $data['title']= 'Laporan Hasil Belajar'.$kdmapel;
        $data['result'] = $this->Admin_model->get_nilai_mapel($kdmapel);

        $this->load->view('nilai_mapel_excel',$data);
    }

    function cetak_nilai_mapel_pdf($kdmapel){
        $this->load->library('parser');
        $result = $this->Admin_model->get_nilai_mapel($kdmapel);
        $pdf='print';
        $output = "<h1>Laporan Hasil Belajar</h1>";
        foreach($result as $data){
        $output .= "<table border='0' width='100%'>
                    <tr>
                    <td valign='top'>Nama Mapel:".$data[2]."</td>
                    </tr>
                    </table>";
                    break;}
        $output .= "<table border='1' width='100%' cellpadding='5'>
                   <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
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
                            <td>$data[1]</td>
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

    private function _generate_pdf($html,$paper='A4'){
        $this->load->library('mpdf60/mpdf');
        $mpdf = new mPDF('utf-8',$paper);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}


?>