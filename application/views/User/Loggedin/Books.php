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
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Books List</h4>
                                    <p class="mb-0">
                                        This section is the list of Books Registered in the Library 
                                    </p>
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
                                                    <th>Book Name</th>
                                                    <th style="text-align: center;">Category</th>
                                                    <th style="text-align: center;">Author Name</th>
                                                    <th style="text-align: center;">Publication</th>
                                                    <th style="text-align: center;">Publisher</th>
                                                    <!-- <th>Codes</th> -->
                                                    <!-- <th>Registration Date</th> -->
                                                    <th style="text-align: center;">Price</th>
                                                    <th style="text-align: center;">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $counter = 1;
                                                foreach($books as $book) : ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $counter++ ?></td>
                                                        <td class="center"><?= $book['bookName'] ?></td>
                                                        <td class="center" style="text-align: center;"><?= $book['categoryName'] ?></td>
                                                        <td class="center" style="text-align: center;"><?= $book['authorName'] ?></td>
                                                        <td class="center" style="text-align: center;"><?= $book['publication'] ?></td>
                                                        <!-- <td class="center"><?= $book['isbnNumber'] ?></td> -->
                                                        <!-- <td class="center"><?= $book['regDate'] ?></td> -->
                                                        <td class="center" style="text-align: center;"><?= $book['publisher'] ?></td>
                                                        <td class="center" style="text-align: center;"><?= $book['bookPrice'] ?></td>
                                                        <td class="center" style="text-align: center;"><?php if($book['bookStatus'] == 1) 
                                                        {
                                                            echo '<div class="text-success">Available</div>';
                                                        } else {
                                                            echo '<div class="text-danger">Issued</div>';
                                                        }
                                                        ?>
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