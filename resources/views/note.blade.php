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
        <a href="/">Список заметок</a>
        <form id="publish" action="javascript: false;">
            <script>
                jQuery(function ($) {
                    loadNote();
                });
            </script>
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" size="50" disabled/>
            </div>
            <div class="form-group">
                <label for="content">Text</label>
                <textarea id="content" rows="10"
                          cols="50" disabled></textarea>
            </div>
            <div class="form-group">
                <label for="expiration">Expiration</label>
                <input id="expiration" type="text" size="30" disabled/>
            </div>
            <div class="form-group">
                <label for="access">Accessibility</label>
                <input id="access" type="text" size="30" disabled/>
            </div>
            <a id="link">Ссылка для доступа к этой заметке</a>
        </form>
    </div>
    <div class="content" id="public-share">
    </div>
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
<script src="js/note-logic.js"></script>
<script src="js/common.js"></script>
</html>
