<div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Manage Issued Books</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                <div class="panel-heading">
                    Issued Books 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>ISBN </th>
                                <th>Issued Date</th>
                                <th>Return Date</th>
                                <th>Fine in(USD)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $count = 0;
                            foreach($issuedBook as $book) : 
                            $count++ ?>
                            <tr class="odd gradeX">
                                <td class="center"><?= $count ?></td>
                                <td class="center"><?= $book['BookName'] ?></td>
                                <td class="center"><?= $book['ISBNNumber'] ?></td>
                                <td class="center"><?= $book['IssuesDate'] ?></td>
                                <td class="center">
                                <?php if($book['ReturnDate'] == NULL){ ?>
                                    <span style="color:red">
                                    <?= 'Not Returned Yet' ?>
                                    </span>
                                <?php } else {
                                    echo $book['ReturnDate'];
                                } ?>
                                </td>
                                <td class="center"><?= $book['fine'] ?></td>
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