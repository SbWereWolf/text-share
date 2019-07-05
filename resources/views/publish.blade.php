<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Text Share</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="css/decoration.css">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <form id="publish" action="javascript: false;">
            <script>
                jQuery(function ($) {
                    $("#publish").submit(async function (event) {
                        postText({
                            title: $("#title").val(),
                            content: $("#content").val(),
                            expiration: $("#expiration").val(),
                            access: $("#access").val()
                        })
                    });
                });
            </script>
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" size="50"/>
            </div>
            <div class="form-group">
                <label for="content">Text</label>
                <textarea id="content" rows="10"
                          cols="50"></textarea>
            </div>
            <div class="form-group">
                <label for="expiration">Expiration</label>
                <select id="expiration">
                    <option value="1">10мин</option>
                    <option value="2">1час</option>
                    <option value="3">3часа</option>
                    <option value="4">1день</option>
                    <option value="5">1неделя</option>
                    <option value="6">1месяц</option>
                    <option value="7">без ограничения</option>
                </select>
            </div>
            <div class="form-group">
                <label for="access">Accessibility</label>
                <select id="access">
                    <option value="1">public</option>
                    <option value="2">unlisted</option>
                </select>
            </div>
            <input type="submit" value="Сохранить заметку">
        </form>
    </div>
</div>

<div class="content" id="public-share">
    <script>
        jQuery(function ($) {
            updateList()
        });
    </script>
</div>
</body>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/latest/js.cookie.min.js"></script>
<script src="js/publish-logic.js"></script>
<script src="js/common.js"></script>
</html>
