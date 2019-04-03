<!-- Modal -->
<div class="modal modal__invite fade" id="invite-to-group" tabindex="-1" role="dialog" aria-labelledby="inviteToGroupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-between">
        <h5 id="inviteToGroupLabel">@lang('groups.invite_group_header_link')</h5>
        <a data-toggle="collapse" href="#groupShareableLink" role="button" aria-expanded="false" aria-controls="groupShareableLink" class="align-items-center text-dark"><svg width="13" height="13" viewBox="0 0 580 680" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
          <g transform="matrix(1.17734,0,0,1.1784,3.63384,3.37368)">
            <path d="M453.323,39.655L436.759,24.999C418.729,9.021 395.521,0.22 371.405,0.22C343.182,0.22 316.287,12.299 297.614,33.363L250.207,86.86C244.102,93.736 241.043,102.582 241.599,111.761C242.156,120.927 246.241,129.337 253.117,135.434L257.555,139.374C263.854,144.968 271.971,148.047 280.397,148.047L282.451,147.988C291.617,147.437 300.033,143.351 306.15,136.465L353.568,82.962C361.91,73.546 377.737,72.6 387.169,80.936L403.727,95.624C408.475,99.827 411.297,105.645 411.682,112.008C412.068,118.366 409.96,124.473 405.745,129.216L302.042,246.198C295.06,254.085 282.665,256.362 273.308,251.54C266.774,248.17 260.063,239.682 252.887,240.549C244.054,241.617 234.882,253.072 228.916,259.796L228.103,260.722C220.53,269.24 217.376,280.56 219.429,291.826C221.503,303.024 228.476,312.627 238.582,317.916C252.568,325.227 268.345,329.246 284.203,329.246L284.215,329.246C312.425,329.246 339.332,317.008 358.015,295.938L461.706,178.892C497.746,138.226 494.004,75.731 453.323,39.655Z" style="fill:rgb(102,107,108);fill-rule:nonzero;"/>
            <path d="M228.873,347.458C215.204,335.355 192.447,336.715 180.299,350.396L132.903,403.883C124.561,413.295 108.744,414.27 99.323,405.926L82.747,391.221C78,387.014 75.177,381.196 74.792,374.838C74.405,368.49 76.514,362.385 80.727,357.642L184.419,240.668C191.295,232.903 203.466,230.557 212.716,235.102C220.904,239.135 228.433,243.282 237.184,241.053C244.593,239.165 253.406,231.754 258.766,225.686C262.642,221.319 271.586,211.626 273.007,206.176C274.31,201.175 275.531,193.343 272.372,189.702C266.544,179.571 258.605,174.834 248.734,169.557C234.533,161.953 218.46,157.933 202.268,157.933C174.045,157.933 147.15,170.017 128.477,191.084L24.772,308.038C-11.29,348.704 -7.536,411.12 33.133,447.181L49.697,461.663C67.718,477.642 90.926,486.245 115.042,486.245L115.053,486.245C143.276,486.245 170.182,474.356 188.865,453.288L236.253,399.909C242.369,393.022 245.429,384.218 244.871,375.09C244.338,366.022 240.135,357.396 233.333,351.384L228.873,347.458Z" style="fill:rgb(102,107,108);fill-rule:nonzero;"/>
          </g>
        </svg>
        @lang('groups.shareable_link')</a>
      </div>

      <div class="modal-body">
        <form action="/group/invite" method="post">
          @csrf
          <input type="hidden" name="group_name" value="{{ $group->name }}">
          <input type="hidden" id="group_id" name="group_id" value="{{ $group->idgroups }}">

          <div id="invite_div" class="form-group">
            <label for="manual_invite_box">@lang('groups.email_addresses_field'):</label>
            <input type="text" id="manual_invite_box" name="manual_invite_box" class="tokenfield form-control" autocomplete="off">
          </div>
          <small class="after-offset">@lang('groups.type_email_addresses_message')</small>

          <div class="form-group">
            <label for="message_to_restarters">@lang('groups.message_header'):</label>
            <textarea name="message_to_restarters" id="message_to_restarters" class="form-control field" placeholder="@lang('groups.message_example_text')" rows="3"></textarea>
          </div>

          <div class="collapse" id="groupShareableLink">
            <div id="shareable_link_div" class="form-group">
              <label for="shareable_link_box">@lang('groups.shareable_link_box'):</label>
              <input type="text" id="shareable_link_box" name="shareable_link_box" class="form-control" autocomplete="off" value="{{ $group->shareable_link }}">
            </div>
            <small class="after-offset">@lang('groups.type_shareable_link_message')</small>
          </div>

          <div class="d-flex flex-row justify-content-between align-items-center">
            <a href="#" class="text-dark mb-0" data-dismiss="modal">@lang('groups.cancel_invites_link')</a>
            <button disabled type="submit" class="btn btn-primarym-0">@lang('groups.send_invite_button')</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
