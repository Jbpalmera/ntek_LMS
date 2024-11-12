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
            <?php $this->load->view('Templates/userNavbar'); ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-header d-flex justify-content-between flex-wrap">
                                        <div class="header-title">
                                            <h4 class="card-title mb-2">Self Check Out</h4>
                                            <p class="mb-0">
                                                This section is for the Independent Book Issuance
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
                            <form role="form" method="post" action="<?= base_url('UserProcess_controller') ?>">
                                <?php if(validation_errors()): ?>
                                    <div class="alert alert-danger">
                                        <?= validation_errors(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Student ID<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" value="<?= $studentInfo['studentID'] ?>" name="studentid" autocomplete="off" readonly/>
                                </div>

                                <div class="form-group">
                                    <label>NFC Tag<span style="color:red;">*</span></label><br>
                                    <input class="form-control" type="text" name="nfcTag" onBlur="getNfcTag()" id="nfcTag" placeholder="Please Scan The Book" required="required" readonly/>
                                </div>
                                <div class="mb-3" id="get_nfc_tag"></div>
                                <div id="loaderIcon" style="display:none;">Loading...</div>

                                <div class="form-group">
                                    <label>Day/s of Issuance<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="issued" id="issued" onBlur="getstudent()" autocomplete="off" style="width:150px" required />
                                </div>
                                <!-- <div class="form-group">
                                    <select  class="form-control" name="bookdetails" id="get_book_name" readonly>
                                    </select>
                                </div> -->
                                <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ws = new WebSocket('ws://localhost:8090'); // Adjust the WebSocket URL if necessary

            ws.onmessage = function(event) {
                const nfcTag = event.data;
                document.getElementById('nfcTag').value = nfcTag;
                console.log('UID received:', nfcTag);
                // Trigger the AJAX request after receiving the NFC tag
                getNfcTag();
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

        function getNfcTag() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "<?= base_url('UserProcess_controller/checkNfcTag') ?>",
                data: { nfcTag: $("#nfcTag").val() },
                type: "POST",
                success: function(data) {
                    $("#get_nfc_tag").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {
                    $("#loaderIcon").hide();
                }
            });
        }
    </script>
</body>