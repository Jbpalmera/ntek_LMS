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
                    <div class="col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Monthly Report</h4>
                                    <p class="mb-0">
                                        This Report Section is for the Issued book this Month
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">

                                 <!-- <input class="form-control" type="text" id="searchInput" placeholder="Search" style="margin-bottom: 10px;"> -->
                              
                                 <table class="table table-striped table-bordered table-hover" id="datatable">
                                    <thead>
                                       <tr>
                                          <th>Student ID</th>
                                          <th>Book ID</th>
                                          <th>Book Name</th>
                                          <th>Accession Number</th>
                                          <th>Return Status</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($filteredBooks as $book) : ?>
                                       <tr class="odd gradeX">
                                          <td class="center"><?= $book['studentID'] ?></td>
                                          <td class="center"><?= $book['bookID'] ?></td>
                                          <td class="center"><?= $book['bookName'] ?></td>
                                          <td class="center"><?= $book['accessionNumber'] ?></td>
                                          <td class="center">
                                          <?php 
                                          if($book['returnStatus'] == 1)
                                          {
                                                echo $book['returnDate'];
                                          } else {
                                                echo 'Not Returned';
                                          }
                                          ?>
                                          </td>
                                       </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                 </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>