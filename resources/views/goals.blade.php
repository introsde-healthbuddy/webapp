@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Goals</h2>

            <span style="float:right; padding-top:10px;">
            	<a href="create-goal.php" class="btn btn-space btn-primary btn-lg"> Create Goal &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
            </span>

            

            @include('partials.quote')
	</div>
</div>

<div class="row">

    <div class="col-sm-12">
      <div class="panel panel-default panel-table be-custom-panel">
        
        <div class="panel-body">
          <div class="table-responsive noSwipe">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:5%;">
                    <div class="be-checkbox be-checkbox-sm">
                      <input id="check1" type="checkbox">
                      <label for="check1"></label>
                    </div>
                  </th>
                  <th style="width:40%;">Goal</th>
                  <th style="width:15%;">Type</th>
                  <th style="width:25%;">Milestone</th>
                  
                  <th style="width:10%;">Date</th>
                  <th style="width:10%;"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($goals as $goal)

                <tr>
                  <td>
                    <div class="be-checkbox be-checkbox-sm">
                      <input id="check2" type="checkbox">
                      <label for="check2"></label>
                    </div>
                  </td>
                  <td class="cell-detail"><span>{{ $goal->name }}</span></td>
                  <td class="cell-detail"> <span>{{ $goal->type }}</span></td>
                  <td class="milestone">
                    <div class="progress">
                      <div style="width: 45%" class="progress-bar progress-bar-primary"></div>
                    </div>
                  </td>
                 
                  <td class="cell-detail"><span>May 6, 2016</span></td>
                  <td class="text-right">
                    <div class="btn-group btn-hspace">
                      <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Manage <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                      <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                    
                @endforeach
                
                
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>




@stop

