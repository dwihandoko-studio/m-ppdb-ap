<?php if(isset($data)) { ?>
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="150">
                <h5 class="text-center" style="margin-bottom: 0;">Persiapan PPDB 2022/2023</h5>
                <hr class="m-3">
                <div class="user-activity user-activity-sm">
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Persiapan</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    22-Juni-2022 <i class="fa fa-arrow-right"></i> 26-Juni-2022
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Dibuka</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    <?= tgl_indo($data->tgl_awal_pendaftaran_zonasi) ?> <br>
                                    <i class="fa fa-clock"></i> Pukul <?= waktu_indo($data->tgl_awal_pendaftaran_zonasi) ?> WIB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Ditutup</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    <?= tgl_indo($data->tgl_akhir_pendaftaran_zonasi) ?> <br><i class="fa fa-clock"></i> Pukul <?= waktu_indo($data->tgl_akhir_pendaftaran_zonasi) ?> WIB
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="200">
                <h5 class="text-center" style="margin-bottom: 0;">Pelaksanaan PPDB 2022/2023</h5>
                <hr class="m-3">
                <div class="user-activity user-activity-sm">
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Pelaksanaan</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    28-Juni-2022 <i class="fa fa-arrow-right"></i> 03-Juli-2022
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Dibuka</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    28-Juni-2022 <br><i class="fa fa-clock"></i> Pukul 07.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Ditutup</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    03-Juli-2022 <br><i class="fa fa-clock"></i> Pukul 15.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="250">
                <h5 class="text-center" style="margin-bottom: 0;">Verifikasi Berkas Pendaftaran</h5>
                <hr class="m-3">
                <div class="user-activity user-activity-sm">
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Verifikasi</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    28-Juni-2022 <i class="fa fa-arrow-right"></i> 03-Juli-2022
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Dibuka</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    28-Juni-2022 <br><i class="fa fa-clock"></i> Pukul 07.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Ditutup</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    03-Juli-2022 <br><i class="fa fa-clock"></i> Pukul 17.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="300">
                <h5 class="text-center" style="margin-bottom: 0;">Analisis Dan Penyususan Peringkat</h5>
                <hr class="m-3">
                <div class="user-activity user-activity-sm">
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Analisis</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    05-Juli-2022 <i class="fa fa-arrow-right"></i> 06-Juli-2022
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Dibuka</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    05-Juli-2022 <br><i class="fa fa-clock"></i> Pukul 07.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Ditutup</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    06-Juli-2022 <br><i class="fa fa-clock"></i> Pukul 17.00 WIB
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4 p-2">
            <div class="card p-2 pt-3" data-aos="fade-up" data-aos-delay="350">
                <h5 class="text-center" style="margin-bottom: 0;">Jalur Zonasi</h5>
                <hr class="m-3">
                <div class="user-activity user-activity-sm">
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Pendaftaran</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Pendaftaran</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <h6 class="d-block">Tanggal Pendaftaran</h6>
                                <span class="d-block mb-5"><i class="fa fa-calendar"></i>
                                    24-Mei-2021 <i class="fa fa-arrow-right"></i> 29-Mei-2021
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
<?php } ?>