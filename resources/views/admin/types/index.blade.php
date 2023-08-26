@extends('layouts.app')

@section('title', 'Types Index')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @if (session('deleted'))
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-xmark"></i> <strong>{{ session('deleted') }}</strong> has been succesfully deleted.
                    </div>
                </div>
            @elseif ( session('created'))
                <div class="col-12">
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('created') }}</strong> has been succesfully created.
                    </div>
                </div>
            @elseif ( session('updated'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('updated') }}</strong> has been succesfully updated.
                    </div>
                </div>
            @elseif ( session('restored'))
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('restored') }}</strong> has been succesfully restored.
                    </div>
                </div>
            @elseif ( session('hardDeleted'))
                <div class="col-12">
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('destroyed') }}</strong> has been permanently deleted.
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Badge</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($typeList as $type)
                            <tr>
                                <th scope="row">
                                    {{ $type->id }}
                                </th>
                                <td>
                                    {{ $type->name  }}
                                </td>
                                <td>
                                    <span class="badge" style="background-color:{{$type->color}}">{{ $type->name }}</div>
                                    
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary me-2"
                                        href="{{ route('admin.types.show', $type->id) }}">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <a class="btn btn-sm btn-success me-2"
                                        href="{{ route('admin.types.edit', $type->id) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.types.delete', $type->id) }}" class="d-inline form-terminator" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {!! $typeList->links() !!}
    </div>
@endsection

@section('custom-scripts')
    <script>
        const deleteFormElements = document.querySelectorAll('form.form-terminator');
        deleteFormElements.forEach(formElement => {
            formElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to delete this Type?');
                if (userConfirm){
                    this.submit();
                }
            });
        });
    </script>
@endsection