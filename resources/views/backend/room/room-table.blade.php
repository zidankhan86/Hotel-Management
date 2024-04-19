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
    <a href="" style="float: right;" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" >+Add</a><br>
    <table style="width: 100%; border-collapse: collapse;">
      <thead><br>
        <tr>
            <th style="padding: 8px; background-color: #0c0707; color: white;">#</th>
            <th style="padding: 8px; background-color: #0c0b0b; color: white;">Name</th>
            <th style="padding: 8px; background-color: #0f0d0d; color: white;">Area</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Price</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Quantity</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Status</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border: 1px solid #ddd; padding: 8px;">1</td>
          <td style="border: 1px solid #ddd; padding: 8px;">Mark</td>
          <td style="border: 1px solid #ddd; padding: 8px;">Otto</td>
          <td style="border: 1px solid #ddd; padding: 8px;">@mdo</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
  
{{--Modal --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
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
              <input type="text" class="form-control" id="recipient-name" name="category_name">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Area</label>
              <input type="text" class="form-control" id="recipient-name" name="area">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Price</label>
              <input type="number" class="form-control" id="recipient-name" name="price">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Quantity of Rooms</label>
              <input type="number" class="form-control" id="recipient-name" name="quantity">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Adult(Max.)</label>
              <input type="text" class="form-control" name="adult" id="recipient-name">
            </div>
            <div class="col-md-6 mb-3">
              <label for="recipient-name" class="col-form-label">Children(Max.)</label>
              <input type="text" class="form-control" name="children" id="recipient-name">
            </div>
          </div>

         <div style="margin-bottom: 10px;">
        <label for="featuresCheckbox" style="display: inline-block; margin-right: 10px;">Features</label><br>
        <div style="display: inline-block;">
          @foreach ($features as $feature)
          <input type="checkbox" id="feature_{{ $feature->id }}" name="features_id[]" value="{{ $feature->id }}">
          <label for="feature_{{ $feature->id }}" style="margin-right: 20px;">{{ $feature->name }}</label>
          @endforeach
        </div>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="facilitiesCheckbox" style="display: inline-block; margin-right: 10px;">Facilities</label><br>
        <div style="display: inline-block;">
            @foreach ($facilities as $facility)
                <input type="checkbox" id="facility_{{ $facility->id }}" name="facilities_id[]" value="{{ $facility->id }}">
                <label for="facility_{{ $facility->id }}" style="margin-right: 20px;">{{ $facility->name }}</label>
            @endforeach
        </div>
    </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea class="form-control" id="message-text" name="description"></textarea>
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
@endsection