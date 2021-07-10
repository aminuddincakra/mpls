@extends('layouts.siswa')

@section('content')
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard          
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>          
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">        
        @if(isset($pengumuman))
          <div id="modal-pengumuman" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                  <input type="hidden" name="_method" value="DELETE">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">{{ $pengumuman->title }}</h4>
                  </div>
                  <div class="modal-body">
                      {!! $pengumuman->title !!}
                  </div>
                  <div class="modal-footer">
                      <a href="#" class="btn btn-default" data-dismiss="modal">Tutup</a>
                  </div>        
              </div>
            </div>
          </div>
        @endif
        <div class="container">
          <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step col-xs-3"> 
                      <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                      <p><small>Shipper</small></p>
                  </div>
                  <div class="stepwizard-step col-xs-3"> 
                      <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                      <p><small>Destination</small></p>
                  </div>
                  <div class="stepwizard-step col-xs-3"> 
                      <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                      <p><small>Schedule</small></p>
                  </div>
                  <div class="stepwizard-step col-xs-3"> 
                      <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                      <p><small>Cargo</small></p>
                  </div>
              </div>
          </div>
          
          <form role="form">
              <div class="panel panel-primary setup-content" id="step-1">
                  <div class="panel-heading">
                       <h3 class="panel-title">Shipper</h3>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <label class="control-label">First Name</label>
                          <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" />
                      </div>
                      <div class="form-group">
                          <label class="control-label">Last Name</label>
                          <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" />
                      </div>
                      <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                  </div>
              </div>
              
              <div class="panel panel-primary setup-content" id="step-2">
                  <div class="panel-heading">
                       <h3 class="panel-title">Destination</h3>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <label class="control-label">Company Name</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                      </div>
                      <div class="form-group">
                          <label class="control-label">Company Address</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                      </div>
                      <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                  </div>
              </div>
              
              <div class="panel panel-primary setup-content" id="step-3">
                  <div class="panel-heading">
                       <h3 class="panel-title">Schedule</h3>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <label class="control-label">Company Name</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                      </div>
                      <div class="form-group">
                          <label class="control-label">Company Address</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                      </div>
                      <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                  </div>
              </div>
              
              <div class="panel panel-primary setup-content" id="step-4">
                  <div class="panel-heading">
                       <h3 class="panel-title">Cargo</h3>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <label class="control-label">Company Name</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                      </div>
                      <div class="form-group">
                          <label class="control-label">Company Address</label>
                          <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                      </div>
                      <button class="btn btn-success pull-right" type="submit">Finish!</button>
                  </div>
              </div>
          </form>
      </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
@endsection
