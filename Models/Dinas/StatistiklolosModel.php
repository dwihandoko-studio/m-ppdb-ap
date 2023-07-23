<?php

namespace App\Models\Dinas;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class StatistiklolosModel extends Model
{
    protected $table = "_tb_pendaftar a";
    protected $column_order = array(null, 'b.nama', null, null, null, null, null);
    protected $column_search = array('b.nama', 'b.npsn');
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

        $select = "b.bentuk_pendidikan_id, b.nama as nama_sekolah, b.npsn as npsn_sekolah, b.status_sekolah, b.kode_wilayah as kode_kecamatan, c.nama as nama_kecamatan, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.tujuan_sekolah_id_1 AND via_jalur = 'AFIRMASI' AND status_pendaftaran = 2) as diterima_afirmasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.tujuan_sekolah_id_1 AND via_jalur = 'ZONASI' AND status_pendaftaran = 2) as diterima_zonasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.tujuan_sekolah_id_1 AND via_jalur = 'MUTASI' AND status_pendaftaran = 2) as diterima_mutasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.tujuan_sekolah_id_1 AND via_jalur = 'PRESTASI' AND status_pendaftaran = 2) as diterima_prestasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.tujuan_sekolah_id_1 AND via_jalur = 'SWASTA' AND status_pendaftaran = 2) as diterima_swasta";
        $this->dt->select($select);
        $this->dt->join('_users_profil_tb e', 'a.tujuan_sekolah_id_1 = e.sekolah_id');
        $this->dt->join('ref_sekolah b', 'a.tujuan_sekolah_id_1 = b.id', 'LEFT');
        // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT');
        $this->dt->join('ref_kecamatan c', 'LEFT(b.kode_wilayah,6) = c.id', 'LEFT');
        // $this->dt->where('b.status_sekolah', 1);
        $this->dt->groupBy('a.tujuan_sekolah_id_1');

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
        // $select = "b.bentuk_pendidikan_id, b.nama as nama_sekolah, b.npsn as npsn_sekolah, b.status_sekolah, b.kode_wilayah as kode_kecamatan, c.nama as nama_kecamatan, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.sekolah_id AND via_jalur = 'AFIRMASI') as jumlah_pendaftar_afirmasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.sekolah_id AND via_jalur = 'ZONASI') as jumlah_pendaftar_zonasi_1, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_2 = a.sekolah_id AND via_jalur = 'ZONASI') as jumlah_pendaftar_zonasi_2, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_3 = a.sekolah_id AND via_jalur = 'ZONASI') as jumlah_pendaftar_zonasi_3, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.sekolah_id AND via_jalur = 'MUTASI') as jumlah_pendaftar_mutasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.sekolah_id AND via_jalur = 'PRESTASI') as jumlah_pendaftar_prestasi";
        // $this->dt->select($select);
        // $this->dt->join('_users_profil_tb e', 'a.tujuan_sekolah_id_1 = e.sekolah_id');
        // $this->dt->join('ref_sekolah b', 'a.tujuan_sekolah_id_1 = b.id', 'LEFT');
        // // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT');
        // // $this->dt->join('ref_kecamatan c', 'LEFT(b.kode_wilayah,6) = c.id', 'LEFT');

        $this->_get_datatables_query();

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        // if ($filterKecamatan != "") {
        //     $this->dt->where('LEFT(b.kode_wilayah,6)', $filterKecamatan);
        // }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenajng)
    {
        // $select = "a.*, b.nama as nama_sekolah, c.nama as nama_kecamatan";
        // $this->dt->select($select);
        // // $this->dt->join('_users_profil_tb e', 'a.sekolah_id = e.sekolah_id');
        // $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');
        // // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'LEFT(b.kode_wilayah,6) = c.id', 'LEFT');
        $this->_get_datatables_query();

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        // if ($filterKecamatan != "") {
        //     $this->dt->where('LEFT(b.kode_wilayah,6)', $filterKecamatan);
        // }

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenajng)
    {
        // $select = "a.*, b.nama as nama_sekolah, c.nama as nama_kecamatan";
        // $this->dt->select($select);
        // // $this->dt->join('_users_profil_tb e', 'a.sekolah_id = e.sekolah_id');
        // $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');
        // // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'LEFT(b.kode_wilayah,6) = c.id', 'LEFT');

        $this->_get_datatables_query();

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }
        // if ($filterKecamatan != "") {
        //     $this->dt->where('LEFT(b.kode_wilayah,6)', $filterKecamatan);
        // }

        return $this->dt->countAllResults();
    }
}
