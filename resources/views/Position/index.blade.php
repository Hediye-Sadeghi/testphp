@extends('layouts/contentNavbarLayout')

@section('title', 'سمت های اجرایی')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">سمت های اجرایی /</span> لیست
    </h4>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header" style="display: flex;flex-direction: row;justify-content: space-between">
            <h5>لیست سمت های اجرایی</h5>
            <div class="align-items-center">
                <form action="{{route("positions.PositionsInfo")}}" method="get" id="searchFormSec">
                    @csrf
                    <div class="d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="search" id="searchSec" class="form-control border-0 shadow-none"
                               placeholder="جستجو..." aria-label="Search..." name="search">
                    </div>
                </form>
            </div>
            <h6 class="btn btn-primary "><a class="text-white" href="{{route("positions.create")}}">ثبت آیتم جدید</a></h6>
        </div>

        @if(@\Illuminate\Support\Facades\Session::has('fails'))
            @include('share.messages.error')
        @endif

        @if(@\Illuminate\Support\Facades\Session::has('success'))
            @include('share.messages.success')
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>نام</th>
                    <th>آخرین ویرایش</th>
                    <th> -</th>
                </tr>
                </thead>
                <tbody>

                @php
                    $counter=1;
                @endphp
                @if(count($positions))
                    @foreach($positions as $position)
                        <tr>
                            <th scope="row">{{$counter++}}</th>
                            <td>{{$position->name}}</td>
                            <td>{{convertDateToFarsi($position->updated_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('positions.edit',['id'=>$position->id])}}"><i
                                                class="bx bx-edit-alt me-2"></i> ویرایش</a>
                                        <a class="dropdown-item" href="{{route('positions.destroy',['id'=>$position->id])}}"><i
                                                class="bx bx-trash me-2"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @php
                        $message="";
                    @endphp
                    @if($search)
                        @php
                            $message="نتیجه ای یافت نشد";
                        @endphp
                    @else
                        @php
                            $message="تاکنون سمت اجرایی جدیدی ثبت نشده است";
                        @endphp
                    @endif
                    <tr>
                        <th scope="row">{{$counter++}}</th>
                        <td></td>
                        <td style="color: red;font-weight: bold;">{{$message}}</td>
                        <td></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if(!$search)
                {{ $positions->links() }}
            @endif

        </div>
    </div>
@endsection
