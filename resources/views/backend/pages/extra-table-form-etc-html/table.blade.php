@section('content')
@extends('backend.index')

<div style="width: 200px;  padding: 10px; margin: 10px;">
    <h4>Rooms</h4>
  </div>
<div style="width: 1100px; border: 1px solid #ccc;  box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 20px; margin: 20px;">
    <a href="" style="float: right;" class="btn btn-dark">+Add</a><br>
    <table style="width: 100%; border-collapse: collapse;">
      <thead><br>
        <tr>
            <th style="padding: 8px; background-color: #0c0707; color: white;">#</th>
            <th style="padding: 8px; background-color: #0c0b0b; color: white;">First</th>
            <th style="padding: 8px; background-color: #0f0d0d; color: white;">Last</th>
            <th style="padding: 8px; background-color: #0e0d0d; color: white;">Handle</th>
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
  

@endsection