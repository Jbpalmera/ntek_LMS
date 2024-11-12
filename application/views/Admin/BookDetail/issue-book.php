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
                                    <h4 class="card-title mb-2">Issue Book</h4>
                                    <p class="mb-0">
                                        This section is for the Issuance of Book to Students
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student ID<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span> 
                                </div>
                                <!-- <div class="form-group">
                                    <label>Accession Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="accession" id="accession" onBlur="getaccession()" required="required" />
                                </div> -->
                                <div class="form-group">
                                    <label>NFC Tag<span style="color:red;">*</span></label><br>
                                    <input class="form-control" type="text" name="nfcTag" onBlur="getNfcTag()" id="nfcTag" placeholder="Please Scan The Book" required="required" readonly/>
                                </div>
                                <div class="mb-3" id="get_nfc_tag"></div>
                                <div id="loaderIcon" style="display:none;">Loading...</div>

                                <div class="form-group">
                                    <span id="get_book_accession" style="font-size:16px;"></span> 
                                </div>
                                <div class="form-group">
                                    <label>Day/s of Issuance<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="issued" id="issued" onBlur="getstudent()" autocomplete="off" style="width:150px"  required />
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
    // function for get student name
    function getstudent() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "<?= base_url('BookDetails_controller/checkStudent') ?>",
            data:'studentid='+$("#studentid").val(),
            type: "POST",
            success:function(data){
            $("#get_student_name").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){
                $("#loaderIcon").hide();
            }
        });
    }
    
    function getaccession() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "<?= base_url('BookDetails_controller/checkAccession') ?>",
            data: 'accession=' + $("#accession").val(),
            type: "POST",
            success: function(data) {
                $("#get_book_accession").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {
                $("#loaderIcon").hide();
            }
        });
    }
    </script> 
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