@section('content')
@extends('backend.index')

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<div style="width: 200px;  padding: 10px; margin: 10px;">
    <h4>Rooms</h4>
    
  </div>
<div style="width: 1100px; border: 1px solid #ccc;  box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 20px; margin: 20px;">
  @if(session('success'))
  <div class="alert alert-success" role="alert">
      <p>{{ session('success') }}</p>
  </div>
  @endif
    <a href="" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" >+Add</a><br>
    <table style="width: 100%; border-collapse: collapse;">
      <thead><br>
        <tr>
            <th style="padding: 8px; background-color: #0c0707; color: white;">#</th>
            <th style="padding: 8px; background-color: #0c0b0b; color: white;">Name</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Image</th>
            <th style="padding: 8px; background-color: #0f0d0d; color: white;">Area</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Price</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Quantity</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Status</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Action</th>
        </tr>
      </thead>
      <tbody>
@foreach ($rooms as $room)

        <tr>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->id}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->category_name}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">
            <img height="50px" width="50px" src="{{url('/storage/uploads/'.$room->image)}}" alt="Room">
            </td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->area}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->price}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->quantity}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;">{{$room->status == 1 ? 'Active':'Inactive'}}</td>
          <td style="border: 1px solid #ddd; padding: 8px;"><a href="#" data-bs-toggle="modal" data-bs-target="#editModal{{$room->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
          
            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-trash"></i></a>
          </td>
          
        </tr>
  
@endforeach

      </tbody>
    </table>
    <p>{{$rooms->links()}}</p>
  </div>
</body>
  
{{--Modal --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 60%; width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('room.store')}}" method="POST" enctype="multipart/form-data">
          @method('post')
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Category Name</label>
              <input type="text" class="form-control" id="recipient-name" name="category_name" placeholder="Deluxe">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Area</label>
              <input type="text" class="form-control" id="recipient-name" name="area" placeholder="500 sqft">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Price</label>
              <input type="number" class="form-control" id="recipient-name" name="price" placeholder="5000">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Quantity of Rooms</label>
              <input type="number" class="form-control" id="recipient-name" name="quantity" placeholder="10">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Adult(Max.)</label>
              <input type="number" class="form-control" name="adult" id="recipient-name" placeholder="4">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Children(Max.)</label>
              <input type="number" class="form-control" name="children" id="recipient-name" placeholder="1">
            </div>
            <div class="col-md-12 mb-3">
              <label for="recipient-name" class="col-form-label">Status</label>
              <select name="status" id="" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>

              </select>
            </div>
          </div>

         <div style="margin-bottom: 10px;">
        <label for="featuresCheckbox" style="display: inline-block; margin-right: 10px;">Features</label><br>
        <div style="display: inline-block;">
          @foreach ($features as $feature)
          <input type="hidden" value="{{ $feature->name }}" name="names[{{ $loop->index }}]">
          <input type="checkbox" id="feature_{{ $feature->id }}" name="features_id[]" value="{{ $feature->id }}">
          <label for="feature_{{ $feature->id }}" style="margin-right: 20px;">{{ $feature->name }}</label>
          
          @endforeach
        </div>
       </div>
       
       

      <div style="margin-bottom: 10px;">
        <label for="facilitiesCheckbox" style="display: inline-block; margin-right: 10px;">Facilities</label><br>
        <div style="display: inline-block;">
            @foreach ($facilities as $facility)
                <input type="hidden" value="{{ $facility->name }}" name="names[{{ $loop->index }}]">
                <input type="checkbox" id="facility_{{ $facility->id }}" name="facilities_id[]" value="{{ $facility->id }}">
                <label for="facility_{{ $facility->id }}" style="margin-right: 20px;">{{ $facility->name }}</label>
            @endforeach
        </div>
    </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea class="form-control" id="message-text" name="description" placeholder="Write about room...."></textarea>
          </div>

          <div>
            <label for="">Choose an Image</label>
            <input type="file" class="dropify" name="image">
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

<!-- Edit Modal -->
@foreach ($rooms as $room)
    <div class="modal fade" id="editModal{{$room->id}}" tabindex="-1" aria-labelledby="editModal{{$room->id}}Label" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 60%; width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{$room->id}}Label">Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_category_name" class="col-form-label">Category Name</label>
                                <input type="text" class="form-control" id="edit_category_name" name="category_name" value="{{$room->category_name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_area" class="col-form-label">Area</label>
                                <input type="text" class="form-control" id="edit_area" name="area" value="{{$room->area}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_price" class="col-form-label">Price</label>
                                <input type="number" class="form-control" id="edit_price" name="price" value="{{$room->price}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_quantity" class="col-form-label">Quantity of Rooms</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity" value="{{$room->quantity}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_adult" class="col-form-label">Adult(Max.)</label>
                                <input type="number" class="form-control" id="edit_adult" name="adult" value="{{$room->adult}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_children" class="col-form-label">Children(Max.)</label>
                                <input type="number" class="form-control" id="edit_children" name="children" value="{{$room->children}}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="edit_status" class="col-form-label">Status</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="1" {{$room->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$room->status == 0 ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- Add other form fields as needed -->

                        <div style="margin-bottom: 10px;">
                            <label for="edit_featuresCheckbox" style="display: inline-block; margin-right: 10px;">Features</label><br>
                            <div style="display: inline-block;">
                                @foreach ($features as $feature)
                                    <input type="hidden" value="{{ $feature->name }}" name="names[{{ $loop->index }}]">
                                    <input type="checkbox" id="edit_feature_{{ $feature->id }}" name="features_id[]" value="{{ $feature->id }}">
                                    <label for="edit_feature_{{ $feature->id }}" style="margin-right: 20px;">{{ $feature->name }}</label>
                                @endforeach
                            </div>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <label for="edit_facilitiesCheckbox" style="display: inline-block; margin-right: 10px;">Facilities</label><br>
                            <div style="display: inline-block;">
                                @foreach ($facilities as $facility)
                                    <input type="hidden" value="{{ $facility->name }}" name="names[{{ $loop->index }}]">
                                    <input type="checkbox" id="edit_facility_{{ $facility->id }}" name="facilities_id[]" value="{{ $facility->id }}">
                                    <label for="edit_facility_{{ $facility->id }}" style="margin-right: 20px;">{{ $facility->name }}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" placeholder="Write about room....">{{$room->description}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit_image" class="col-form-label">Choose New Image</label>
                            <input type="file" class="dropify" data-default-file="{{url('/storage/uploads/'.$room->image)}}" name="image">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


    <script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget
      var recipient = button.getAttribute('data-bs-whatever')
      var modalTitle = exampleModal.querySelector('.modal-title')
      var modalBodyInput = exampleModal.querySelector('.modal-body input')
      modalTitle.textContent = 'Add Room' 
    })
    </script>

    <script>
      $('.dropify').dropify({ messages: {
      'default': 'Hotel Image', 'replace': 'Drag and drop or click to replace', 'remove': 'Remove',
      'error':	'Ooops, something wrong happended.'
      }
      });
    </script>


    <script>
      const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
    })
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="myModal">Warning</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-danger">Sorry , You can not delete room!!</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
           
          </div>
        </div>
      </div>
    </div>
@endsection
