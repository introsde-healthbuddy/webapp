<div class="be-left-sidebar">
  <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menu</a>
    <div class="left-sidebar-spacer">
      <div class="left-sidebar-scroll">
        <div class="left-sidebar-content">
          <ul class="sidebar-elements">
            <li class="divider"></li>
           
            </li>
            <li class={{ Request::is('health-monitor') ? 'active' : null }}><a href="{{action('HealthMonitorController@index')}}"><i class="icon mdi mdi-chart"></i><span>Health Monitor</span></a></li>
            <li class={{ Request::is('nutrition') ? 'active' : null }}><a href="{{action('NutritionController@index')}}"><i class="icon mdi mdi-chart-donut"></i><span>Nutrition</span></a></li>
            <li class={{ Request::is('activities') ? 'active' : null }}><a href="{{action('ActivityController@index')}}"><i class="icon mdi mdi-border-all"></i><span>Activites</span></a></li>
            <li class={{ Request::is('goals') ? 'active' : null }}><a href="{{action('GoalController@index')}}"><i class="icon mdi mdi-dot-circle"></i><span>Goals</span></a></li>
           <!-- <li class={{ Request::is('settings') ? 'active' : null }}><a href="{{action('SettingsController@index')}}"><i class="icon mdi mdi-settings"></i><span>Settings</span></a></li>-->

          </ul>
        </div>
      </div>
    </div>

  </div>
</div>