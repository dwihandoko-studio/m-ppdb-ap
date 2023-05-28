<?php
 
namespace App\Models;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
 
class UsulandalamantrianModel extends Model
{
    protected $table = "_daftar_usulan_tpg a";
    protected $column_order = array(null, 'c.nama_kecamatan', 'b.jenis_sekolah', 'a.kode_usulan', 'a.npsn', 'b.nama_sekolah', 'a.tahun', 'a.semester', 'a.status_usulan', null);
    protected $column_search = array('a.kode_usulan', 'a.npsn', 'c.nama_kecamatan', 'b.nama_sekolah', 'b.jenis_sekolah');
    protected $order = array('a.created_at_to_process' => 'asc');
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
        
        $select = "a.id, a.kode_usulan, a.user_id, a.npsn, a.semester, a.tahun, a.jumlah_ptk_diusulkan, a.status_usulan, a.lampiran_sptjm, a.lampiran_slip_gaji, a.lampiran_sk_pembagian_tugas, a.created_at, a.updated_at, a.created_at_to_process, b.nama_sekolah, b.tingkat_sekolah, b.jenis_sekolah, b.kecamatan as kecamatanIdSek, c.nama_kecamatan";
        
        $this->dt->select($select);
        $this->dt->join('_sekolah_tb b', 'a.npsn = b.id', 'LEFT');
        $this->dt->join('ref_kecamatan c', 'b.kecamatan = c.id', 'LEFT');
 
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
        $this->dt->where('a.status_usulan', 1);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.id', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.tingkat_sekolah', $filterJenjang);
        }
        
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        $this->dt->where('a.status_usulan', 1);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.id', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.tingkat_sekolah', $filterJenjang);
        }
        
        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenjang)
    {
        $tbl_storage = $this->db->table($this->table);
        $this->dt->where('a.status_usulan', 1);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.id', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.tingkat_sekolah', $filterJenjang);
        }
        
        return $tbl_storage->countAllResults();
    }
}
