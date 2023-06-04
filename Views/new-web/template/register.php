<div id="register-popup" class="donate-popup">
    <div class="close-donate _close-register"><i class="far fa-window-close"></i></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area" style="background: linear-gradient(130deg, #4527a4 15%, #ff0000 100%);">
                <h2 style="color: #fff;">REGISTRASI - PPDB ONLINE TP. 2022 - 2023</h2>
                <div id="_punya_nisn" class="_punya_nisn" style="display: block;">
                    <h6 style="margin-bottom: 20px; color: #fff;background: rgb(255 255 255 / 19%);padding: 15px 20px; border-radius: 20px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);"><span>Untuk Peserta Yang Belum Tercatat di Referensi Data Kemdikbud. (Berlaku hanya untuk peserta PPDB yang akan mendaftar jenjang SD). <a href="javascript:actionRegisterBeforeSchool(this);" style="color: #00fff2; padding: 0px 10px;">Klik Disini...</a></span></h6>
                    <!-- <form action="#" class="donate-form default-form"> -->
                    <div id="content_block_51">
                        <div class="content-box">
                            <div class="donation-box wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                <!-- <div class="select-box"> -->
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <p style="color: #fff;">Jenjang PPDB</p>
                                            <div class="select-box">
                                                <select class="selectmenu1" name="_jenjang" id="_jenjang" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; width: 100%; font-weight: 400; height: 50px; outline: medium none; padding: 0px 10px;">
                                                    <option selected="selected">SD</option>
                                                    <option>SMP</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <p style="color: #fff;">NISN</p>
                                            <input type="text" onfocus="inputFocus(this)" name="_nisn" id="_nisn" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            <div class="help-block _nisn"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <p style="color: #fff;">NPSN</p>
                                            <input type="text" onfocus="inputFocus(this)" name="_npsn" id="_npsn" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            <div class="help-block _npsn"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <p style="color: #fff;">Tanggal Lahir</p>
                                            <input class="datepicker" type="date" onfocus="inputFocus(this)" name="_tgl_lahir" id="_tgl_lahir" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            <div class="help-block _tgl_lahir"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <div class="btn-box btncekdata" style="display: block;">
                                    <button onclick="submitRegisterAfterSchoolButton(this)" class="donate-box-btn" id="btncekdata">DAFTAR</button>
                                </div>
                                <div class="content-siswa" style="display: none;">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
                <div id="_belum_punya_nisn" class="_belum_punya_nisn" style="display: none;">
                    <h6 style="margin-bottom: 20px; color: #fff;background: rgb(255 255 255 / 19%);padding: 15px 20px; border-radius: 20px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);"><span>Untuk Peserta Yang Sudah Tercatat di Referensi Data Kemdikbud. (Berlaku untuk peserta PPDB yang akan mendaftar jenjang SD dan SMP). <a href="javascript:actionRegisterAfterSchool(this);" style="color: #00fff2; padding: 0px 10px;">Klik Disini...</a></span></h6>
                    <form action="#" class="donate-form default-form">
                        <div id="content_block_51">
                            <div class="content-box">
                                <div class="donation-box wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                    <!-- <div class="select-box"> -->
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p style="color: #fff;">Nama Lengkap</p>
                                                <input type="text" name="_nama" id="_nama" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p style="color: #fff;">NIK</p>
                                                <input type="text" name="_nik" id="_nik" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p style="color: #fff;">Password</p>
                                                <input type="password" name="_password_regis" id="_password_regis" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p style="color: #fff;">Ulangi Password</p>
                                                <input type="password" name="_re_password_regis" id="_re_password_regis" placeholder="" style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <div class="btn-box">
                                        <button onclick="submitRegisterBeforeSchoolButton(this)" class="donate-box-btn _submit_login_button" id="_submit_login_button">DAFTAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>