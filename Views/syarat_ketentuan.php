<!-- DEBUG-VIEW START 1 APPPATH/Config/../Views/syarat_ketentuan.php -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Slamdung | Syarat Ketenttuan</title>
    <meta name="description" content="PPDB TA. 2023/2024 Kabupaten Lampung Timur">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- STYLES -->

    <style>
        * {
            transition: background-color 300ms ease, color 300ms ease;
        }

        *:focus {
            background-color: rgba(221, 72, 20, .2);
            outline: none;
        }

        html,
        body {
            color: rgba(33, 37, 41, 1);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 16px;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        header {
            background-color: rgba(247, 248, 249, 1);
            padding: .4rem 0 0;
        }

        .menu {
            padding: .4rem 2rem;
        }

        header ul {
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            padding: 0;
            text-align: right;
        }

        header li {
            display: inline-block;
        }

        header li a {
            border-radius: 5px;
            color: rgba(0, 0, 0, .5);
            display: block;
            height: 44px;
            text-decoration: none;
        }

        header li.menu-item a {
            border-radius: 5px;
            margin: 5px 0;
            height: 38px;
            line-height: 36px;
            padding: .4rem .65rem;
            text-align: center;
        }

        header li.menu-item a:hover,
        header li.menu-item a:focus {
            background-color: rgba(221, 72, 20, .2);
            color: rgba(221, 72, 20, 1);
        }

        header .logo {
            float: left;
            height: 44px;
            padding: .4rem .5rem;
        }

        header .menu-toggle {
            display: none;
            float: right;
            font-size: 2rem;
            font-weight: bold;
        }

        header .menu-toggle button {
            background-color: rgba(221, 72, 20, .6);
            border: none;
            border-radius: 3px;
            color: rgba(255, 255, 255, 1);
            cursor: pointer;
            font: inherit;
            font-size: 1.3rem;
            height: 36px;
            padding: 0;
            margin: 11px 0;
            overflow: visible;
            width: 40px;
        }

        header .menu-toggle button:hover,
        header .menu-toggle button:focus {
            background-color: rgba(221, 72, 20, .8);
            color: rgba(255, 255, 255, .8);
        }

        header .heroe {
            margin: 0 auto;
            max-width: 1100px;
            padding: 1rem 1.75rem 1.75rem 1.75rem;
        }

        header .heroe h1 {
            font-size: 2.5rem;
            font-weight: 500;
        }

        header .heroe h2 {
            font-size: 1.5rem;
            font-weight: 300;
        }

        section {
            margin: 0 auto;
            max-width: 1100px;
            padding: 2.5rem 1.75rem 3.5rem 1.75rem;
        }

        section h1 {
            margin-bottom: 2.5rem;
        }

        section h2 {
            font-size: 120%;
            line-height: 2.5rem;
            padding-top: 1.5rem;
        }

        section pre {
            background-color: rgba(247, 248, 249, 1);
            border: 1px solid rgba(242, 242, 242, 1);
            display: block;
            font-size: .9rem;
            margin: 2rem 0;
            padding: 1rem 1.5rem;
            white-space: pre-wrap;
            word-break: break-all;
        }

        section code {
            display: block;
        }

        section a {
            color: rgba(221, 72, 20, 1);
        }

        section svg {
            margin-bottom: -5px;
            margin-right: 5px;
            width: 25px;
        }

        .further {
            background-color: rgba(247, 248, 249, 1);
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            border-top: 1px solid rgba(242, 242, 242, 1);
        }

        .further h2:first-of-type {
            padding-top: 0;
        }

        footer {
            background-color: rgba(221, 72, 20, .8);
            text-align: center;
        }

        footer .environment {
            color: rgba(255, 255, 255, 1);
            padding: 2rem 1.75rem;
        }

        footer .copyrights {
            background-color: rgba(62, 62, 62, 1);
            color: rgba(200, 200, 200, 1);
            padding: .25rem 1.75rem;
        }

        @media (max-width: 559px) {
            header ul {
                padding: 0;
            }

            header .menu-toggle {
                padding: 0 1rem;
            }

            header .menu-item {
                background-color: rgba(244, 245, 246, 1);
                border-top: 1px solid rgba(242, 242, 242, 1);
                margin: 0 15px;
                width: calc(100% - 30px);
            }

            header .menu-toggle {
                display: block;
            }

            header .hidden {
                display: none;
            }

            header li.menu-item a {
                background-color: rgba(221, 72, 20, .1);
            }

            header li.menu-item a:hover,
            header li.menu-item a:focus {
                background-color: rgba(221, 72, 20, .7);
                color: rgba(255, 255, 255, .8);
            }
        }
    </style>
</head>

<body>

    <!-- HEADER: MENU + HEROE SECTION -->
    <header>

        <div class="menu">
            <ul>
                <li class="logo"><a href="#" target="_blank"><img height="44" title="Slamdung" alt="" src="https://slamdung.lampungtengahkab.go.id/assets/logo.png"></a>
                </li>
                <li class="menu-toggle">
                    <button onclick="toggleMenu();">&#9776;</button>
                </li>
                <li class="menu-item hidden"><a href="https://slamdung.lampungtengahkab.go.id">Home</a></li>
                <li class="menu-item hidden"><a href="https://slamdung.lampungtengahkab.go.id/syaratketentuan">Syarat & Ketentuan</a></li>
                <li class="menu-item hidden"><a href="https://slamdung.lampungtengahkab.go.id/disclaimer">Disclaimer</a></li>
            </ul>
        </div>

    </header>

    <!-- CONTENT -->

    <section>

        <h1>Syarat &amp; Ketentuan</h1>

        <p>Selamat datang di situs Sistem Layanan Administrasi Kependudukan Daring (SLAMDUNG) berbasis Android milik Dinas Kependudukan dan Pencatatan Sipil Kabupaten Lampung Timur.</p>

        <p>Halaman ini berisi syarat dan ketentuan bagi seluruh penduduk Kabupaten Lampung Timur yang menggunakan layanan untuk menerbitkan Dokumen Kependudukan oleh Dinas Kependudukan dan Pencatatan Sipil Kabupaten Lampung Timur.</p>

        <p>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Lampung Timur menghimbau agar Anda membaca Syarat dan Ketentuan ini dengan seksama, Dinas Kependudukan dan Pencatatan Sipil Kabupaten Lampung Timur berhak sewaktu-waktu mengubah Syarat dan Ketentuan ini.</p>

        <p>Pengguna layanan ini harus tunduk dan patuh pada ketentuan sebagai berikut :</p>
        <div>
            <ul>
                <li>
                    Sistem Layanan Administrasi Kependudukan Daring (SLAMDUNG) berbasis Android ini tunduk dan taat pada ketentuan hukum dan perundang – undangan yang berlaku di Negara Kesatuan Republik Indonesia dalam hal ini Undang-Undang tentang tentang Informasi dan Transaksi Elektronik.
                </li>
                <li>
                    Layanan Dukcapil Online diselenggarakan oleh pemerintah Kabupaten Lampung Timur, dalam hal ini Dinas Kependudukan dan Pencatatan Sipil.
                </li>
                <li>
                    Layanan dukcapil online Kabupaten Lampung Timur adalah layanan yang diperuntukkan secara khusus kepada masyarakat Kabupaten Lampung Timur.
                </li>
                <li>
                    Tujuan layanan dukcapil online adalah untuk mempermudah masyarakat dalam kepengurusan dokumen kependudukan secara mandiri.
                </li>
                <li>
                    Dokumen Kependudukan selanjutnya dapat dicetak mandiri oleh penduduk dimanapun, dengan cara mengunduh file PDF yang telah dikirimkan melalui email masing-masing.
                </li>
                <li>
                    Penduduk yang akan melakukan permohonan penerbitan dokumen kependudukan akan membuat akun dengan menggunakan user Nomor Identitas Kependudukan (NIK). Nomor Identitas Kependudukan sebagai user, hanya dapat digunakan oleh pemohon yang bersangkutan dan tidak dianjurkan untuk diwakilkan.
                </li>
                <li>
                    Pengguna yang menggunakan layanan ini menyatakan bahwa setuju dengan ketentuan dan syarat yang diberlakukan oleh penyedia layanan. Dalam hal ini adalah Dinas Kependudukan dan Pencatatan Sipil Kabupaten Lampung Timur.
                </li>
                <li>
                    Informasi kependudukan yang dikirim melaluli layanan ini, akan kami simpan di server kami dan tidak akan kami berikan kepada pihak manapun.
                </li>
            </ul>
        </div>
        <p>Perubahan atas Kebijakan hak-pribadi/Privacy Policy Kami</p>

        <p>Jika di kemudian hari kami melakukan perubahan atas kebijakan hak pribadi kami, perubahan tersebut akan kami tempatkan di halaman ini. Berdasarkan pertimbangan yang tepat, kami mungkin juga akan menginformasikan perubahan tersebut kepada Anda via e-mail.</p>

        <p>Pihak yang dapat Dihubungi</p>

        <p>Kami menyambut baik pertanyaan, permintaan dan komentar Anda tentang kebijakan hak pribadi ini. Anda bisa menghubungi kami via e-mail di admin.disdukcapil@lampungtengahkab.go.id</p>

    </section>

    <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

    <footer>

        <div class="copyrights">

            <p>&copy; 2020 SLAMDUNG, supported by: Disdukcapil Kabupaten Lampung Timur.</p>

        </div>

    </footer>

    <!-- SCRIPTS -->

    <script>
        function toggleMenu() {
            var menuItems = document.getElementsByClassName('menu-item');
            for (var i = 0; i < menuItems.length; i++) {
                var menuItem = menuItems[i];
                menuItem.classList.toggle("hidden");
            }
        }
    </script>

    <!-- -->

</body>

</html>
<!-- DEBUG-VIEW ENDED 1 APPPATH/Config/../Views/syarat_ketentuan.php -->