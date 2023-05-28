<?php

namespace App\Models\Dinas\Masterdata;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table = "ref_kelurahan a";
    protected $column_order = array(null, null, 'a.id', 'a.nama', 'a.id_wilayah');
    protected $column_search = array('a.id_kecamatan', 'a.nama');
    protected $order = array('a.id' => 'asc');
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

        $select = "a.*";

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

    function get_datatables($filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('LEFT(a.id_kecamatan,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));
        
        if($filterKecamatan != "") {
            $this->dt->where('a.id_kecamatan', $filterKecamatan);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('LEFT(a.id_kecamatan,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));
        
        if($filterKecamatan != "") {
            $this->dt->where('a.id_kecamatan', $filterKecamatan);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('LEFT(a.id_kecamatan,4)', substr(getenv('ppdb.default.wilayahppdb'),0,4));

        if($filterKecamatan != "") {
            $this->dt->where('a.id_kecamatan', $filterKecamatan);
        }

        return $this->dt->countAllResults();
    }

    public function insertNewData($data)
    {
        $sql = "insert into ref_kelurahan " .
            "(id, id_kecamatan, nama, id_wilayah, created_at) values (?, ?, ?, ?, ?)";

        $query = $this->db->query($sql, array(
            $data->id, $data->id_kecamatan, $data->nama, $data->id_wilayah, date('Y-m-d H:i:s'),
            $data->id_kecamatan, $data->nama, $data->id_wilayah, date('Y-m-d H:i:s')
        ));
        return $this->db->affectedRows();
        // return $query->resultID;
    }
    
    public function insertUpdate($data)
    {
        $sql = "insert into ref_kelurahan " .
            "(id, id_kecamatan, nama, id_wilayah, created_at) values (?, ?, ?, ?, ?)" .
            " on duplicate key update id_kecamatan = ?, nama = ?, id_wilayah = ?, updated_at = ?";

        $query = $this->db->query($sql, array(
            $data->id, $data->id_kecamatan, $data->nama, $data->id_wilayah, date('Y-m-d H:i:s'),
            $data->id_kecamatan, $data->nama, $data->id_wilayah, date('Y-m-d H:i:s')
        ));
        return $this->db->affectedRows();
        // return $query->resultID;
    }
}
