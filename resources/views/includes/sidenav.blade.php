  <aside class="main-sidebar">
      <section class="sidebar">
          <div class="user-panel">
              <div class="pull-left image">
                  <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                  @if (\Auth::guard('admin')->user())
                      @if (\Auth::guard('admin')->user()->is_super_admin == 1)
                          <p>{{ \Auth::guard('admin')->user()->name }}</p>
                      @endif
                  @elseif(\Auth::guard('centre')->user())
                      @if (\Auth::guard('centre')->user()->is_super_admin == 0 && \Auth::guard('centre')->user()->is_admin == 1)
                          <p>{{ \Auth::guard('centre')->user()->name }}</p>
                      @endif
                  @endif
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
          </div>
          <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MAIN NAVIGATION</li>

              @if (\Auth::guard('admin')->user())
                  @if (\Auth::guard('admin')->user()->is_super_admin == 1)
                      <li class="{{ Request::is('/') ? 'active' : '' }}">
                          <a href="{{ route('admin.dashboard') }}">
                              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                              {{-- <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span> --}}
                          </a>
                      </li>
                      <li class="{{ Request::is('user-manage') || Request::is('user-manage/*') ? 'active' : '' }}">
                          <a href="{{ route('admin.user-manage.index') }}">
                              <i class="fa fa-group"></i> <span>User Manage</span>
                              <!-- <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span> -->
                          </a>

                      </li>

                      <li class="{{ Request::is('role') || Request::is('role/*') ? 'active' : '' }}">
                          <a href="{{ route('admin.role.index') }}">
                              <i class="fa fa-wrench"></i> <span>Role Manage</span>
                              <!-- <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span> -->
                          </a>
                      </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            <span>Training Centre</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.centre.create') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> New Training Centre </a>
                            </li>
                            <li><a href="{{ route('admin.centre.list') }}"><i class="fa fa-th-list" aria-hidden="true"></i> Training Centre
                                    List </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-object-group" aria-hidden="true"></i>
                            <span>Batch Monitoring</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.batch.approval') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Batch Approval </a>
                            </li>
                            {{-- <li><a href="{{ route('admin.batch.trainee-list') }}"><i class="fa fa-eye-slash" aria-hidden="true"></i> Attendance Monitoring
                                    List </a>
                            </li> --}}
                        </ul>
                    </li>

                      <li class="treeview">
                          <a href="#">
                              <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                              <span>Trainee</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              {{-- <li><a href="#"><i class="fa fa-graduation-cap"></i>
                                      Student Registration </a></li> --}}
                              <li><a href="{{ route('admin.import_student.view') }}"><i class="fa fa-cloud-download"
                                          aria-hidden="true"></i> Import
                                      Trainees </a>
                              </li>
                              <li><a href="{{ route('admin.trainee.list') }}"><i class="fa fa-list"></i> Trainee
                                      List </a>
                              </li>
                          </ul>
                      </li>

                      <li class="treeview">
                          <a href="#">
                              <i class="fa fa-cogs"></i>
                              <span>Batch</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="{{ route('admin.slot.view') }}"><i class="fa fa-tasks"></i> Batch Slot
                                  </a>
                              </li>
                              {{-- <li><a href="#"><i class="fa fa-info-circle"></i> View
                                      Batch </a>
                              </li> --}}
                              {{-- <li><a href="#"><i class="fa fa-download"></i> I Card Download </a></li> --}}
                              {{-- <li><a href="#"><i class="fa fa-hand-o-right"></i> Trainer & Course Assign </a></li> --}}
                          </ul>
                      </li>

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-book"></i>
                              <span>Course</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="#"><i class="fa fa-pie-chart"></i> Create Course </a></li>
                              <li><a href="#"><i class="fa fa-low-vision"></i> view Course </a></li>
                              <li><a href="#"><i class="fa fa-laptop"></i> # </a></li>
                          </ul>
                      </li> --}}

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-briefcase"></i>
                              <span>Employee</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                          </ul>
                      </li> --}}

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-check"></i>
                              <span>Attendance monitoring</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                          </ul>
                      </li> --}}

                      <li class="{{ Request::is('/') ? 'active' : '' }}">
                          <a href="{{ route('admin.employeer.view') }}">
                              <i class="fa fa-building" aria-hidden="true"></i>
                              <span>Employer</span>
                          </a>
                      </li>

                    <li class="treeview {{ Request::is('/') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-handshake-o"></i>
                            <span>Placement</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.placement.view') }}"><i class="fa fa-quote-left" aria-hidden="true"></i> Placement Details </a></li>
                            <li><a href="{{ route('admin.student.interested') }}"><i class="fa fa-check-square" aria-hidden="true"></i>Interested Students </a></li>
                        </ul>
                    </li>

                      {{-- <li class="{{ Request::is('/') ? 'active' : '' }}">
                          <a href="{{ route('admin.placement.view') }}">
                              <i class="fa fa-handshake-o"></i>
                              <span>Placement</span>
                          </a>
                      </li> --}}

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-newspaper-o"></i>
                              <span>Certificate</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                          </ul>
                      </li> --}}

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-credit-card-alt"></i>
                              <span>Payment</span>
                              <span class="pull-right-container">
                                  <i class="fa fa-angle-left pull-right"></i>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                              <li><a href="#"><i class="fa fa-circle-o"></i> # </a></li>
                          </ul>
                      </li> --}}

                      {{-- <li class="treeview">
                          <a href="#">
                              <i class="fa fa-files-o"></i>
                              <span>Layout Options</span>
                              <span class="pull-right-container">
                                  <span class="label label-primary pull-right">4</span>
                              </span>
                          </a>
                          <ul class="treeview-menu">
                              <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top
                                      Navigation</a></li>
                              <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                              <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                              <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i>
                                      Collapsed
                                      Sidebar</a></li>
                          </ul>
                      </li> --}}
                  @endif
              @elseif (\Auth::guard('centre')->user())
                  @if (\Auth::guard('centre')->user()->is_admin == 1)
                      @if (\Auth::guard('centre')->user()->is_super_admin == 0)
                          <li class="{{ Request::is('/') ? 'active' : '' }}">
                              <a href="{{ route('centre.dashboard') }}">
                                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                              </a>
                          </li>
                          {{-- <li class="{{ Request::is('/') ? 'active' : '' }}">
                              <a href="{{route('centre.course.list')}}">
                                  <i class="fa fa-dashboard"></i> <span>Courses</span>
                              </a>
                          </li> --}}
                          <li class="{{ Request::is('/') ? 'active' : '' }}">
                              <a href="{{ route('centre.batch.list') }}">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span>Batches</span>
                              </a>
                          </li>
                          {{-- <li class="{{ Request::is('/') ? 'active' : '' }}">
                              <a href="{{ route('centre.batch.approval') }}">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span>Batch Approval</span>
                              </a>
                          </li>
                          <li class="{{ Request::is('/') ? 'active' : '' }}">
                              <a href="{{ route('centre.batch.trainee_list') }}">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span>Trainee Batch List</span>
                              </a>
                          </li> --}}
                          <li class="treeview">
                              <a href="#">
                                  <i class="fa fa-pencil-square-o"></i>
                                  <span>Regisration</span>
                                  <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                              </a>
                              <ul class="treeview-menu">
                                  <li><a href="{{ route('centre.student.view') }}"><i
                                              class="fa fa-graduation-cap"></i>Student Registration </a></li>
                                  <li><a href="{{ route('centre.student.list-view') }}"><i class="fa fa-users" aria-hidden="true"></i>Student List </a></li>
                              </ul>
                          </li>
                          <li class="treeview">
                              <a href="#">
                                  <i class="fa fa-handshake-o"></i>
                                  <span>Placement</span>
                                  <span class="pull-right-container">
                                      <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                              </a>
                              <ul class="treeview-menu">
                                  <li><a href="{{ route('centre.placement.view') }}"><i class="fa fa-quote-left" aria-hidden="true"></i> Placement Details </a></li>
                                  {{-- <li><a href="{{ route('centre.interested.student') }}"><i class="fa fa-check-square" aria-hidden="true"></i>Interested Students </a></li> --}}
                              </ul>
                          </li>
                      @endif
                  @endif
              @else
                  <p>no</p>
              @endif
          </ul>
      </section>
  </aside>
