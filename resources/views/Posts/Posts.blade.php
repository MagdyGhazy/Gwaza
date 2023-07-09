@extends('layouts.master')
@section('css')

@section('title')
    Posts
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Posts</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Posts</li>
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
                        <th style="width: 25%">Post Body</th>
                        <th style="width: 20%">Post photo</th>
                        <th style="width: 20%">Post video</th>
                        <th style="width: 5%">Comments</th>
                        <th style="width: 5%">Likes</th>
                        <th style="width: 5%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)

                            <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img
                                    @if($post->users->photo == null)
                                        src="{{asset('assets/images/no_user.png')}}" class="testimonial-img" alt=""
                                    @else
                                        src="{{asset('img/'.$post->users->photo)}}" class="testimonial-img" alt=""
                                    @endif
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{$post->users->name}}</p>
                                    <p class="text-muted mb-0">{{$post->users->email}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{$post->postBody}}</p>
                        </td>
                        <td>
                            <img style="width: 20%"
                                 @if($post->photo == null)
                                     src="{{asset('assets/images/no_photo.png')}}" class="testimonial-img" alt=""
                                 @else
                                     src="{{asset('img/'.$post->photo)}}" class="testimonial-img" alt=""
                                @endif
                            >
                        </td>
                        <td>
                            @if($post->video == null)
                                <img style="width: 15%" src="{{asset('assets/images/no_video.png')}}" class="testimonial-img" alt="">
                            @else
                                <video width="20%" height="20%" controls>
                                    <source src="{{asset('img/'.$post->video)}}" type="video/mp4">
                                </video>
                            @endif
                        </td>


                        <td style="text-align: center">
                            <p class="fw-normal mb-1">{{count($post->comments)}}</p>

                        </td>

                        <td style="text-align: center">
                            <p class="fw-normal mb-1">{{$post->likes}}</p>

                        </td>
                        <td style="text-align: center">
                            <form action="{{route('posts.destroy',$post->id)}}" method="post">
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
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
