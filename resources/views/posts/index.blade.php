<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>How to Create Ajax based Bootstrap Pagination in Laravel 9</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        #items_container .content_box div {
            box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="items_container">
                    @foreach ($posts as $item)
                        <div class="col-md-4 content_box">
                            <div>
                                <h2>{{ $item->title }}</h2>
                                <p>{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <button id="load_more_button" data-page="{{ $posts->currentPage() + 1 }}"
                            class="btn btn-primary">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var start = 5;

            $('#load_more_button').click(function() {
                $.ajax({
                    url: "{{ route('load.more') }}",
                    method: "GET",
                    data: {
                        start: start
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('#load_more_button').html('Loading...');
                        $('#load_more_button').attr('disabled', true);
                    },
                    success: function(data) {

                        if (data.data.length > 0) {
                            var html = '';
                            for (var i = 0; i < data.data.length; i++) {
                                html += `<div class="col-md-4 content_box">
                                            <div>
                                                <h2>` + data.data[i].title + `</h2>
                                                <p>` + data.data[i].description + `</p>
                                            </div>
                                        </div>`;
                            }
                            //console.log(html);
                            //append data  without fade in effect
                            //$('#items_container').append(html);

                            //append data with fade in effect
                            $('#items_container').append($(html).hide().fadeIn(1000));
                            $('#load_more_button').html('Load More');
                            $('#load_more_button').attr('disabled', false);
                            start = data.next;
                        } else {
                            $('#load_more_button').html('No More Data Available');
                            $('#load_more_button').attr('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>