@extends("layouts.app")

@section("content")

<body>
<div class="container text-center">
    <h1>Edit Task</h1><br>
</div>
<table class="table container">
    <thead class="table-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Description</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">{{ $search->getNumber() }}</th>
        <td>
            <form action="" method="post">
                @csrf
                <input type="text" id="description" name="description" value="{{ $search->getDescription() }}">
                <input type="hidden" id="editNumber" name="editNumber" value="{{ $search->getNumber() }}">
                <input type="submit" id="submit" name="submit" value="Edit" ><br><br>
            </form>
        </td>
    </tr>
    </tbody>

</table>

<br><br>

@endsection
