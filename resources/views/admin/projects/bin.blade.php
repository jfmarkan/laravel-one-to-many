@extends('layouts.app')

@section('title', 'Trashed Projects')

@section('custom-stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectList as $project)
                            <tr>
                                <th scope="row">
                                    {{ $project->id }}
                                </th>
                                <td>
                                    {{ $project->title }}
                                </td>
                                <td class="text-center">
                                    <form action="{{route('admin.projects.restore', $project->id)}}" class="d-inline form-terminator" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-block">
            {!! $projectList->links() !!}
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        const deleteFormElements = document.querySelectorAll('form.form-terminator');
        deleteFormElements.forEach(formElement => {
            formElement.addEventListener('submit', function(event) {
                event.preventDefault();
                const userConfirm = window.confirm('Are you sure you want to restore this Project?');
                if (userConfirm){
                    this.submit();
                }
            });
        });
    </script>
@endsection