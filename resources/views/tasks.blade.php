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
            <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                <i class="fa fa-check bg-primary text-white rounded p-2"></i>
                <u>{{$user->name}}'s Todo-s</u>
            </div>
        </div>
    </div>
    <!-- Create todo section -->
    <div class="row m-1 p-3">
        <div class="col col-11 mx-auto">
            <form method="POST" action="{{ route('save') }}">
                @csrf
                @if ($errors->any())
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                    <div class="col">
                        <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded" type="text" name="name" placeholder="Add new ..">
                    </div>
                    <div class="col-auto px-0 mx-0 mr-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="p-2 mx-4 border-black-25 border-bottom"></div>

    <!-- Todo list section -->
    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            @foreach ($tasks as $task)
            <!-- Todo Item 2 -->
            <div class="row px-3 align-items-center todo-item rounded">
                <div class="col-auto m-1 p-0 d-flex align-items-center">
                    @can('edit-task')
                    <h2 class="m-0 p-0">
                        <form action="{{ route('complete', [ 'task' => $task->id ]) }}" method="post">
                            @csrf
                            <button type="submit" class="fa @if($task->is_complete) fa-check-square-o @else fa-square-o @endif text-primary btn m-0 p-0">
                        </form>
                    </h2>
                    @endcan
                </div>
                <div class="col px-1 m-1 d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg border-0 edit-todo-input bg-transparent rounded px-3" readonly value="{{ $task->name }}" title="{{ $task->name }}" />
                </div>
                <div class="col-auto m-1 p-0 px-2">
                    <div class="row">
                        <div class="col-auto d-flex align-items-center rounded bg-white border border-warning">
                            <i class="fa fa-hourglass-2 my-2 px-2 text-warning btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Due on date"></i>
                            <h6 class="text my-2 pr-2">{{ date('M d, Y', strtotime($task->created_at)) }}</h6>
                        </div>
                    </div>
                </div>
                @can('edit-task')
                <div class="col-auto m-1 p-4">
                    <div class="row d-flex align-items-center justify-content-end">
                        <h5 class="m-0 p-0 px-2">
                            <form action="{{ route('delete', [ 'task' => $task->id ]) }}" method="post">
                                @csrf
                                <button type="submit"class="fa fa-trash-o text-danger btn m-0 p-0">
                            </form>
                        </h5>
                    </div>
                </div>
                @endcan
            </div>
            @endforeach
            <a href="{{ route ('givePermission', $user) }}" class="btn btn-primary">Give Permission</a>
        </div>
    </div>
</div>
</body>
</html>