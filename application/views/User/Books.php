<div class="content-wrapper">
    <div class="container-fluid">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Books</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                <div class="panel-heading">
                    Available Books 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">

                    <!-- <input class="form-control" type="text" id="searchInput" placeholder="Search" style="margin-bottom: 10px;"> -->

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
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
    </div>
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
