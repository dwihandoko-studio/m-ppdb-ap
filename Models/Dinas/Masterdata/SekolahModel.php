<?php

namespace App\Models\Dinas\Masterdata;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = "ref_sekolah a";
    protected $column_order = array(null, null, 'a.npsn', 'a.nama', 'a.status_sekolah', 'a.latitude', 'a.longitude');
    protected $column_search = array('a.npsn','a.nama');
    protected $order = array('a.bentuk_pendidikan_id' => 'asc','a.nama' => 'asc');
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

        $select = "a.id, a.npsn, a.nama, a.bentuk_pendidikan_id, a.latitude, a.longitude, a.status_sekolah";

        $this->dt->select($select);

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
        $this->dt->whereIn('a.bentuk_pendidikan_id', [5,6]);
        $this->dt->where('LEFT(a.kode_wilayah,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));
        
        if($filterKecamatan != "") {
            $this->dt->where('a.kode_wilayah', $filterKecamatan);
        }

        if($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        $this->dt->whereIn('a.bentuk_pendidikan_id', [5,6]);
        $this->dt->where('LEFT(a.kode_wilayah,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));
        
        if($filterKecamatan != "") {
            $this->dt->where('a.kode_wilayah', $filterKecamatan);
        }

        if($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        $this->dt->whereIn('a.bentuk_pendidikan_id', [5,6]);
        $this->dt->where('LEFT(a.kode_wilayah,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));

        if($filterKecamatan != "") {
            $this->dt->where('a.kode_wilayah', $filterKecamatan);
        }

        if($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
}
