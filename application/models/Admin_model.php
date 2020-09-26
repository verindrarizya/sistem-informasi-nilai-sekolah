<?php

class Admin_model extends CI_Model{
    function hitung_siswa(){
		$this->db->where('level', 'siswa');
		$query = $this->db->get('akun');
		return $query->num_rows();
    }
    
    function hitung_mapel(){
        $query = $this->db->get('mapel');
		return $query->num_rows();
    }
    
    public function record_count_siswa(){
        $this->db->select('*');
        $this->db->from('detail_siswa');
        $this->db->join('akun', 'akun.username = detail_siswa.username');
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function fetch_sis($limit, $start){
		$this->db->limit($limit, $start);
		$this->db->select('*');
        $this->db->from('detail_siswa');
        $this->db->join('akun', 'akun.username = detail_siswa.username');
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function add_siswa($arg){
		$data = array(
			'username' => $arg[1],
			'password'=> md5($arg[4]),
			'level'=> 'siswa',
			'nama' => $arg[2]
		);
		$this->db->insert('akun',$data);
		$detail = array(
			'nis' => $arg[0],
			'alamat'=> $arg[3],
			'username'=> $arg[1]
		);
		$this->db->insert('detail_siswa',$detail);
	}

	function delete_siswa($id){
		$this->db->where('username',$id);
		$this->db->delete('detail_siswa');

		$this->db->where('username',$id);
		$this->db->delete('akun');
	}

	function update_siswa($form,$username){
		$data = array(
			'a.nama'=> $form[2]
		);
		$detail = array(
			'b.alamat'=> $form[3]
		);
		$this->db->where('a.username',$username);
		$this->db->update('akun as a',$data);
		$this->db->where('b.username',$username);
		$this->db->update('detail_siswa as b',$detail);
	}

	public function record_count_mapel(){
        $this->db->select('*');
        $this->db->from('mapel');
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function fetch_pel($limit, $start){
		$this->db->limit($limit, $start);
		$this->db->select('*');
        $this->db->from('mapel');
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function add_mapel($arg){
		$data = array(
			'kdmapel' => $arg[0],
			'nmmapel'=> $arg[1],
			'akm'=> $arg[2]
		);
		$this->db->insert('mapel',$data);
	}
	function update_mapel($form,$kdmapel){
		$data = array(
			'nmmapel'=> $form[1],
			'akm'=> $form[2]
		);
		$this->db->where('kdmapel',$kdmapel);
		$this->db->update('mapel',$data);
	}
	function delete_mapel($id){
		$this->db->where('kdmapel',$id);
		$this->db->delete('mapel');
	}

	function tampil_siswa(){
		$this->db->select('*');
        $this->db->from('detail_siswa');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$query = $this->db->get();

		if($query->result()){
            foreach ($query->result() as $content) {
                $data[] = array(
                    $content->nis,
                    $content->nama
                );
            }
            return $data;
        }else{
            return FALSE;
        }
	}

	function tampil_mapel(){
		$this->db->select('*');
        $this->db->from('mapel');
		$query = $this->db->get();

		if($query->result()){
            foreach ($query->result() as $content) {
                $data[] = array(
                    $content->kdmapel,
                    $content->nmmapel
                );
            }
            return $data;
        }else{
            return FALSE;
        }
	}

	function record_count_rapor_siswa($nis){
		$this->db->select('*');
        $this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');	
		$this->db->where('nilai.nis',$nis);	
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function fetch_rapor_siswa($limit, $start, $nis){
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('nilai.nis',$nis);		
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function record_count_rapor_mapel($kdmapel){
		$this->db->select('*');
        $this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');	
		$this->db->where('nilai.kdmapel',$kdmapel);	
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function fetch_rapor_mapel($limit, $start, $kdmapel){
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('nilai.kdmapel',$kdmapel);		
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function add_rapor($arg){
		$data = array(
			'nis' => $arg[1],
			'kdmapel'=> $arg[0],
			'absen'=> $arg[2],
			'tugas'=> $arg[3],
			'uts'=> $arg[4],
			'uas'=> $arg[5],
		);
		$this->db->insert('nilai',$data);
	}

	function delete_nilai($kdmapel,$nis){
		$this->db->where('kdmapel',$kdmapel);
		$this->db->where('nis',$nis);
		$this->db->delete('nilai');
	}

	function get_siswa(){
		$this->db->select('*');
        $this->db->from('detail_siswa');
        $this->db->join('akun', 'akun.username = detail_siswa.username');
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $content) {
				$data[] = array(
					$content->nis,
					$content->nama,
					$content->alamat
				);
			}
			return $data;
		}
		return false;
	}

	function get_mapel(){
		$this->db->select('*');
        $this->db->from('mapel');
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $content) {
				$data[] = array(
					$content->kdmapel,
					$content->nmmapel,
					$content->akm
				);
			}
			return $data;
		}
		return false;
	}

	function get_nilai_siswa($nis){
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('nilai.nis',$nis);	
		$query = $this->db->get();
		if($query->result()){
			foreach ($query->result() as $content) {
				$data[] = array(
					$content->nis,
					$content->nama,
					$content->nmmapel,
					$content->akm,
					$content->absen,
					$content->tugas,
					$content->uts,
					$content->uas
				);
			}
			return $data;
		}else{
			return FALSE;
		}
	}

	function get_nilai_mapel($kdmapel){
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('nilai.kdmapel',$kdmapel);	
		$query = $this->db->get();
		if($query->result()){
			foreach ($query->result() as $content) {
				$data[] = array(
					$content->nis,
					$content->nama,
					$content->nmmapel,
					$content->akm,
					$content->absen,
					$content->tugas,
					$content->uts,
					$content->uas
				);
			}
			return $data;
		}else{
			return FALSE;
		}
	}
}

?>