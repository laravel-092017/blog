<div class="boxed sticky push-down-30">
    <div class="row">
        <div class="col-xs-10  col-xs-offset-1">
            <div class="widget-author__content">
                <form action="" method="POST" id="ajaxForm">
                    Name: <input name="name" type="text"><br>
                    Surname: <input name="surname" type="text"><br>
                    Age: <input name="age" type="text"><br>
                    <button type="submit">Send</button>
                </form>
                <div id="ajaxContent"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $(function() {
        $('#ajaxForm').on('submit', function (e) {
            var name = $('[name="name"]').val(),
                surname = $('[name="surname"]').val(),
                age = $('[name="age"]').val();

            e.stopPropagation();
            e.preventDefault();

            var postPromise = $.post('/api/simple', {
                name: name,
                surname: surname,
                age:age
            });

            postPromise.then(function (data) {
                console.log(data);
                $('#ajaxContent').html(data);
            }, function (error) {
                console.log(error);
                //alert('Произошла ошибка на сервере');
                $('#ajaxContent').html('<h3 style="color: red">Error fetching data from server with code: ' + error.status + '</h3>');
            });
        });
    });
</script>