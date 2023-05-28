<?php
 
namespace App\Models\Dinas\Masterdata;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
 
class PenggunaModel extends Model
{
    protected $table = "_users_tb a";
    protected $column_order = array(null, null, 'b.fullname', 'a.email', 'c.role', 'b.edited_map');
    protected $column_search = array('b.fullname', 'a.email', 'c.role', 'b.npsn', 'd.nama');
    protected $order = array('b.role_user' => 'asc', 'b.fullname' => 'asc');
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
        
        $select = "b.*, a.email as username, a.is_active, a.email_verified, c.role, d.nama, d.npsn, e.nama as nama_kecamatan";
        
        $this->dt->select($select);
        $this->dt->join('_users_profil_tb b', 'a.id = b.id', 'LEFT');
        $this->dt->join('_role_user c', 'b.role_user = c.id', 'LEFT');
        $this->dt->join('ref_sekolah d', 'b.sekolah_id = d.id', 'LEFT');
        $this->dt->join('ref_kecamatan e', 'b.kecamatan = e.id', 'LEFT');
 
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
    function get_datatables($filterLevel)
    {
        $this->_get_datatables_query();
        // $userId = session()->get('userId');
        // $this->dt->where("a.npsn = (select npsn from _profil_users_tb where id = '$userId') AND a.email IS NOT NULL");
        // $this->dt->where('c.npsn', str_replace("@ppdblamteng","", session()->get('email')));
        $this->dt->where("b.role_user != 1");
        // if(session()->get('email') === "csppdb.smplamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 6);
        // }
        // if(session()->get('email') === "csppdb.sdlamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 5);
        // }
        
        // if($filterKecamatan != "") {
        //     $this->dt->where('d.kecamatan', $filterKecamatan);
        // }
        
        // if($filterJenjang != "") {
        //     $this->dt->where('b.role_user', $filterRole);
        // }
        
        // if($filterSekolah != "") {
        //     $this->dt->where('d.npsn', $filterSekolah);
        // }
        
        if($filterLevel != "") {
            $this->dt->where('b.role_user', $filterLevel);
        }
        
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterLevel)
    {
        $this->_get_datatables_query();
        $this->dt->where("b.role_user != 1");
        // $userId = session()->get('userId');
        // $this->dt->where("a.npsn = (select npsn from _profil_users_tb where id = '$userId') AND a.email IS NOT NULL");
        // $this->dt->where('c.npsn', str_replace("@ppdblamteng","", session()->get('email')));
        // $this->dt->whereIn('b.status_usulan', [1,2]);
        // if(session()->get('email') === "csppdb.smplamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 6);
        // }
        // if(session()->get('email') === "csppdb.sdlamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 5);
        // }
        
        // if($filterKecamatan != "") {
        //     $this->dt->where('d.kecamatan', $filterKecamatan);
        // }
        
        // if($filterJenjang != "") {
        //     $this->dt->where('d.bentuk_pendidikan_id', $filterJenjang);
        // }
        
        // if($filterSekolah != "") {
        //     $this->dt->where('d.npsn', $filterSekolah);
        // }
        
        if($filterLevel != "") {
            $this->dt->where('b.role_user', $filterLevel);
        }
        
        return $this->dt->countAllResults();
    }
    public function count_all($filterLevel)
    {
        // $tbl_storage = $this->db->table($this->table);
        $this->_get_datatables_query();
        $this->dt->where("b.role_user != 1");
        // $userId = session()->get('userId');
        // $this->dt->where("a.npsn = (select npsn from _profil_users_tb where id = '$userId') AND a.email IS NOT NULL");
        // $this->dt->where('c.npsn', str_replace("@ppdblamteng","", session()->get('email')));
        // $this->dt->whereIn('b.status_usulan', [1,2]);
        // if(session()->get('email') === "csppdb.smplamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 6);
        // }
        // if(session()->get('email') === "csppdb.sdlamteng@gmail.com") {
        //     $this->dt->where('b.bentuk_pendidikan_id', 5);
        // }
        
        // if($filterKecamatan != "") {
        //     $this->dt->where('d.kecamatan', $filterKecamatan);
        // }
        
        // if($filterJenjang != "") {
        //     $this->dt->where('d.bentuk_pendidikan_id', $filterJenjang);
        // }
        
        // if($filterSekolah != "") {
        //     $this->dt->where('d.npsn', $filterSekolah);
        // }
        
        if($filterLevel != "") {
            $this->dt->where('b.role_user', $filterLevel);
        }
        
        return $this->dt->countAllResults();
    }
}
