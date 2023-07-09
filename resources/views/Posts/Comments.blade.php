@extends('layouts.master')
@section('css')

@section('title')
    Comments
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
                <li class="breadcrumb-item active">Comments</li>
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

                        <th style="width: 20%">User</th>
                        <th style="text-align: center;width: 25%">Comment Body</th>
                        <th style="text-align: center;width: 20%">Comment photo</th>
                        <th style="text-align: center;width: 20%">Comment video</th>
                        <th style="text-align: center;width: 5%">PostId</th>
                        <th style="text-align: center;width: 5%">Likes</th>
                        <th style="text-align: center;width: 5%">Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)

                        <tr>
                            <td style="width: 20%">
                                <div class="d-flex align-items-center">
                                    <img
                                        @if($comment->users->photo == null)
                                            src="{{asset('assets/images/no_user.png')}}" class="testimonial-img" alt=""
                                        @else
                                            src="{{asset('img/'.$comment->users->photo)}}" class="testimonial-img" alt=""
                                        @endif
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

                            <td style="text-align: center;width: 25%">
                                <p class="fw-normal mb-1">{{$comment->commentBody}}</p>
                            </td>
                            <td style="text-align: center;width: 20%">
                                <img style="width: 20%"
                                     @if($comment->photo == null)
                                         src="{{asset('assets/images/no_photo.png')}}" class="testimonial-img" alt=""
                                     @else
                                         src="{{asset('img/'.$comment->photo)}}" class="testimonial-img" alt=""
                                    @endif
                                >
                            </td>
                            <td  style="text-align: center;width: 20%">
                                @if($comment->video == null)
                                    <img style="width: 15%" src="{{asset('assets/images/no_video.png')}}" class="testimonial-img" alt="">
                                @else
                                    <video width="20%" height="20%" controls>
                                        <source src="{{asset('img/'.$comment->video)}}" type="video/mp4">
                                    </video>
                                @endif
                            </td>

                            <td style="text-align: center;width: 5%">
                                <p class="fw-normal mb-1">{{$comment->postId}}</p>

                            </td>

                            <td style="text-align: center;width: 5%">
                                <p class="fw-normal mb-1">{{$comment->likes}}</p>

                            </td>
                            <td style="text-align: center;width: 5%">
                                <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"class="btn btn-danger"><i class="fa-light fa-trash fa-beat"></i></button>
                                </form>
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
