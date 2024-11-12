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
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Add New Book</h4>
                                    <p class="mb-0">
                                        This section is for adding new Book
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post" action="<?= base_url('Book_controller/add_book') ?>">
                                <?php if(validation_errors()): ?>
                                    <div class="alert alert-danger">
                                        <?= validation_errors(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label> Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required="required">
                                        <option value=""> Select Category</option>
                                        <?php foreach($category as $cat) : ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['categoryName'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label> Author<span style="color:red;">*</span></label>
                                    <select class="form-control" name="author" required="required">
                                        <option value=""> Select Author</option>
                                        <?php foreach($author as $authors) : ?>
                                        <option value="<?= $authors['id'] ?>"><?= $authors['authorName'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Accession Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="accessionNumber"  required="required" autocomplete="off"  />
                                    <!-- <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p> -->
                                </div>
                                <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
                                    <p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
                                </div>
                                <div class="form-group">
                                    <label>NFC Tag<span style="color:red;">*</span></label>
                                    <input class="form-control" id="nfc-uid" type="text" name="nfcTag"  required="required" autocomplete="off" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Publisher<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publisher" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Publication<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publication" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Price<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="price" autocomplete="off"   required="required" />
                                </div>
                                <button type="submit" name="add" class="btn btn-info">Add </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const ws = new WebSocket('ws://localhost:8090'); 

                    ws.onmessage = function(event) {
                        document.getElementById('nfc-uid').value = event.data;
                        console.log('UID received:', event.data);
                    };

                    ws.onopen = function() {
                        console.log('WebSocket connection established');
                    };

                    ws.onclose = function() {
                        console.log('WebSocket connection closed');
                    };

                    ws.onerror = function(error) {
                        console.error('WebSocket error:', error);
                    };
                });
            </script>
       </main>
      <!-- Wrapper End-->
    </div>
</body>