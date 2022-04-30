@extends('layouts.user.modalform')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
         <div class="card-header">
            <h5>Basic Modal</h5>
         </div>
         <div class="card-body btn-showcase">
            <!-- Simple demo-->
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Simple</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">...</div>
                     <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-secondary" type="button">Save changes</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Vertically centered modal-->
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Vertically centered</button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                      <button class="btn btn-primary" type="button">Save changes</button>
                    </div>
                </div>
              </div>
            </div>
         </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Select-2</h5>
        </div>
        <div class="card-body o-hidden">
          <div class="mb-2">
            <div class="col-form-label">Default Placeholder</div>
            <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple">
              <option value="AL">Alabama</option>
              <option value="WY">Wyoming</option>
              <option value="WY">Coming</option>
              <option value="WY">Hanry Die</option>
              <option value="WY">John Doe</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection