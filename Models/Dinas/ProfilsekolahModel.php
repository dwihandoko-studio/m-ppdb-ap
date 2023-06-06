<?php

namespace App\Models\Dinas;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
use Firebase\JWT\JWT;

class ProfilsekolahModel extends Model
{
    protected $table = "_ref_profil_sekolah a";
    protected $column_order = array(null, null, 'a.npsn', 'b.nama', 'a.nama_ks', 'a.nip_ks');
    protected $column_search = array('a.npsn', 'b.nama', 'a.nama_ks', 'a.nip_ks');
    protected $order = array('b.nama' => 'asc', 'a.nama_ks' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {

        $select = "a.*, b.nama as nama_sekolah";
        // $select = "a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan, f.nama as namaDusun, g.nama as nama_sekolah, h.nama as nama_jenjang";

        $this->dt->select($select);
        $this->dt->join('ref_sekolah b', 'a.id = b.id', 'LEFT');
        // $this->dt->join('ref_bentuk_pendidikan h', 'a.bentuk_pendidikan_id = h.id', 'LEFT');
        // $this->dt->join('ref_dusun f', 'a.dusun = f.id', 'LEFT');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->join('ref_sekolah b', 'a.id = b.id', 'LEFT');
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        // if ($filterJenjang != "") {
        //     $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        // }

        // if ($filterKecamatan != "") {
        //     $this->dt->where('a.sekolah_id', $filterKecamatan);
        // }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        // if ($filterJenjang != "") {
        //     $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        // }

        // if ($filterSekolah != "") {
        //     $this->dt->where('a.sekolah_id', $filterSekolah);
        // }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        // if ($filterJenjang != "") {
        //     $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        // }

        // if ($filterSekolah != "") {
        //     $this->dt->where('a.sekolah_id', $filterSekolah);
        // }

        return $this->dt->countAllResults();
    }
}
