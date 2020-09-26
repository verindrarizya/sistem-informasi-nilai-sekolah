<?php

class Siswa_model extends CI_Model{
    function updatepass($newpass,$username){
        $data = array(
            'password'=> $newpass
        );
        $this->db->where('username',$username);
        $this->db->update('akun',$data);
    }

    function record_count_rapor_siswa($username){
		$this->db->select('*');
        $this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');	
		$this->db->where('akun.username',$username);	
        $query = $this->db->get();
		return $query->num_rows();
	}

	public function fetch_rapor_siswa($limit, $start, $username){
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('nilai');
		$this->db->join('mapel', 'mapel.kdmapel = nilai.kdmapel');
		$this->db->join('detail_siswa', 'nilai.nis = detail_siswa.nis');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('akun.username',$username);		
        $query = $this->db->get();

		if($query->num_rows() > 0){
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	function get_siswa($nis){
		$this->db->select('*');
        $this->db->from('detail_siswa');
		$this->db->join('akun', 'akun.username = detail_siswa.username');
		$this->db->where('nis',$nis);
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

	function get_rapor_siswa($nis){
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
}

?>