<body class="boxed-fancy">
    <div class="boxed-inner">
        <!-- loader Start -->
        <div id="loading">
            <div class="loader simple-loader">
                <div class="loader-body"></div>
            </div>
        </div>
        <!-- loader END -->
        <span class="screen-darken"></span>
        <main class="main-content">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <button data-trigger="navbar_main" class="d-lg-none btn btn-primary rounded-pill p-1 pt-0"
                        type="button">
                        <svg class="icon-20" width="20px" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                        </svg>
                    </button>
                    <a href="" class="navbar-brand">
                        <!--Logo start-->
                        <img class="logo" src="<?php echo base_url('/assets/assets/images/LMS.png') ?>" alt="">
                        <!--logo End-->
                        <h4 class="logo-title">Book Pad Reader</h4>
                    </a>
                    <!-- Horizontal Menu Start -->
                    <nav id="navbar_main"
                        class="nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
                        <!-- container-fluid.// -->
                    </nav>
                </div>
            </nav>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <!-- MIDDLE PART OF THE PAGE -->
                        <h1>PLEASE SCAN BOOK</h1>
                        <form action="" method="post">
                            <input type="text" value="" name="nfc" id='nfc' autofocus>
                        </form>
                    </div>
                    <div class="bookname">
                        <p>
                            <?php
                            if (isset($bookData) && isset($bookData['bookName']) && $bookData['bookName'] !== null) {
                                echo $bookData['bookName'];
                            } else {
                                echo 'No Data';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </main>
        <!-- Wrapper End-->
    </div>
</body>
