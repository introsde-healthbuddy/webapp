@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Goals</h2>

            <span style="float:right; padding-top:10px;">
            	<a href="{{ action('GoalController@create') }}" class="btn btn-space btn-primary btn-lg"> Create Goal &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
            </span>



            @include('partials.quote')
	</div>
</div>

<div class="row">

    <div class="col-sm-12">
      <div class="panel panel-default panel-table be-custom-panel">

        <div class="panel-body">

          @include('partials.errors')

          <?php if($goals){ ?>

          <div class="table-responsive noSwipe">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:40%;">Goal</th>
                  <th style="width:15%;">Type</th>
                  <th style="width:10%;">Deadline</th>
                  <th style="width:10%;">Completed</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($goals as $goal)

                <tr>
                  <td class="cell-detail"><span>{{ $goal->name }}</span></td>
                  <td class="cell-detail"> <span>{{ $goal->type }}</span></td>
                  <td class="cell-detail"><span>{{ $goal->deadline}}</span></td>
                  <td class="cell-detail"><span><?php if($goal->is_completed){ echo 'Yes';}else{echo 'No';} ?></span></td>
                  <td class="text-right">
                    <div class="btn-group btn-hspace">
                      <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Manage <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                      <ul role="menu" class="dropdown-menu pull-right">
                        <li><a href="{{action('GoalController@edit', $goal->id)}}">Edit</a></li>
                        <li>
<form action="{{action('GoalController@destroy', $goal->id)}}" method="POST" style="display:inline-block;">
          {!! csrf_field() !!}
          {{ method_field('DELETE') }}

          <input type="submit" style="background: white;
    border: 0;
    padding: 5px 0 0 20px;" value="Delete">
        </form>


                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>

                @endforeach



              </tbody>
            </table>
          </div>

          <?php }
                else{ ?>



               <?php } ?>
        </div>
      </div>
    </div>
</div>




@stop
