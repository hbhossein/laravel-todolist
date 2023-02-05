<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&amp;display=swap'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="css/dashstyle.css">

</head>
<body>
<div class="container m-5 p-2 rounded mx-auto bg-light shadow">
    <!-- App title section -->
    <div class="row m-1 p-4">
        <div class="col">
            <div class="p-1 h5 text-primary text-center mx-auto display-inline-block">
                <u>Give Permission to {{ $user->name }}</u>
            </div>
        </div>
    </div>
    <div class="p-2 mx-4 border-black-25 border-bottom"></div>
    <!-- Todo list section -->
    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            @foreach ($grantedPermissions as $permission)
            <!-- Todo Item 2 -->
            <div class="row px-3 align-items-center todo-item rounded">
                <div class="col-auto m-1 p-0 d-flex align-items-center">
                    <h2 class="m-0 p-0">
                        <form action="{{ route('withdraw', [$user, $permission]) }}" method="post">
                            @csrf
                            <button type="submit" class="fa fa-check-square-o text-primary btn m-0 p-0">
                        </form>
                    </h2>
                </div>
                <div class="col px-1 m-1 d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg border-0 edit-todo-input bg-transparent rounded px-3" readonly value="{{ $permission->name }}" title="{{ $permission->name }}" />
                </div>
            </div>
            @endforeach

            @foreach ($permissions as $permission)
            <!-- Todo Item 2 -->
            <div class="row px-3 align-items-center todo-item rounded">
                <div class="col-auto m-1 p-0 d-flex align-items-center">
                    <h2 class="m-0 p-0">
                        <form action="{{ route('give', [$user, $permission]) }}" method="post">
                            @csrf
                            <button type="submit" class="fa fa-square-o text-primary btn m-0 p-0">
                        </form>
                    </h2>
                </div>
                <div class="col px-1 m-1 d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg border-0 edit-todo-input bg-transparent rounded px-3" readonly value="{{ $permission->name }}" title="{{ $permission->name }}" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>