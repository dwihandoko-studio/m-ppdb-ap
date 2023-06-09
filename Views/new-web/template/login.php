<div id="login-popup" class="donate-popup">
    <div class="close-donate _close-login"><i class="far fa-window-close"></i></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area" style="background: linear-gradient(130deg, #4527a4 15%, #ff0000 100%);">
                <h2 style="color: #fff;">PPDB ONLINE TP. 2023 - 2024</h2>
                <h6 style="margin-bottom: 20px; color: #fff;background: rgb(255 255 255 / 19%);padding: 15px 20px; border-radius: 20px; box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);"><span>Untuk Login Panitia Sekolah, silahkan login menggunakan email dan password yang sudah didaftarkan pada layanan.</span></h6>
                <div id="content_block_51">
                    <div class="content-box">
                        <div class="donation-box wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 300ms; animation-name: fadeInUp;">
                            <div class="select-box">
                                <div class="form-group">
                                    <p style="color: #fff;">NISN / NIK</p>
                                    <input style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="text" name="_username" id="_username" placeholder="">
                                </div>
                                <div class="form-group">
                                    <p style="color: #fff;">Password</p>
                                    <input style="background: transparent; border: 1px solid #fff !important; border-radius: 10px; color: #fff; font-size: 16px; font-weight: 400; height: 50px; outline: medium none;" type="password" name="_password" id="_password" placeholder="">
                                    <p style="color: #fff;">Lupa password? <a style="color: #00fff2" href="<?= base_url('auth/lupapassword') ?>">Reset</a></p>
                                </div>
                            </div>
                            <div class="btn-box">
                                <button onclick="submitLoginButton(this)" class="donate-box-btn _submit_login_button" id="_submit_login_button">MASUK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>