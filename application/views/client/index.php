<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="360">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/css/style.css">
</head>

<body>
    <div id="page-container">
        <nav class="navbar navbar-light justify-content-between">
            <a class="navbar-brand" href="<?= base_url() ?>Home">
                <img src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/company/<?= $this->session->userdata('company_logo') ?>" alt="not found" class="d-inline-block align-top" alt="">
            </a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <p class="navbar-link datetime"><span id="datetime"></span></p>
                    </li>
                </ul>
        </nav>
        <br>    
        <div class="container-fluid content-wrap">
            <div class="row content">
                <div id="carousel" class="col-md-8 col-lg-8 carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    </ol>
                    <div class="carousel-inner">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="card schedule">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
        </div>
        <footer class="marquee">
            <ul class="marquee-content">
            </ul>
        </footer>
    </div>
    <script src="<?= base_url() ?>assets/client/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/popper.js/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/client/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/client/js/date.js"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        $(document).ready(function(){ 
            show_carousel()
            show_event()
            show_info()
            datetime()

            // DELETE this when we push into production
            Pusher.logToConsole = true

            var pusher = new Pusher('7ba272c3a6631b4ffaf9', {
                cluster: 'ap1'
            })

            var channel = pusher.subscribe('my-channel')
            channel.bind('my-event', function(data) {
                if(data.message === 'carousel_success'){
                    show_carousel()
                } else if (data.message === 'event_success') {
                    show_event()
                } else {
                    show_info()
                }
            })
            function show_event(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_event',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html, time, date = '', i
                        if (data.length == 0) {
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

            function show_info(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_information',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html = ''
                        var i
                        console.log(data.length)
                        if (data.length == 0) {
                            html += '<li>no information available</li><li>no information available</li>'
                        } else {
                            for(i=0; i<data.length; i++){
                                if (data[i].info_type == 'news') {
                                    html += '<li class="news">'+data[i].description+'</li>'
                                } else {
                                    html += '<li>'+data[i].description+'</li>'
                                }
                            }
                        }
                        $('.marquee-content').html(html)
                    }

                }).done((data) => {
                    set_marquee(data)
                })
            }

            function show_carousel(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?= base_url()?>Home/get_all_active_carousel',
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        var html_carousel_indicator = ''
                        var html_carousel_data = ''
                        var i
                        for(i=0; i<data.length; i++){
                            html_carousel_indicator += '<li data-target="#carouselExampleIndicators" data-slide-to="'+i+'"></li>'
                            if (data[i].data_type == "image") {
                                html_carousel_data += '<div class="carousel-item">' +
                                                            '<div class="view">' +
                                                                '<img class="d-block w-100 carousel-image" src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/carousel/image/'+data[i].data_carousel+'">'+
                                                            '</div>' +
                                                            '<div class="carousel-caption">' +
                                                                '<h3 class="h3-responsive">'+data[i].title+'</h3>' +
                                                                '<p>'+data[i].description+'</p>' +
                                                            '</div>' +
                                                        '</div>'
                            } else {
                                html_carousel_data +=   '<div class="carousel-item v-carousel">' +
                                                            '<div class="view">' +
                                                                '<video class="video-fluid v-data" onplay="pauseCarousel()" onended="resumeCarousel()" muted>' +
                                                                    '<source src="<?= base_url() ?>uploads/<?= $this->session->userdata('company_name') ?>/carousel/video/'+data[i].data_carousel+'" type="video/mp4" />'+
                                                                '</video>'+
                                                            '</div>'+
                                                            '<div class="carousel-caption">' +
                                                                '<h3 class="h3-responsive">'+data[i].title+'</h3>' +
                                                                '<p>'+data[i].description+'</p>' +
                                                            '</div>' +
                                                        '</div>'
                            }
                        }
                        $('.carousel-inner').html(html_carousel_data)
                        $('.carousel-indicators').html(html_carousel_indicator)
                        $('#carousel').carousel({ interval : 4000})
                        $('.carousel-indicators > li').first().addClass('active')
                        $('.carousel-item').first().addClass('active')
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

            function set_marquee(data) {
                const root = document.documentElement
    
                const marqueeElementDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed")
                const marqueeContent = document.querySelector(".marquee-content")
    
                root.style.setProperty('--marquee-elements', marqueeContent.children.length)
                if (data.length == 1) {
                    $('.marquee-content li').clone(true).appendTo('.marquee-content')
                } else {
                    $('.marquee-content li').siblings(':first-child').clone(true).appendTo('.marquee-content')
                }
            }
            setInterval(datetime, 1000*60)
        })
        function pauseCarousel() {
            $("#carousel").carousel('pause');
        }
        function resumeCarousel() {
            $("#carousel").carousel('next');
            $("#carousel").carousel({ interval : 4000});
        }
        $('#carousel').on('slid.bs.carousel', function () {
            if ($('.v-carousel').hasClass('active')) {
                $('.v-data').get(0).play()
            }
        })

    </script>
</body>

</html>