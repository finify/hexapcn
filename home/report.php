<?php 
require('includes/auth.php');
require('includes/header.php'); 
require('includes/nav.php'); 


?>
<!-- Header -->
<div class="header pb-6" style="background-color:#288FDD;">
<div class="container-fluid">
    <div class="header-body">
    <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
        <h6 class="h2 text-white d-inline-block mb-0">Home</h6>
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
            <li class="breadcrumb-item">
                <a href="#"><i class="fas fa-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="#">Report Issue</a></li>
            </ol>
        </nav>
        </div>
    </div>
    </div>
</div>
</div>
<!-- Header end -->

<!-- Page content -->
<div class="container-fluid mt--6">
<div class="row">
    <div class="col-xl-12">
    <div class="card">
        <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col">
            <h2 class="h1 text-center text-default mb-0">Report an Issue</h2>
            </div>
        </div>
        </div>
        <div class="card-body">
        <form method="POST" action="">
            <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username"
                    >Subject</label
                    >
                    <input
                    type="text"
                    id="input-first-name"
                    class="form-control"
                    placeholder="subject"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-first-name"
                    >Write message</label
                    >
                    <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    placeholder="your message"
                    ></textarea>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="text-right">
                    <input
                    type="submit"
                    id="submit1"
                    class="form-control btn bg-gradient-danger text-white my-4"
                    value="Report Issue"
                    />
                </div>
                </div>
            </div>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>

<?php 
require('includes/footer.php'); 
?>
</div>
