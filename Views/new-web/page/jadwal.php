<?= $this->extend('new-web/template/index') ?>

<?= $this->section('content') ?>
<?= $this->include('new-web/template/header') ?>
<section class="pricing-section centred">
    <div class="container" style="margin-top: 100px;">
        <div class="sec-title center">
            <h2>Our Best Price Plan</h2>
            <p>We provide best price plan for our customer check the list now<br>and slect now plan.</p>
        </div>
        <div class="tabs-box">
            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-1.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Basic</h3>
                                        <h2 class="price">05.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-2.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Premium</h3>
                                        <h2 class="price">25.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-3.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">PROFESSIONAL</h3>
                                        <h2 class="price">50.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab" id="tab-2">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-1.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Basic</h3>
                                        <h2 class="price">30.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-2.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">Premium</h3>
                                        <h2 class="price">60.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 pricing-column">
                            <div class="pricing-block-one">
                                <div class="pricing-table">
                                    <figure class="image"><img src="images/icons/price-icon-3.png" alt=""></figure>
                                    <div class="table-header">
                                        <h3 class="title">PROFESSIONAL</h3>
                                        <h2 class="price">99.00<span>/Mo</span></h2>
                                    </div>
                                    <div class="table-content">
                                        <ul>
                                            <li>One User</li>
                                            <li>Ui elements 1000</li>
                                            <li>E-mail support</li>
                                            <li>Phone Support</li>
                                        </ul>
                                    </div>
                                    <div class="table-footer">
                                        <a href="#" class="theme-btn-two">Purchase</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-btn-box">
                <ul class="tab-btns tab-buttons clearfix">
                    <li class="tab-btn active-btn" data-tab="#tab-1">Monthly</li>
                    <li class="tab-btn" data-tab="#tab-2">Yearly</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scriptBottom'); ?>
<?= $this->endSection(); ?>

<?= $this->section('scriptTop'); ?>
<?= $this->endSection(); ?>