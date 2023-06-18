<?php

namespace App\Models\Dinas;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
use Firebase\JWT\JWT;

class PengaduanModel extends Model
{
    protected $table = "tb_pengaduan a";
    protected $column_order = array(null, null, 'a.nama', 'a.token', 'a.no_hp', 'a.status');
    protected $column_search = array('a.nama', 'b.token', 'a.no_hp', 'a.tujuan');
    protected $order = array('a.status' => 'asc', 'a.token' => 'asc');
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

        // $select = "a.*, b.nama as nama_sekolah";
        // $select = "a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan, f.nama as namaDusun, g.nama as nama_sekolah, h.nama as nama_jenjang";

        // $this->dt->select($select);
        // $this->dt->join('ref_sekolah b', 'a.id = b.id', 'LEFT');
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
    function get_datatables($filterKlasifikasi, $filterTujuan)
    {
        $this->_get_datatables_query();
        // $this->dt->join('ref_sekolah b', 'a.id = b.id', 'LEFT');
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        if ($filterTujuan != "") {
            $this->dt->where('a.tujuan', $filterTujuan);
        }

        if ($filterKlasifikasi != "") {
            $this->dt->where('a.klasifikasi', $filterKlasifikasi);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKlasifikasi, $filterTujuan)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        if ($filterTujuan != "") {
            $this->dt->where('a.tujuan', $filterTujuan);
        }

        if ($filterKlasifikasi != "") {
            $this->dt->where('a.klasifikasi', $filterKlasifikasi);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKlasifikasi, $filterTujuan)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.sekolah_id = (select sekolah_id from _users_profil_tb where id = '$userId')");

        if ($filterTujuan != "") {
            $this->dt->where('a.tujuan', $filterTujuan);
        }

        if ($filterKlasifikasi != "") {
            $this->dt->where('a.klasifikasi', $filterKlasifikasi);
        }

        return $this->dt->countAllResults();
    }
}
