<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/vendor/bootstrap/css/bootstrap.min.css">
    <style>
        /* table tbody { height:100px; overflow:auto; } */
        table thead {
            text-align: center;
        }

        #wrapper {
            display: flex;
        }
    </style>
</head>

<body style="background-color: blanchedalmond;">
    <nav class="navbar navbar-light justify-content-between" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/company/<?= $this->session->userdata('company_logo') ?>" alt="not found" class="d-inline-block align-top" alt="">
        </a>
        <div class="nav navbar-nav pull-md-right">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <p class="navbar-text" style="font-size:20px;"><span id="datetime"></span></p>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div id="wrapper">
        <div class="container-fluid">
            <div class="row content">
                <!-- <div class="col-md-8"> -->
                <div id="carouselExampleSlidesOnly" class="col-md-8 col-lg-8 carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/img/pollution Wallpaper 2.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/Alone.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/Dream Big.jpg" alt="Third slide">
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="col-md-4 col-lg-4">
                    <div class="card" style="height:400px;">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" colspan="3">Schedule</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Description</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody id="show_event">
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Product Presentation</td>
                                        <td>Meeting Room A</td>
                                        <td>12:00 WIB, 12 june 2020</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <br>
                    <div class="card" style="height:280px;">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">blablabla</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Meeting Room A</td>
                                        <td>Occupied</td>
                                    </tr>
                                    <tr>
                                        <td>Jacob</td>
                                        <td>Jacob</td>
                                    </tr>
                                    <tr>
                                        <td>Jacob</td>
                                        <td>Larry</td>
                                    </tr>
                                    <tr>
                                        <td>Jacob</td>
                                        <td>Larry</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- footer -->
        </div>
    </div>
    <br>
    <footer class="footer font-small blue" style="background-color: cornflowerblue; height:75px">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
        </div>
    </footer>
    <script src="<?= base_url() ?>assets/client/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/popper.js/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/client/js/date.js"></script>
    <script>
        $(document).ready(function(){ 
            
            function show_event(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_event',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = ''
                        var i
                        var time = ''
                        var date = ''
                        if (date.length == 0) {
                            html += '<tr><td colspan="3" style="text-align:center">no incoming event</td></tr>'
                        } else {
                            for(i=0; i<data.length; i++){
                                date = dateFormat(new Date(data[i].due_date), "d mmmm yyyy")
                                time = dateFormat(new Date(data[i].due_date), "h:MM")
                                html += '<tr>'+
                                        '<td>'+data[i].description+'</td>'+
                                        '<td>'+ data[i].location +'</td>'+
                                        '<td>'+ time + ' WIB, '+ date + '</td>'+
                                        '</tr>'
                            }
                        }
                        $('#show_event').html(html)
                    }

                })
            }
            
            function datetime() {
                var dateNow = new Date()
                var time = dateFormat(new Date(), "HH:MM")
                var date = dateFormat(new Date(), "d mmmm yyyy")
                html = date+'<br>'+time+' WIB'
                $('#datetime').html(html)
            }

            setInterval(datetime, 1000)
            setInterval(show_event, 1000)
        })
    </script>
</body>

</html>