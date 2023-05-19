<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/loginform.css" />
</head>
<body>
<div class="container col-12">
    <form class="col-12 login-form" action="{{ url('/authenticate') }}" method="GET">
        {{--        <h2>Installation Form</h2>--}}
        <div class="mb-5">
            <img src="images/FAQ.png" alt="Logo"  width="30%" height="30%">
        </div>
        <div class="input-group mb-3 mt-5">
            <label class="d-flex" for="username">Enter Store Information </label>
            <input name="shop" type="text" class="form-control" placeholder="example.myshopify.com" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-success" type="submit" id="button-addon2">Install</button>
        </div>
    </form>
</div>
{{--<div class="container-opt col-12"></div>--}}
</body>
</html>
