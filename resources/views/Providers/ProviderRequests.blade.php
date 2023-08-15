@extends('layouts.master')
@section('css')

@section('title')
    Provider Requests
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> Provider Requests</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Provider Requests</li>
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
                            <th style="width: 15%;text-align: center">User</th>
                            <th style="width: 13%;text-align: center">id number</th>
                            <th style="width: 15%;text-align: center">id photo front</th>
                            <th style="width: 15%;text-align: center">id photo back</th>
                            <th style="width: 15%;text-align: center">criminal fish</th>
                            <th style="width: 15%;text-align: center">provider type</th>
                            <th style="width: 12%;text-align: center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)

                            <tr>
                                <td style="width: 15%">
                                    <div class="d-flex align-items-center">
                                        <a href="{{asset('img/'.$request->users->photo)}}">
                                            <img
                                                @if($request->users->photo == null)
                                                    src="{{asset('assets/images/no_user.png')}}" class="testimonial-img" alt=""
                                                @else
                                                    src="{{asset('img/'.$request->users->photo)}}" class="testimonial-img" alt=""
                                                @endif
                                                alt=""
                                                style="width: 50%;height: 50%"
                                                class="rounded-circle"
                                            />
                                        </a>
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$request->users->first_name}} {{$request->users->mid_name}} {{$request->users->last_name}}</p>
                                        </div>
                                    </div>
                                </td>




                                <td style="width: 13%; text-align: center">
                                    <p class="fw-normal mb-1">{{$request->id_number}}</p>
                                </td>


                                <td style="width: 15%; text-align: center">
                                    <a href="{{asset('img/'.$request->id_photo_front)}}">
                                        <img style="width: 50%"
                                             @if($request->photo == null)
                                                 src="{{asset('assets/images/no_photo.png')}}" class="testimonial-img" alt=""
                                             @else
                                                 src="{{asset('img/'.$request->id_photo_front)}}" class="testimonial-img" alt=""
                                            @endif
                                        >
                                    </a>
                                </td>


                                <td style="width: 15%; text-align: center">
                                    <a href="{{asset('img/'.$request->id_photo_back)}}">
                                        <img style="width: 50%"
                                             @if($request->id_photo_back == null)
                                                 src="{{asset('assets/images/no_photo.png')}}" class="testimonial-img" alt=""
                                             @else
                                                 src="{{asset('img/'.$request->id_photo_back)}}" class="testimonial-img" alt=""
                                            @endif
                                        >
                                    </a>
                                </td>





                                <td style="width: 15%; text-align: center">
                                    <a href="{{asset('img/'.$request->criminal_fish)}}">
                                        <img style="width: 50%"
                                             @if($request->criminal_fish == null)
                                                 src="{{asset('assets/images/no_photo.png')}}" class="testimonial-img" alt=""
                                             @else
                                                 src="{{asset('img/'.$request->criminal_fish)}}" class="testimonial-img" alt=""
                                            @endif
                                        >
                                    </a>
                                </td>

                                <td style="width: 15%; text-align: center">
                                    <p class="fw-normal mb-1">{{$request->provider_type}}</p>
                                </td>

                                <td style="text-align: center ;width: 15%">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $request }}"
                                            title="{{ trans('GradeTrans.Edit') }}"><i class="fa fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $request->id }}"
                                            title="{{ trans('GradesTrans.Delete') }}"><i
                                            class="fa fa-undo"></i>
                                    </button>

                                </td>
                            </tr>


                            <!-- delete_modal_Request -->
                            <script>
                                var msg = '{{Session::get('alert')}}';
                                var exist = '{{Session::has('alert')}}';
                                if(exist){
                                    alert(msg);
                                }
                            </script>
                            <div class="modal fade" id="delete{{ $request->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                               message to user
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('ProviderRequests.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf

                                                <input id="id" type="hidden" name="id" class="form-control"
                                                       value="{{ $request->id }}">
                                                <input id="id" type="text" name="message" class="form-control"
                                                placeholder="enter message here">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">close</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- approve_modal_Request -->

                            <div class="modal fade" id="edit{{$request}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                approve Request
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('ProviderRequests.update', 'test') }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                                {{ 'approve request'}}
                                                <input id="id" type="" name="id" class="form-control"
                                                       value="{{$request->id}}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">close</button>
                                                    <button type="submit"
                                                            class="btn btn-success">approve</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



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
