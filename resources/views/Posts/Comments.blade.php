@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Comments</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                {{--                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">--}}
                {{--                    {{ trans('GradesTrans.AddGrade') }}--}}
                {{--                </button>--}}
                {{--                <br><br>--}}

                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                    <tr>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Comment photo</th>
                        <th>Comment video</th>
                        <th>Likes</th>
                        <th>Post Id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img
                                        src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                    />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{$comment->users->name}}</p>
                                        <p class="text-muted mb-0">{{$comment->users->email}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$comment->commentBody}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$comment->photo}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$comment->video}}</p>

                            </td>

                            <td>
                                <p class="fw-normal mb-1">{{$comment->likes}}</p>

                            </td>

                            <td>
                                <p class="fw-normal mb-1">{{$comment->postId}}</p>

                            </td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm btn-rounded">
                                    Edit
                                </button>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>@endsection
@section('js')

@endsection
