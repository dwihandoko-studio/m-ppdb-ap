<?php ob_start();
// // var_dump(FCPATH . "temp/");die;
// include APPPATH . "Libraries/phpqrcode/qrlib.php";
// // session_start();
// $tempdir = FCPATH . "temp/"; //Nama folder tempat menyimpan file qrcode
// // if (!file_exists($tempdir)) //Buat folder bername temp
// // 	mkdir($tempdir);

// //isi qrcode jika di scan
$siswa = json_decode($data->details);
// $codeContents = $siswa->nisn . '-' . $siswa->nama;

// //simpan file kedalam temp
// //nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

// QRcode::png($codeContents, $tempdir . $siswa->nisn . '.png', QR_ECLEVEL_M, 4);

?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/bootstrap/dist/bootstrap.min.css">
<link rel="shortcut icon" href="https://www.mr-ell.com/media_library/images/7c751732ad0e716986752287a3861548.png">

<!DOCTYPE html>

<html>

<head>
    <title>Formulir_PPDB<?= $siswa->nama ?></title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div style="border: 2px  dashed #cbd4dd;">
        <div style="max-width: 100%; padding-top: 12px; padding-bottom: 5px; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tr>
                    <td colspan="5" width="10%" style="border:none;">
                        <img class="img" src="<?= base_url('faviconslmt/android-icon-144x144.png') ?>" ec="H" style="width: 30mm; background-color: white; color: black;">
                    </td>
                    <td style="text-align: center;">
                        <span style="margin-top: 8px; font-size: 20px;">KARTU TANDA PESERTA PPDB ONLINE</span><br>
                        <span style="margin-top: 8px; font-size: 18px;">KABUPATEN LAMPUNG TENGAH</span><br>
                        <span style="margin-top: 8px; font-size: 18px;">PROVINSI LAMPUNG</span><br>
                        <span style="margin-top: 8px; font-size: 16;">TAHUN PELAJARAN 2023/2024</span>
                    </td>
                    <td width="10%" style="border:none;">
                        <img class="img" src="<?= base_url('tutwuri.png') ?>" ec="H" style="width: 30mm; background-color: white; color: black;">
                    </td>
                </tr>
                <!-- <tr style="margin-top: 0px; margin-bottom: 0px;padding-top: 0px; padding-bottom: 0px;">
                    <td style="text-align: center;margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
                        KABUPATEN LAMPUNG TENGAH
                    </td>
                </tr>
                <tr style="margin-top: 0px; margin-bottom: 0px;padding-top: 0px; padding-bottom: 0px;">
                    <td style="text-align: center;margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
                        PROVINSI LAMPUNG
                    </td>
                </tr>
                <tr style="margin-top: 0px; margin-bottom: 0px;padding-top: 0px; padding-bottom: 0px;">
                    <td style="text-align: center;margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">
                        TAHUN AJARAN 2023/2024
                    </td>
                </tr> -->
            </table>
        </div>

        <!-- kolom atas -->
        <div style="max-width: 100%; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tbody>
                    <tr>
                        <td width="35%" align="" style="padding-left: 10px;">Nomor Pendaftaran</td>
                        <td width="5%" align="center">:</td>
                        <td width="60%" align="left"><?= $data->kode_pendaftaran ?></td>
                        <td rowspan="7" style="border: none" width="10%">
                            <!-- <img class="img" src="<?= base_url() ?>/temp/siswa.jpg" ec="H" style="width: 30mm;hight: 40mm; background-color: white; color: black;"> -->
                        </td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Nama Lengkap</td>
                        <td align="center">:</td>
                        <td align="left"><?= $siswa->nama ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Tempat Lahir</td>
                        <td align="center">:</td>
                        <td align="left"><?= $siswa->tempat_lahir ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Tanggal Lahir</td>
                        <td align="center">:</td>
                        <td align="left"><?= tgl_indo2($siswa->tanggal_lahir) ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">Jenis Kelamin</td>
                        <td align="center">:</td>
                        <td align="left"><?= ($siswa->jenis_kelamin == 'L') ? "Laki-Laki" : "Perempuan"; ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">NISN</td>
                        <td align="center">:</td>
                        <td align="left"><?= $siswa->nisn ?></td>
                    </tr>
                    <tr>
                        <td align="" style="padding-left: 10px;">NIK</td>
                        <td align="center">:</td>
                        <td align="left"><?= $siswa->nik ?></td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- kolom bawah -->
        <div style="max-width: 100%; padding-top: 5px; padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tbody>
                    <tr>
                        <td colspan="5" align="left">&nbsp;&nbsp;&nbsp;<b>Pilihan Sekolah</b></td>
                        <td rowspan="6" style="border: none" width="10%">
                            <img class="img" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?= $data->peserta_didik_id ?>&choe=UTF-8" ec="H" style="width: 30mm; background-color: white; color: black;">
                            <!-- <img class="img" src="<? //= base_url() 
                                                        ?>/temp/<? //= $siswa->nisn 
                                                                ?>.png" ec="H" style="width: 30mm; background-color: white; color: black;"> -->
                        </td>
                    </tr>
                    <tr>
                        <td width="5%"></td>
                        <td width="30%" align="">Jenis Pendaftaran</td>
                        <td width="5%" align="center">:</td>
                        <td width="60%" align="left">
                            <?php //if ($data->via_jalur == "ZONASI") { 
                            ?>
                            <span class="badge badge-info">JALUR <?= $data->via_jalur ?></span>
                            <?php //} else if ($data->via_jalur == "PRESTASI") { 
                            ?>
                            <!-- <span class="badge badge-info">JALUR PRESTASI</span> -->
                            <?php //} 
                            ?>
                        </td>
                    </tr>
                    <?php if ($data->via_jalur == "ZONASIS") { ?>
                        <tr>
                            <td></td>
                            <td align="">Sekolah Tujuan Pilihan Pertama</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->nama_sekolah_tujuan_1 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">NPSN Sekolah Tujuan Pilihan Pertama</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->npsn_sekolah_tujuan_1 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Jarak Sekolah Tujuan Pilihan Pertama</td>
                            <td align="center">:</td>
                            <td align="left"><?= getJarak2Koordinat($data->latitude, $data->longitude, $data->latitude_sekolah_tujuan_1, $data->longitude_sekolah_tujuan_1, 'kilometers') . ' Km' ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Sekolah Tujuan Pilihan Kedua</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->nama_sekolah_tujuan_2 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">NPSN Sekolah Tujuan Pilihan Kedua</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->npsn_sekolah_tujuan_2 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Jarak Sekolah Tujuan Pilihan Kedua</td>
                            <td align="center">:</td>
                            <td align="left"><?= getJarak2Koordinat($data->latitude, $data->longitude, $data->latitude_sekolah_tujuan_2, $data->longitude_sekolah_tujuan_2, 'kilometers') . ' Km' ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Sekolah Tujuan Pilihan Ketiga</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->nama_sekolah_tujuan_3 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">NPSN Sekolah Tujuan Pilihan Ketiga</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->npsn_sekolah_tujuan_3 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Jarak Sekolah Tujuan Pilihan Ketiga</td>
                            <td align="center">:</td>
                            <td align="left"><?= getJarak2Koordinat($data->latitude, $data->longitude, $data->latitude_sekolah_tujuan_3, $data->longitude_sekolah_tujuan_3, 'kilometers') . ' Km' ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td></td>
                            <td align="">Sekolah Tujuan</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->nama_sekolah_tujuan_1 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">NPSN Sekolah Tujuan</td>
                            <td align="center">:</td>
                            <td align="left"><?= $data->npsn_sekolah_tujuan_1 ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="">Jarak Sekolah Tujuan</td>
                            <td align="center">:</td>
                            <td align="left"><?= getJarak2Koordinat($data->latitude, $data->longitude, $data->latitude_sekolah_tujuan_1, $data->longitude_sekolah_tujuan_1, 'kilometers') . ' Km' ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td align="">Nama Sekolah Asal</td>
                        <td align="center">:</td>
                        <td align="left"><?= $data->nama_sekolah_asal ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="">NPSN Sekolah Asal</td>
                        <td align="center">:</td>
                        <td align="left"><?= ($data->npsn_sekolah_asal == '10000001') ? '-' : $data->npsn_sekolah_asal ?></td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- kolom informasi -->
        <div style="max-width: 100%; padding-top: 5px; padding-bottom: 12px;  padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tr>
                    <td style="text-align: left; padding-left: 10px; padding-bottom: 10px; padding-top: 10px;">
                        <b>INFORMASI PENTING</b><br>
                        1. Kartu Peserta ini wajib dibawa dan ditunjukkan saat pelaksanaan daftar ulang<br>
                        2. Membawa kartu/bukti file yang telah diupload
                    </td>
                </tr>
            </table>
        </div>
</body>

</html>
<?php
$html = ob_get_clean();
require_once APPPATH . "Libraries/vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('PENDAFTARAN', 'portrait');
$dompdf->render();
$dompdf->stream("PPDB2021_.pdf", array("Attachment" => false));
exit(0);
?>