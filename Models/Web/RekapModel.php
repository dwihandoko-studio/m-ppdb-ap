<?php

namespace App\Models\Web;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RekapModel extends Model
{
    protected $table = "_setting_kuota_tb a";
    protected $column_order = array(null, 'a.npsn', 'b.nama', null, null,null,null);
    protected $column_search = array('a.npsn', 'b.nama');
    protected $order = array('a.bentuk_pendidikan_id' => 'desc');
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

        $select = "a.npsn, a.sekolah_id, a.bentuk_pendidikan_id, (a.zonasi + a.afirmasi + a.mutasi + a.prestasi) as kuota, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.sekolah_id) as pendaftar_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.sekolah_id) as pendaftar_belum_terverifikasi, b.nama";

        $this->dt->select($select);
        $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');

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
    function get_datatables($filterJenajng)
    {
        $this->_get_datatables_query();

        // if ($filterKecamatan != "") {
        //     $this->dt->where('b.kode_wilayah', $filterKecamatan);
        // }

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenajng)
    {
        $this->_get_datatables_query();

        // if ($filterKecamatan != "") {
        //     $this->dt->where('b.kode_wilayah', $filterKecamatan);
        // }

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenajng)
    {
        $this->_get_datatables_query();

        // if ($filterKecamatan != "") {
        //     $this->dt->where('b.kode_wilayah', $filterKecamatan);
        // }

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        return $this->dt->countAllResults();
    }
}
