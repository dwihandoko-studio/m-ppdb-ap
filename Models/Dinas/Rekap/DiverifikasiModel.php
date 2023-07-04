<?php

namespace App\Models\Dinas\Rekap;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DiverifikasiModel extends Model
{
    protected $table = "_tb_pendaftar a";
    protected $column_order = array(null, null, 'b.fullname', 'b.nisn', 'a.kode_pendaftaran', 'a.via_jalur', null, null);
    protected $column_search = array('b.nisn', 'a.kode_pendaftaran');
    // protected $order = array('a.created_at' => 'asc');
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

        $select = "b.id, b.nisn, b.fullname, a.id as id_pendaftaran, a.status_pendaftaran, a.kode_pendaftaran, a.via_jalur";

        $this->dt->select($select);
        $this->dt->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id');
        // $this->dt->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT');
        // $this->dt->join('ref_sekolah d', 'a.tujuan_sekolah_id_1 = d.id', 'LEFT');
        // $this->dt->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT');
        // $this->dt->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT');
        // $this->dt->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT');
        // $this->dt->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT');
        // $this->dt->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT');
        // $this->dt->join('ref_dusun h', 'b.dusun = h.id', 'LEFT');
        // $this->dt->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT');

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
    function get_datatables($filterJenjang, $filterJalur, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");
        // $this->dt->whereIn('a.status_pendaftaran', [1, 2, 3]);
        $this->dt->where('a.status_pendaftaran', 2);

        if ($filterJalur != "") {
            $this->dt->where('a.via_jalur', $filterJalur);
        }

        // if ($filterSekolah != "") {
        //     $this->dt->where('d.id', $filterSekolah);
        // }

        // if ($filterJenjang != "") {
        //     $this->dt->where('d.bentuk_pendidikan_id', $filterJenjang);
        // }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenjang, $filterJalur, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");
        // $this->dt->whereIn('a.status_pendaftaran', [1, 2, 3]);
        $this->dt->where('a.status_pendaftaran', 2);

        if ($filterJalur != "") {
            $this->dt->where('a.via_jalur', $filterJalur);
        }

        // if ($filterSekolah != "") {
        //     $this->dt->where('d.id', $filterSekolah);
        // }

        // if ($filterJenjang != "") {
        //     $this->dt->where('d.bentuk_pendidikan_id', $filterJenjang);
        // }

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenjang, $filterJalur, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->whereIn('a.status_pendaftaran', [1, 2, 3]);
        $this->dt->where('a.status_pendaftaran', 2);
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");

        if ($filterJalur != "") {
            $this->dt->where('a.via_jalur', $filterJalur);
        }

        // if ($filterSekolah != "") {
        //     $this->dt->where('d.id', $filterSekolah);
        // }

        // if ($filterJenjang != "") {
        //     $this->dt->where('d.bentuk_pendidikan_id', $filterJenjang);
        // }

        return $this->dt->countAllResults();
    }
}
