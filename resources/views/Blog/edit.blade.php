@extends('layouts/contentNavbarLayout')

@section('title', 'ویرایش بلاگ')
@section('header')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
@endsection
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{route('blogs.BlogsInfo')}}">بلاگ ها</a> /</span> ویرایش </h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">ویرایش</h5> <small class="text-muted float-end"><a href="{{route('blogs.BlogsInfo')}}">بازگشت</a></small>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="container">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if(@\Illuminate\Support\Facades\Session::has('fails'))
                        @include('share.messages.error')
                    @endif

                    @if(@\Illuminate\Support\Facades\Session::has('success'))
                        @include('share.messages.success')
                    @endif

                    <form action="{{route('blogs.update',['id'=>$blog->id])}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-md-2 col-form-label" for="basic-default-name">عکس</label>
                            <div class="col-sm-10 col-md-7">
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <img src="{{asset("storage/".$blog->image)}}" class="col-sm-2 col-md-2" width="150px" height="150px">
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">عنوان</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="عنوان" value="{{$blog->subject}}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">دسته بندی</label>
                            <div class="col-sm-10">
                                <select name="categoryId" class="form-control">
                                        <x-categories-s-o :categories="$categories" :parentId="$blog->category_id" />
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">خدمت</label>
                            <div class="col-sm-10">
                                <select name="serviceId" class="form-control">
                                    <option value="">خدمت را انتخاب کنید...</option>
                                    @foreach($services as $service)
                                        @if($blog->service_id && $blog->service_id == $service->id)
                                            <option value="{{$service->id}}" selected>{{$service->name}}</option>
                                        @else
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">توضیحات</label>
                            <div class="col-sm-10">
                                <textarea id="context" name="description"
                                          placeholder="توضیحات"
                                          aria-label="توضیحات"
                                          aria-describedby="basic-icon-default-message2"
                                >{{$blog->description}}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">برچسب ها</label>
                            <div class="col-sm-10">
                                <select name="tagsList[]" class="form-control" multiple="multiple">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" {{in_array($tag->id,$weblogTags) ? "selected" : "null"}}>{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

{{--                        weblogTags--}}

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Basic with Icons -->
    </div>

    <script>


        ClassicEditor
            .create(document.querySelector('#context'))


        ClassicEditor
            .create(document.querySelector('#short_text'))
    </script>
@endsection
