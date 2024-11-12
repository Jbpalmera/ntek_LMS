<body class="boxed-fancy">
    <div class="boxed-inner">
      <!-- loader Start -->
      <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body">
            </div>
        </div>      
      </div>
      <!-- loader END -->
      <span class="screen-darken"></span>
        <main class="main-content">
            <?php $this->load->view('Templates/userNavbar') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Return Issued Book</h4>
                                    <p class="mb-0">
                                        This section is for Returning Issued Book
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student Name :</label>
                                    <?= $issuedBooks['fullName'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Student ID :</label>
                                    <?= $issuedBooks['studentID'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Book Name :</label>
                                    <?= $issuedBooks['bookName'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Accession Number</label>
                                    <?= $issuedBooks['accessionNumber'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Book Issued Date :</label>
                                    <?= $issuedBooks['issuesDate'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Expected Return Date :</label>
                                    <?= $issuedBooks['expectedReturnDate'] ?>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Fine :</label>
                                    <input class="form-control" type="text" name="fine" id="fine"  required />
                                </div> -->
                                <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>