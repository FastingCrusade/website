<html>
<head>
    <style>
        body.grey {
            background-color: #5e5e5e;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="/semantic/dist/semantic.min.css">

    <title>Coming Soon!</title>
    <link rel="shortcut icon" href="{{ asset('img/c_logo.svg') }}" />

</head>
<body class="grey">
<div class="ui grid centered container">
    <div class="row">
        <div class="column">
            <img src="{{ asset('img/c_logo.svg') }}" style="height: 10rem">
        </div>
    </div>
    <div class="row">
        <div class="column">
            <h1 class="ui header">Coming Soon</h1>
        </div>
    </div>
    <div class="row">
        <div class="column">
            Your site for fasting.
        </div>
    </div>
    <div class="row">
        <div class="column">
            <div class="ui form">
                <div class="inline fields">
                    <div class="field">
                        <input type="email" name="email" placeholder="Your email address">
                        <button class="ui red button">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="column">
            We will update you as soon as we are ready.
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    $('button').on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        var $this = $(this);

        $.ajax({
            url: 'newsletters/subscription',
            method: 'POST',
            data: {
                email: $this.siblings('input').val(),
                '_token': '{{ csrf_token() }}'
            }
        })
            .done(function () {
                $this.closest('.column').text('Thank you, we\'ll let you know!');
            });
    })
</script>
</body>
</html>
