<!-- Footer -->
<footer class="py-5" id="footer-main">
    <div class="container">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; <?= getenv('web.footer.year') ? getenv('web.footer.year') : '2021' ?> <a href="<?= getenv('web.footer.url') ? getenv('web.footer.url') : '#' ?>" class="font-weight-bold ml-1" target="_blank"><?= getenv('web.footer.name') ? getenv('web.footer.name') : 'Handokowae.my.id' ?></a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="<?= getenv('web.footer.ownerurl') ? getenv('web.footer.ownerurl') : 'https://handokowae.my.id' ?>" class="nav-link" target="_blank"><?= getenv('web.footer.ownername') ? getenv('web.footer.ownername') : 'Handokowae' ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>