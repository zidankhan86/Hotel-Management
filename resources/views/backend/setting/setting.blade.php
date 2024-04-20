@section('content')
@extends('backend.index')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<br><div class="row">
    <div class="col-lg-4"> 
        <div class="card" style="margin-left: 10px">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                </div>
                <h4>Hero Setup<a href="" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" >+Add</a></h4>
                
            </div>
        </div><br><br>

        <div class="card" style="margin-left: 10px">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                </div>
                <h4>About <a href="#" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">+Add</a></h4>

            </div>
        </div><br>

    </div><br>
    <div class="col-lg-8">
      @if(session('success'))
      <div class="alert alert-success" role="alert">
          <p>{{ session('success') }}</p>
      </div>
      @endif
        <div class="card">
            <div class="card">
                <div class="card-body">
                  <div style="width: 200px;  ">
                    <h6>Hero Table</h6>

                    @php
                    $banners = App\Models\Banner::all();
                    @endphp

                    @if($banners->isEmpty())
                        <p>No data found.</p>
                    @else

                  </div>
                  
                    <table style="width: 100%; border-collapse: collapse;">
                      <thead><br>
                        <tr>
                            <th style="padding: 8px; background-color: #0c0707; color: white;">#</th>
                            <th style="padding: 8px; background-color: #0c0b0b; color: white;">Name</th>
                            <th style="padding: 8px; background-color: #0f0d0d; color: white;">image</th>
                            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        
                      @foreach ($banners as $banner) 
                
                        <tr>
                          <td style="border: 1px solid #ddd; padding: 8px;">{{$banner->id}}</td>
                          <td style="border: 1px solid #ddd; padding: 8px;">{{$banner->tittle}}</td>
                          <td style="border: 1px solid #ddd; padding: 8px;">
                            <img height="50px" width="50px" src="{{url('/uploads/'.$banner->image)}}" alt="banner">
                        </td>
                          <td style="border: 1px solid #ddd; padding: 8px;">
                         
                          <a href="{{route('banner.delete',$banner->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          
                          </td>
                        </tr>
                  
                     @endforeach
                     
                      </tbody>
                      
                    </table>
                 
                </body>
              
                 @endif 
                {{--Modal --}}
                
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Hero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                            @method('post')
                            @csrf
                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <label for="recipient-name" class="col-form-label">Hero Title*</label>
                              <input type="text" class="form-control" id="recipient-name" name="tittle" required placeholder="Sea Paradise">
                            </div>

                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Description</label>
                              <textarea class="form-control" id="message-text" name="description" placeholder="Write long title here"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Choose an image*</label>
                               <input type="file" name="image" id="" class="form-control dropify">
                              </div>
                              
                
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
                
                <script>
                var exampleModal = document.getElementById('exampleModal')
                exampleModal.addEventListener('show.bs.modal', function (event) {
                  var button = event.relatedTarget
                  var recipient = button.getAttribute('data-bs-whatever')
                  var modalTitle = exampleModal.querySelector('.modal-title')
                  var modalBodyInput = exampleModal.querySelector('.modal-body input')
                  modalTitle.textContent = 'Add Facilities' 
                })
                </script>
                </div>
              </div>
        </div>
    </div>
<div><br>
    <div class="col-lg-12">
        <div class="card">
            <div class="card">
                <div class="card-body">
                  <div style="width: 200px;  ">
                    <h6>About Table</h6>
                  </div>
                  @php
                  $about = App\Models\About::simplePaginate(1);
                  @endphp

                  @if($about->isEmpty())
                      <p>No data found.</p>
                  @else
                  
                    <table style="width: 100%; border-collapse: collapse;">
                        
                      <thead><br>
                        <tr>
                            <th style="padding: 8px; background-color: #0c0707; color: white;">#</th>
                            <th style="padding: 8px; background-color: #0c0b0b; color: white;">Name</th>
                            <th style="padding: 8px; background-color: #0f0d0d; color: white;">Description</th>
                            <th style="padding: 8px; background-color: #0f0d0d; color: white;">Image</th>
                            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                     @foreach ($about as $about) 
                
                        <tr>
                          <td style="border: 1px solid #ddd; padding: 8px;">{{$about->id}}</td>
                          <td style="border: 1px solid #ddd; padding: 8px;">{{$about->tittle}}</td>
                          <td style="border: 1px solid #ddd; padding: 8px;">{{$about->description}}</td>
                          <td style="border: 1px solid #ddd; padding: 8px;"><img height="50px" width="50px" src="{{url('/uploads/'.$about->image)}}" alt="about"></td>
                          <td style="border: 1px solid #ddd; padding: 8px;">
                            
                          <a href="{{route('about.delete',$about->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          
                          </td>
                        </tr>
                  
                      @endforeach 
                      </tbody>
                    </table>
                  @endif
                </body>
                
                {{--Modal --}}
                
                <div class="modal" id="myModal" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">About Form</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('about.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <label for="title" class="form-label">Title</label>
                              <input type="text" class="form-control" id="title" name="tittle" placeholder="Title">
                            </div>
                        
                            <div class="mb-3">
                              <label for="content" class="form-label">Content</label>
                              <textarea class="form-control" id="content" name="description" placeholder="write something..."></textarea>
                            </div>

                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Choose an image*</label>
                             <input type="file" name="image" id="" class="form-control dropifys">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                
                <script>
                    var myModal = document.getElementById('myModal');
                    var myInput = document.getElementById('title');
                    
                    myModal.addEventListener('shown.bs.modal', function () {
                      myInput.focus();
                    });
                    </script>
                    

                </div>
              </div>
        </div>
    </div>
</div>

</div>


<script>
    $('.dropify').dropify({ messages: {
    'default': 'Hero Image', 'replace': 'Drag and drop or click to replace', 'remove': 'Remove',
    'error':	'Ooops, something wrong happended.'
    }
    });
</script>
<script>
  $('.dropifys').dropify({ messages: {
  'default': 'About Image', 'replace': 'Drag and drop or click to replace', 'remove': 'Remove',
  'error':	'Ooops, something wrong happended.'
  }
  });
</script>
@endsection
