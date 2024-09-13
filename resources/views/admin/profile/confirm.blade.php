<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm to Change</title>
</head>
<body>
    <div class="">
        <form action="{{route('admin#confirmToChange')}}">
            <h3>You will be automatically logged out from the website and log in again after you have changed the password.</h3>
            <div class="">Are you sure to Log Out?</div>
            <button type="submit">Yes</button>
            <button type='submit'>No</button>
        </form>
    </div>
</body>
</html>
