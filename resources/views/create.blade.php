<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
        .invalid-feedback { display: block; }
    </style>
</head>
<body>
    <div class="container p-5">
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="{{ route('save') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
