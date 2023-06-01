<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<section class="service-style-four elements sec-pad-two service-layout-5">
    <div class="container">
        <div class="inner-content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-three wow fadeInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-bg-3.png);"></div>
                                <i class="flaticon-profit"></i>
                            </div>
                            <h3><a href="#">Development Server</a></h3>
                            <div class="text">Get Lightspeed Development Server for your website and fly in the web</div>
                            <div class="link-btn"><a href="#"><i class="far fa-arrow-alt-circle-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-three wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-bg-1.png);"></div>
                                <i class="flaticon-shield-2"></i>
                            </div>
                            <h3><a href="#">Web Protection</a></h3>
                            <div class="text">Best Protection and some tools are provided with our Web servers .</div>
                            <div class="link-btn"><a href="#"><i class="far fa-arrow-alt-circle-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-three wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="bg-layer" style="background-image: url(<?= base_url('themes') ?>/images/icons/icon-bg-4.png);"></div>
                                <i class="flaticon-shopping-1"></i>
                            </div>
                            <h3><a href="#">E-commerce Shop</a></h3>
                            <div class="text">You can build any kind of E-commerce Shop with payment security tools</div>
                            <div class="link-btn"><a href="#"><i class="far fa-arrow-alt-circle-right"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>