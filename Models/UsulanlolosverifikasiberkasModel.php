<?php
 
namespace App\Models;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
 
class UsulanlolosverifikasiberkasModel extends Model
{
    protected $table = "_daftar_ptk_usulan_tpg a";
    protected $column_order = array(null, null,'c.nrg', 'c.no_peserta', 'c.nuptk', 'c.nama', 'c.tempat_tugas', 'c.nip', null, null, null, 'c.kecamatan', 'd.fullname', 'c.keterangan_reject', null);
    protected $column_search = array('c.nrg', 'c.nip', 'c.no_peserta', 'c.nuptk', 'c.nama', 'c.tempat_tugas', 'c.kecamatan');
    protected $order = array('c.kecamatan' => 'asc', 'c.tempat_tugas' => 'asc', 'c.nama' => 'asc');
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
        
        $select = "a.id, a.kode_usulan, a.id_ptk, a.semester, a.tahun, a.status_usulan, a.admin_approve, a.date_approve, b.status_usulan as usulanGlobal, b.npsn, c.nrg, c.no_peserta, c.nuptk, c.nama, c.nip,  c.tempat_tugas, c.status_kepegawaian, c.pangkat_golongan, c.pangkat_golongan_ruang, c.tmt_pangkat, c.masa_kerja_tahun, c.masa_kerja_bulan, c.gaji_pokok, c.tmt_sk_kgb, c.masa_kerja_tahun_kgb, c.masa_kerja_bulan_kgb, c.gaji_pokok_kgb, c.tmt_sk_impassing, c.masa_kerja_tahun_impassing, c.masa_kerja_bulan_impassing, c.jumlah_tunjangan_pokok_impassing, c.kecamatan, d.fullname";
        
        $this->dt->select($select);
        $this->dt->join('_daftar_usulan_tpg b', 'a.kode_usulan = b.kode_usulan', 'LEFT');
        $this->dt->join('_ptk_tb c', 'a.id_ptk = c.id', 'LEFT');
        $this->dt->join('_profil_users_tb d', 'a.admin_approve = d.id', 'LEFT');
 
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
        $this->dt->where('a.status_usulan', 2);
        $this->dt->whereIn('b.status_usulan', [1,2]);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.kecamatan', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.npsn', $filterJenjang);
        }
        
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        $this->dt->where('a.status_usulan', 2);
        $this->dt->whereIn('b.status_usulan', [1,2]);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.kecamatan', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.npsn', $filterJenjang);
        }
        
        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenjang)
    {
        $tbl_storage = $this->db->table($this->table);
        $this->dt->where('a.status_usulan', 2);
        $this->dt->whereIn('b.status_usulan', [1,2]);
        
        if($filterKecamatan != "") {
            $this->dt->where('c.kecamatan', $filterKecamatan);
        }
        
        if($filterJenjang != "") {
            $this->dt->where('b.npsn', $filterJenjang);
        }
        
        return $tbl_storage->countAllResults();
    }
}
