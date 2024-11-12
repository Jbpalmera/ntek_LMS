<div class="content-wrapper">
    <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">My Profile</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading">
                My Profile
                </div>
                <div class="panel-body">
                <form name="signup" method="post">
                    
                    <div class="form-group">
                        <label>Student ID : </label>
                        <?= $studentInfo['StudentId'] ?>
                    </div>
                    <div class="form-group">
                        <label>Reg Date : </label>
                        <?= $studentInfo['RegDate'] ?>
                    </div>
                    <div class="form-group">
                        <label>Last Updation Date : </label>
                        <?= $studentInfo['UpdationDate'] ?>
                    </div>
                    <div class="form-group">
                        <label>Profile Status : </label>
                        <?php if($studentInfo['Status'] == 1){ ?>
                        <span style="color: green">Active</span>
                        <?php } else { ?>
                        <span style="color: red">Blocked</span>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label>Enter Full Name</label>
                        <input class="form-control" type="text" name="fullname" value="<?= $studentInfo['FullName'] ?>" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                        <label>Mobile Number :</label>
                        <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?= $studentInfo['MobileNumber'] ?>" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input class="form-control" type="email" name="email" id="emailid" value="<?= $studentInfo['EmailId'] ?>"  autocomplete="off" required readonly />
                    </div>
                    <button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>