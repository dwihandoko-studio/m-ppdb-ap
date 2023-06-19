<?php

namespace App\Models\Web;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ProfilsekolahModel extends Model
{
    protected $table = "_ref_profil_sekolah a";
    protected $column_order = array(null, 'a.npsn', 'b.nama', null);
    protected $column_search = array('b.nama', 'a.npsn');
    protected $order = array('b.nama' => 'asc');
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

        $select = "a.*, b.nama as nama_sekolah, b.kode_wilayah, c.role_user";

        $this->dt->select($select);
        $this->dt->join('ref_sekolah b', 'a.id = b.id');
        $this->dt->join('_users_profil_tb c', 'a.id = c.sekolah_id');
        // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT');

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
    function get_datatables($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        // $this->dt->where('a.role_user', '4');

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where("LEFT(b.kode_wilayah,6) = '$filterKecamatan'");
        }

        $this->dt->groupBy('a.npsn');

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        // $this->dt->where('a.role_user', '4');

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where("LEFT(b.kode_wilayah,6) = '$filterKecamatan'");
        }

        $this->dt->groupBy('a.npsn');

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        // $this->dt->where('a.role_user', '4');

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where("LEFT(b.kode_wilayah,6) = '$filterKecamatan'");
        }

        $this->dt->groupBy('a.npsn');

        return $this->dt->countAllResults();
    }
}
