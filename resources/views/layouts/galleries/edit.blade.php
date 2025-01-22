@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- ---------------------
                                                                                                        start Person Info
                                                                                                    ---------------- -->
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">Edit Photo</h4>
            </div>
            <form action="/galleries/{{$gallery->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="position-relative d-block" id="display">
                                    <img src="{{ asset('storage/'.$gallery->image)}}" class="card-img-top rounded-0 d-block" id="preview" alt="...">
                                </div>
                                <input type="hidden" name="oldImage" value="{{$gallery->image}}">
                                <label class="control-label" for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control"  id="fileInput"
                                            aria-describedby="inputGroupFileAddon01" name="image" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="control-label" for="title">Title</label>
                                <input type="text" id="title" class="form-control" value="{{ $gallery->title }}" name="title">
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Select</label>
                                <select class="form-select mr-sm-2" name="category_id" id="inlineFormCustomSelect">
                                  @foreach ($categories as $category)
                                  @if ($gallery->category_id == $category->id)
                                      
                                  <option value="{{$category->id}}">{{$category->title}}</option>   
                                  @else
                                  <option value="{{$category->id}}">{{$category->title}}</option>   

                                  @endif
                                  @endforeach
                                  
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="form-actions text-end">
                        <div class="card-body border-top">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-plus me-1 fs-4"></i>
                                    Update
                                </div>
                            </button>
                            <a href="/galleries">
                            <button type="button" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                                Cancel
                            </button>
                        </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- ---------------------
                                                                                                        end Person Info
                                                                                                    ---------------- -->
    </div>
</div>

<script>
    const fileInput = document.getElementById('fileInput');
     const preview = document.getElementById('preview');
     const display = document.getElementById('display');


     fileInput.addEventListener('change', (event) => {
         const file = event.target.files[0];
         if (file) {
             const reader = new FileReader();

             reader.onload = (e) => {
                 preview.src = e.target.result;
                 preview.style.display = 'block';
                 display.classList.remove('d-none') = 'block';

             };

             reader.readAsDataURL(file);
         } else {
             preview.style.display = 'none';
             preview.src = '';
         }
     });
 </script>
@endsection