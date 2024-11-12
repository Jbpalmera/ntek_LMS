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
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header d-flex justify-content-between flex-wrap">
                                        <div class="header-title">
                                            <h4 class="card-title mb-2">Issued Book</h4>
                                            <p class="mb-0">
                                                This section is the list of Books Issued to the borrower
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-4">
                                        <?= $this->session->flashdata('message') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table Start -->
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th style="text-align: center;">Book Name</th>
                                                    <th style="text-align: center;">Accession Number</th>
                                                    <th style="text-align: center;">Issued Date</th>
                                                    <th style="text-align: center;">Expected Return Date</th>
                                                    <th style="text-align: center;">Return Date</th>
                                                    <th style="text-align: center;">Fine</th>
                                                    <th style="text-align: center;">Return</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $count = 0;
                                                foreach($issuedBook as $book) : 
                                                $count++ ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?= $count ?></td>
                                                    <td class="center" style="text-align: center;"><?= $book['bookName'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= $book['accessionNumber'] ?></td>
                                                    <td class="center" style="text-align: center;"><?= date('F j, Y', strtotime($book['issuesDate'])); ?></td>
                                                    <td class="center" style="text-align: center;"><?= date('F j, Y', strtotime($book['expectedReturnDate'])); ?></td>
                                                    <td class="center" style="text-align: center;">
                                                    <?php if($book['returnDate'] == NULL){ ?>
                                                        <span style="color:red">
                                                        <?= 'Not Returned Yet' ?>
                                                        </span>
                                                    <?php } else {
                                                        echo date('F j, Y', strtotime($book['returnDate']));
                                                    } ?>
                                                    </td>
                                                    <td class="center" style="text-align: center;"><?= $book['fine'] ?></td>
                                                    <td class="center" style="text-align: center;">
                                                        <?php if($book['returnStatus'] == 1){ ?>
                                                            <span>Book Returned</span>
                                                        <?php } else {?>
                                                        <a href="<?= base_url('nfcScan?id=' . $book['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Return Book">
                                                         <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                        </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Table End -->
                            </div>
                            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                            <script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>
                            <script>
                            new DataTable('#dataTable');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>
