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
                                    <h4 class="card-title mb-2">Student List</h4>
                                    <p class="mb-0">
                                        This section is the Student List Registered in Library
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Table Start -->
                                <div class="row">
                                    <div class="col-md-12">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-xl" style="margin-bottom: 20px;">
                                                    <span class="text">Import Excel</span>
                                            </button>
                                            <button type="button" class="btn btn-success" onclick="printTable()" style="margin-bottom: 20px;">
                                                    <span class="text">Print Table to PDF</span>
                                            </button>
                                            <button type="button" class="btn btn-success" onclick="window.location.href='<?= base_url('Student_controller/export_csv') ?>'" style="margin-bottom: 20px;">
                                                <span class="text">Export to Excel</span>
                                            </button>
                                        <!-- Modal For Import -->
                                            <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Import Student</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                    <form method="post" action="<?php echo base_url();?>import/import_Student_File" enctype="multipart/form-data">
                                                    <p><label>Select Excel File</label>
                                                    <input type="file" name="uploadFile" required accept=".csv" /></p>
                                                    <br/>
                                                    <input type="submit" name="submit" value="Upload" class="btn btn-success" />
                                                    </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Modal -->

                                        <!-- Advanced Tables -->
                                        <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Students
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                            
                                            <!-- <input class="form-control" type="text" id="searchInput" placeholder="Search" style="margin-bottom: 10px;"> -->
                                            
                                                <table class="table table-striped table-bordered table-hover" id="dataTable">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student ID</th>
                                                        <th>Student Name</th>
                                                        <!-- <th>Email id </th> -->
                                                        <!-- <th>Mobile Number</th> -->
                                                        <!-- <th>Reg Date</th> -->
                                                        <th style="text-align: center;">Membership</th>
                                                        <th style="text-align: center;">Status</th>
                                                        <th style="text-align: center;">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    $counter = 1;
                                                    foreach($studentInfo as $info) : ?>          
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?= $counter++ ?></td>
                                                        <td class="center"><?= $info['studentID'] ?></td>
                                                        <td class="center"><?= $info['fullName'] ?></td>
                                                        <!-- <td class="center"><?= $info['emailID'] ?></td> -->
                                                        <!-- <td class="center"><?= $info['mobileNumber'] ?></td> -->
                                                        <!-- <td class="center"><?= $info['regDate'] ?></td> -->
                                                        <td class="center" style="text-align: center;"><?= $info['membershipType'] ?></td>
                                                        <td class="center" style="text-align: center;">
                                                            <?php
                                                            if($info['status'] == 1)
                                                            {
                                                                echo '<div class="badge bg-success" >Active</div>';
                                                            } else {
                                                                echo '<div class="badge bg-danger" >Blocked</div>';
                                                            }
                                                            ?>
                                                        </td>
                                                        
                                                        <td class="center" style="text-align: center;">
                                                            <a href="<?= base_url('Student_controller/editStudent?id=' . $info['id']) ?>" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <img src="<?= base_url('assets/img/edit.png') ?>" alt="" style="width: 25px"> 
                                                            </a>
                                                            <?php if($info['status'] == 0){?>
                                                            <a href="<?= base_url('Student_controller/activateStudent?id=' . $info['id']) ?>" onclick="return confirm('Are you sure you want to active this student?');" class="btn btn-sm btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Re-activate">
                                                            <img src="<?= base_url('assets/img/check.png') ?>" alt="" style="width: 25px"> 
                                                            </a>
                                                            <?php } else { ?>
                                                            <a href="<?= base_url('Student_controller/deActivateStudent?id=' . $info['id']) ?>" onclick="return confirm('Are you sure you want to block this student?');" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="De-activate">
                                                            <img src="<?= base_url('assets/img/ex.png') ?>" alt="" style="width: 25px"> 
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
                                        <!--End Advanced Tables -->
                                    </div>
                                </div>
                                <!-- Table End -->
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            <script src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>
                            <script>
                            new DataTable('#dataTable');
                            </script>
                            <script>
                                $(document).ready(function () {
                                    $('#searchInput').on('keyup', function () {
                                        var value = $(this).val().toLowerCase();
                                        $('#dataTables tbody tr').filter(function () {
                                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                                        });
                                    });
                                });
                            </script>
                            <script>
                                function printTable() {
                                    var printWindow = window.open('', '_blank');
                                    printWindow.document.write('<html><head><title>Print Table</title></head><body>');
                                    printWindow.document.write('<h4>Manage Reg Students</h4>');

                                    var clonedTable = $('#dataTable').clone();
                                    clonedTable.find('th:eq(7),td:nth-child(8)').remove(); 

                                    printWindow.document.write(clonedTable[0].outerHTML);
                                    printWindow.document.write('</body></html>');
                                    printWindow.document.close();
                                    printWindow.print();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>