<?php ob_start();
// var_dump(FCPATH . "temp/");die;
include APPPATH . "Libraries/phpqrcode/qrlib.php";
// session_start();
$tempdir = FCPATH . "temp/"; //Nama folder tempat menyimpan file qrcode
// if (!file_exists($tempdir)) //Buat folder bername temp
// 	mkdir($tempdir);

//isi qrcode jika di scan
// $siswa = json_decode($data->details);
$codeContents = base_url('web/home/pengumumanpeserta') . '?sekolah=' . $sekolah->id;

//simpan file kedalam temp
//nilai konfigurasi Frame di bawah 4 tidak direkomendasikan

QRcode::png($codeContents, $tempdir . $sekolah->id . '.png', QR_ECLEVEL_M, 4);

?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<link rel="stylesheet" href="<?= base_url('new-assets'); ?>/assets/vendor/bootstrap/dist/bootstrap.min.css">
<link rel="shortcut icon" href="https://www.mr-ell.com/media_library/images/7c751732ad0e716986752287a3861548.png">

<!DOCTYPE html>

<html>

<head>
    <title>SPTJM PESERTA PPDB - <?= $sekolah->nama ?></title>
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
        <div style="max-width: 100%; padding-left: 10px; padding-right: 8px;">
            <p>LAMPIRAN 1<br>
                DATA PESERTA YANG LULUS PPDB TA. 2022/2023<br>
                KABUPATEN PESAWARAN<br><br>
                Satuan Pendidikan : <?= $sekolah->nama ?><br>
                NPSN : <?= $sekolah->npsn ?></p>
        </div>

        <div style="max-width: 100%; padding-top: 5px; padding-left: 10px; padding-right: 8px;">
            <h4>JALUR SWASTA</h4>
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <thead>
                    <tr>
                        <th style="font-size: 12px">No</th>
                        <th style="font-size: 12px">Nama Peserta</th>
                        <th style="font-size: 12px">NISN</th>
                        <th style="font-size: 12px">No Pendaftaran</th>
                        <th style="font-size: 12px">Jalur PPDB</th>
                        <th style="font-size: 12px">NPSN Asal Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($data_lolos)) {
                        if (count($data_lolos) > 0) {
                            $no = 1;
                            foreach ($data_lolos as $key => $value) { ?>
                                <tr>
                                    <td style="font-size: 12px">
                                        <?= $rangking ?>
                                    </td>
                                    <td style="font-size: 12px">
                                        <?= $value->fullname ?>
                                    </td>
                                    <td style="font-size: 12px">
                                        <?php if (substr($value->nisn, 0, 2) == 'BS') {
                                            $nisn = $value->nip;
                                        } else {
                                            $nisn = $value->nisn;
                                        } ?>
                                        <?= $nisn ?>
                                    </td>
                                    <td style="font-size: 10px">
                                        <?= $value->kode_pendaftaran ?>
                                    </td>
                                    <td style="font-size: 12px">
                                        <?= $value->via_jalur ?>
                                    </td>
                                    <td style="font-size: 12px">
                                        <?= $value->npsn_sekolah_asal ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            } ?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="6" style="text-align: center; align-items: center;">Tidak ada peserta.</td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" style="text-align: center; align-items: center;">Tidak ada peserta.</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

        <!-- kolom informasi -->
        <!-- <div style="max-width: 100%; padding-top: 5px; padding-bottom: 12px;  padding-left: 10px; padding-right: 8px;">
            <table width="100%" style="border: solid #cbd4dd; font-size: 12px">
                <tr>
                    <td style="text-align: left; padding-left: 10px; padding-bottom: 10px; padding-top: 10px;">
                        <img class="img" src="<?= base_url() ?>/temp/<?= $sekolah->id ?>.png" ec="H" style="width: 30mm; background-color: white; color: black;"> -->
        <!--<b>INFORMASI</b><br>-->
        <!--1. Pada saat pengumuman PPDB 2022/2023. Bagi peserta PPDB YANG TIDAK LOLOS di sekolah tujuan, langsung dapat mendaftar<br>-->
        <!--   melalui PPDB Dalam Jaringan ke Sekolah Terdekat yang Jumlah Kuotanya belum terpenuhi sampai tanggal 30 Juni 2022.<br>-->
        <!--2. Peserta yang tidak lolos dan kemudian mendaftar kembali melalui PPDB Dalam Jaringan, akan otomatis dapat melihat Sekolah-Sekolah<br>-->
        <!--   yang Kuotanya Belum Tercukupi.<br>-->
        <!--3. Panitia PPDB Sekolah tidak lagi wajib untuk melakukan verifikasi (Sistem Otomatis) dan Peserta yang mendaftar ke sekolah tersebut, otomatis diterima di sekolah tersebut.<br>-->
        <!--4. Panitia PPDB Sekolah, yang Jumlah Kuota Kesiapan di sekolahannya belum tercukupi, dapat membantu Peserta Orang Tua/Wali yang tidak Lolos pada pengumuman PPDB untuk mendaftarkan di sekolahannya.<br>-->
        <!--5. Peserta yang tidak lolos pada pengumuman PPDB, apabila tidak melakukan pendaftaran, maka akan dipetakan oleh Panitia PPDB Dinas ke sekolah-sekolah terdekat yang kuotanya belum terpenuhi.-->
        <!-- </td>
                </tr>
            </table>
        </div> -->
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
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("SPTJM_" . $sekolah->npsn . " " . $sekolah->nama . ".pdf", array("Attachment" => false));
exit(0);
?>