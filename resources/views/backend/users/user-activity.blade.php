@if(sizeof($userActivity)>0)
    @foreach ($userActivity as $activity)
        {{--initialize varaibles --}}
        <?php
        $activityType = $activity->activity_type;
        $activityModule = $activity->activity_module;
        $activityIcon = \App\Models\Roles\Menu::find($activity->activity_module);
        ?>
        {{-- li lsit start--}}


        <li class="attachment-block clearfix">
            <div
                    class="product-img @if($activityType == 1 || $activityType == 3 ) bg-blue
                @elseif($activityType == 2 || $activityType == 5 || $activityType == 7 || $activityType == 7 || $activityType == 8
                || $activityType == 9 || $activityType == 10) bg-green
                @elseif($activityType == 4 || $activityType == 6 ) bg-red
                @endif
                            " style="margin-left: 10px">

                <span style="margin:0 4px 0 4px;">  <i class="{!! $activityIcon->menu_icon !!}"></i></span>
            </div>
            <div class="product-info">
                {{Auth::user()->id == $activity->activity_user_id?'You':$user->full_name}}
                {{activityMessage($activityType)}}
                <?php
                if ($activityModule == 3) {
                    $url = 'roles/type';
                    $value = \App\Models\Roles\UserType::find($activity->activity_id);
                    $valueName = $value->type_name;
                    $type = 'user type';

                } elseif ($activityModule == 6) {
                    $url = 'users';
                    $value = \App\Models\User::find($activity->activity_id);
                    $valueName = $value->full_name;
                    $type = 'user';

                }
                ?>

                <a href="{{url($url)}}" data-toggle="tooltip" title="Click here for details"
                   class="product-title">@if($activityType != 9 && $activityType != 10){{$valueName}} @endif
                </a>
                <span class="badge badge-secondary float-right">
                        <i class="far fa-clock"></i> &nbsp;
                         {{ \Carbon\Carbon::parse($activity->activity_date)->diffForHumans() }}
                            </span>
                @if($activityType != 9 && $activityType != 10){{$type}} @endif
            </div>
        </li>
        {{-- li lsit end--}}

    @endforeach
    @if(isset($page_link))
        <span class="pull-right">{{ $userActivity->links() }}</span>
    @endif
@else
    <div class="col-md-12" style="padding-top: 10px">
        <label class="form-control badge badge-info"
               style="text-align:  center; font-size: 18px;">
            <i class="fas fa-ban"></i> No activities found yet !.
        </label>
    </div>


@endif
