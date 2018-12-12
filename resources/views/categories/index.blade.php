@extends('admin.layout')

@section('title', '| Categories')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    @section('content-header')
    <h1><i class="fa fa-key"></i>Categories</h1>
    <hr>
    @endsection
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                <tr>

                    <td><a href="{{ route('categories.show', $category->id ) }}"><b>{{ $category->name }}</b><br>
                    </td>
                     <td>{{ $category->description }}
                     </td>
                    <td>
                    <a href="{{ URL::to('categories/'.$category->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('categories/create') }}" class="btn btn-success">Add Category</a>

</div>

@endsection