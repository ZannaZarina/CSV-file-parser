<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>-CSV-PARSER-</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <div class="card text-center">
            <div class="card-body">
                <form
                    method="post"
                    action="{{ route('fileUpload') }}"
                    enctype="multipart/form-data"
                > @csrf
                    <h3 class="card-title">Select CSV files to upload:</h3>
                    <br>
                    <p>Just upload files and get parsed one immediately</p>
                    <br>
                    <input
                        type="file"
                        name="file[]"
                        id="file"
                        required
                        multiple>
                    <button type="submit" class="btn btn-success"> Get a new CSV file!</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
