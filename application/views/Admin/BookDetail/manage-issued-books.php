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
            <?php $this->load->view('Templates/navbar') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Issued Book</h4>
                                    <p class="mb-0">
                                        This section is the list of Issued Books to the Students
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table Start -->
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                          <table class="table table-striped table-bordered table-hover" id="datatable">
                                             <thead>
                                                <tr>
                                                   <th>#</th>
                                                   <th>Student Name</th>
                                                   <th>Book Name</th>
                                                   <th style="text-align: center;">Accession Number</th>
                                                   <th style="text-align: center;">Issued Date</th>
                                                   <th style="text-align: center;">Expected Return Date</th>
                                                   <th style="text-align: center;">Return Date</th>
                                                   <!-- <th>Fine</th> -->
                                                   <th>Action</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                             <?php 
                                             $counter = count($issuedBooks);
                                             foreach($issuedBooks as $book) : ?>
                                                <tr class="odd gradeX">
                                                   <td class="center"><?php echo $counter-- ?></td>
                                                   <td class="center"><?php echo $book['fullName'] ?></td>
                                                   <td class="center"><?php echo $book['bookName'] ?></td>
                                                   <td class="center" style="text-align: center;"><?php echo $book['accessionNumber'] ?></td>
                                                   <td class="center" style="text-align: center;"><?php echo date('F j, Y', strtotime($book['issuesDate'])) ?></td>
                                                   <td class="center" style="text-align: center;">
                                                   <?php
                                                   if($book['expectedReturnDate'] == NULL)
                                                   {
                                                      echo " ";
                                                   } else {
                                                   echo date('F j, Y', strtotime($book['expectedReturnDate']));
                                                   }
                                                   ?>
                                                   </td>
                                                   <td class="center" style="text-align: center;">
                                                   <?php
                                                   if($book['returnDate'] == NULL)
                                                   {
                                                      echo " ";
                                                   } else {
                                                   echo date('F j, Y', strtotime($book['returnDate']));
                                                   }
                                                   ?>
                                                   </td>
                                                   <!-- <td class="center">$<?php echo $book['fine'] ?></td> -->
                                                   <td class="center">
                                                      <a href="<?= base_url('BookDetails_controller/edit_issued_book?id=' . $book['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                         <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px">
                                                      </a>
                                                      <!-- <a href="<?= base_url('BookDetails_controller/edit_issued_book?id=' . $book['id']) ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>  -->
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
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>