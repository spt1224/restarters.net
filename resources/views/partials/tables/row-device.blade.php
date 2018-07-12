<tr id="summary-{{ $device->iddevices }}">
    <td><a class="collapsed row-button" data-toggle="collapse" href="#row-{{ $device->iddevices }}" role="button" aria-expanded="false" aria-controls="row-1">
    @if( FixometerHelper::hasRole(Auth::user(), 'Administrator') || FixometerHelper::userHasEditPartyPermission($device->event, Auth::user()->id) ||  ( is_object($is_attending) && $is_attending->status == 1 ) )
      Edit
    @else
      View
    @endif
    <span class="arrow">▴</span></a></td>
    <td class="text-center">0</td>
    <td><div class="category">{{ $device->deviceCategory->name }}</div></td>
    <td><div class="brand">{{ $device->brand }}</div></td>
    <td><div class="model">{{ $device->model }}</div></td>
    <td><div class="age">{{ $device->age }}</div></td>
    <td width="300"><div class="problem">{!! str_limit($device->problem, 60, '...') !!}</div></td>
    @if ( $device->repair_status == 1 )
      <td><div class="repair_status"><span class="badge badge-success">Fixed</span></div></td>
    @elseif ( $device->repair_status == 2 )
      <td><div class="repair_status"><span class="badge badge-warning">Repairable</span></div></td>
    @elseif ( $device->repair_status == 3 )
      <td><div class="repair_status"><span class="badge badge-danger">End</span></div></td>
    @else
      <td><div class="repair_status"></div></td>
    @endif
    <?php /*
    @if ($device->more_time_needed == 1)
      <td><div class="repair_details">More time needed</div></td>
    @elseif ($device->professional_help == 1)
      <td><div class="repair_details">Professional help</div></td>
    @elseif ($device->do_it_yourself == 1)
      <td><div class="repair_details">Do it yourself</div></td>
    @else
      <td><div class="repair_details">N/A</div></td>
    @endif*/ ?>
    <td class="text-center">
      @if ($device->spare_parts == 1)
        <svg class="table-tick" width="21" height="17" viewBox="0 0 16 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;position:relative;z-index:1"><g><path d="M5.866,12.648l2.932,-2.933l-5.865,-5.866l-2.933,2.933l5.866,5.866Z" style="fill:#0394a6;"/><path d="M15.581,2.933l-2.933,-2.933l-9.715,9.715l2.933,2.933l9.715,-9.715Z" style="fill:#0394a6;"/></g></svg>
      @else
        <svg class="table-tick" style="display: none;" width="21" height="17" viewBox="0 0 16 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;position:relative;z-index:1"><g><path d="M5.866,12.648l2.932,-2.933l-5.865,-5.866l-2.933,2.933l5.866,5.866Z" style="fill:#0394a6;"/><path d="M15.581,2.933l-2.933,-2.933l-9.715,9.715l2.933,2.933l9.715,-9.715Z" style="fill:#0394a6;"/></g></svg>
      @endif
    </td>
    @if(FixometerHelper::hasRole(Auth::user(), 'Administrator') || FixometerHelper::userHasEditPartyPermission($device->event, Auth::user()->id) )
    <td><a data-device-id="{{{ $device->iddevices }}}" class="row-button delete-device" href="{{ url('/device/delete/'.$device->iddevices) }}"><svg width="15" height="15" viewBox="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><g><g opacity="0.5"><path d="M11.25,10.387l-10.387,-10.387l-0.863,0.863l10.387,10.387l0.863,-0.863Z"/><path d="M0.863,11.25l10.387,-10.387l-0.863,-0.863l-10.387,10.387l0.863,0.863Z"/></g></g></svg></a></td>
    @endif
</tr>
@if( FixometerHelper::hasRole(Auth::user(), 'Administrator') || FixometerHelper::userHasEditPartyPermission($device->event, Auth::user()->id) || ( is_object($is_attending) && $is_attending->status == 1 ) )
<tr class="collapse table-row-details" id="row-{{ $device->iddevices }}">
    <td colspan="11">
        <form id="data-{{ $device->iddevices }}" class="edit-device" data-device="{{ $device->iddevices }}" method="post" enctype="multipart/form-data">
        <table class="table">
            <tbody>
                <tr>
                  <td>
                    <label for="nested-5">Category:</label>
                    <div class="form-control form-control__select">
                        <select name="category-{{ $device->iddevices }}" id="category-{{ $device->iddevices }}" class="category select2">
                            <option value="">-- Category --</option>
                            @foreach( $clusters as $cluster )
                            <optgroup label="{{{ $cluster->name }}}">
                                @foreach( $cluster->categories as $category )
                                  @if( $device->category == $category->idcategories )
                                    <option value="{{{ $category->idcategories }}}" selected>{{{ $category->name }}}</option>
                                  @else
                                    <option value="{{{ $category->idcategories }}}">{{{ $category->name }}}</option>
                                  @endif
                                @endforeach
                            </optgroup>
                            @endforeach
                            @if( $device->category == 46 )
                              <option value="46" selected>None of the above</option>
                            @else
                              <option value="46">None of the above</option>
                            @endif
                        </select>
                    </div>
                    @if( $device->category == 46 )
                      <div id="display-weight">
                          <div class="input-group">
                              <input type="number" class="form-control field weight" name="weight" min="0.01" step=".01" placeholder="Est. weight" autocomplete="off" value="{{ $device->estimate }}">
                              <div class="input-group-append">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">kg</span>
                              </div>
                          </div>
                      </div>
                    @else
                      <div id="display-weight" style="display: none;">
                          <div class="input-group">
                              <input type="number" class="form-control field weight" name="weight" min="0.01" step=".01" placeholder="Est. weight" autocomplete="off" value="{{ $device->estimate }}" disabled>
                              <div class="input-group-append">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">kg</span>
                              </div>
                          </div>
                      </div>
                    @endif
                  </td>
                  <td>
                        <label for="nested-5">Brand:</label>
                        <div class="form-control form-control__select">
                            <select name="brand-{{ $device->iddevices }}" class="select2-with-input" id="brand-{{ $device->iddevices }}">
                                @php($i = 1)
                                @if( empty($device->brand) )
                                  <option value="" selected></option>
                                @else
                                  <option value=""></option>
                                @endif
                                @foreach($brands as $brand)
                                  @if ($device->brand == $brand->brand_name)
                                    <option value="{{ $brand->brand_name }}" selected>{{ $brand->brand_name }}</option>
                                    @php($i++)
                                  @else
                                    <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                                  @endif
                                @endforeach
                                @if( $i == 1 && !empty($device->brand) )
                                  <option value="{{ $device->brand }}" selected>{{ $device->brand }}</option>
                                @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="nested-6">Model:</label>
                        <div class="form-group">
                            <input type="text" class="form-control field" id="model-{{ $device->iddevices }}" name="model-{{ $device->iddevices }}" value="{{ $device->model }}" placeholder="Model" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <label for="nested-7">Age:</label>
                        <div class="form-group">
                            <input type="number" class="form-control field" id="age-{{ $device->iddevices }}" name="age-{{ $device->iddevices }}" min="0" step="0.5" value="{{ $device->age }}" placeholder="Age (yrs)" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <label for="status-{{ $device->iddevices }}">Status:</label>
                        <div class="form-control form-control__select">
                            <select class="repair_status select2" name="status" id="status-{{ $device->iddevices }}" data-device="{{ $device->iddevices }}" placeholder="Description of problem">
                              <option value="0">-- Status --</option>
                              @if ( $device->repair_status == 1 )
                                <option value="1" selected>Fixed</option>
                                <option value="2">Repairable</option>
                                <option value="3">End of Life</option>
                              @elseif ( $device->repair_status == 2 )
                                <option value="1">Fixed</option>
                                <option value="2" selected>Repairable</option>
                                <option value="3">End of Life</option>
                              @else
                                <option value="1">Fixed</option>
                                <option value="2">Repairable</option>
                                <option value="3" selected>End of Life</option>
                              @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="repair-info-{{ $device->iddevices }}">Repair details:</label>
                        <div class="form-control form-control__select">
                            <select class="repair_details select2" name="repair-info" id="repair-info-{{ $device->iddevices }}" @if( $device->repair_status != 2 ) disabled @endif>
                              <option value="0">-- Repair Details --</option>
                              @if ( $device->more_time_needed == 1 )
                                <option value="1" selected>More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3">Do it yourself</option>
                              @elseif ( $device->professional_help == 1 )
                                <option value="1">More time needed</option>
                                <option value="2" selected>Professional help</option>
                                <option value="3">Do it yourself</option>
                              @elseif ( $device->do_it_yourself == 1 )
                                <option value="1" >More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3" selected>Do it yourself</option>
                              @else
                                <option value="1">More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3">Do it yourself</option>
                              @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="spare_parts">Spare parts:</label>
                        <div class="form-control form-control__select">
                            <select class="select2" name="spare-parts-{{ $device->iddevices }}" id="spare-parts-{{ $device->iddevices }}">
                              @if ($device->spare_parts == 1)
                                <option value="1" selected>Yes</option>
                                <option value="2">No</option>
                              @else
                                <option value="1">Yes</option>
                                <option value="2" selected>No</option>
                              @endif
                            </select>
                        </div>
                    </td>
                </tr>
                <tr class="table-row-more">
                    <td colspan="4">
                        <label for="description">Description of problem/solution:</label>
                        <div class="form-group">
                            <textarea class="form-control" rows="6" name="problem-{{ $device->iddevices }}" id="problem-{{ $device->iddevices }}">{!! $device->problem !!}</textarea>
                        </div>
                    </td>
                    <td colspan="3" class="table-cell-upload-td">
                        <div class="table-cell-upload">
                            <!-- <div class="form-group">
                                <label for="file">Add image:</label>

                                <form id="dropzoneEl" class="dropzone" action="/device/image-upload/{{ $device->iddevices }}" method="post" enctype="multipart/form-data" data-field1="Add device images here" data-field2="Choose compelling images that show off your work">
                                    <div class="fallback" >
                                        <input id="file-{{ $device->iddevices }}" name="file-{{ $device->iddevices }}" type="file" multiple />
                                    </div>
                                </form>

                                <div class="previews"></div>

                            </div> -->

                            <div class="row">
                                <div class="col-9 d-flex align-content-center flex-column">
                                    <div class="form-check d-flex align-items-center justify-content-start">
                                        <input class="form-check-input" type="checkbox" name="wiki-{{ $device->iddevices }}" id="wiki-{{ $device->iddevices }}" value="1" @if( $device->wiki == 1 ) checked @endif>
                                        <label class="form-check-label" for="wiki-{{ $device->iddevices }}">Could the solution comments help Restarters working on a similar device in future?  Or is it a fun case study?</label>
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-end flex-column"><div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-save2">Update</button></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        </form>
    </td>
</tr>
@else
<tr class="collapse table-row-details" id="row-{{ $device->iddevices }}">
    <td colspan="11">
        <table class="table">
            <tbody>
                <tr>
                  <td>
                    <label for="nested-5">Category:</label>
                    <div class="form-control form-control__select">
                        <select disabled name="category-{{ $device->iddevices }}" id="category-{{ $device->iddevices }}" class="category select2">
                            <option value="">-- Category --</option>
                            @foreach( $clusters as $cluster )
                            <optgroup label="{{{ $cluster->name }}}">
                                @foreach( $cluster->categories as $category )
                                  @if( $device->category == $category->idcategories )
                                    <option value="{{{ $category->idcategories }}}" selected>{{{ $category->name }}}</option>
                                  @else
                                    <option value="{{{ $category->idcategories }}}">{{{ $category->name }}}</option>
                                  @endif
                                @endforeach
                            </optgroup>
                            @endforeach
                            @if( $device->category == 46 )
                              <option value="46" selected>None of the above</option>
                            @else
                              <option value="46">None of the above</option>
                            @endif
                        </select>
                    </div>
                    @if( $device->category == 46 )
                      <div id="display-weight">
                          <div class="form-input">
                              <input disabled type="number" class="form-control field weight" name="weight" min="0.01" step=".01" placeholder="Est. weight" autocomplete="off" value="{{ $device->estimate }}">
                              <div class="input-group-append">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">kg</span>
                              </div>
                          </div>
                      </div>
                    @else
                      <div id="display-weight" style="display: none;">
                          <div class="form-input">
                              <input disabled type="number" class="form-control field weight" name="weight" min="0.01" step=".01" placeholder="Est. weight" autocomplete="off" value="{{ $device->estimate }}" disabled>
                              <div class="input-group-append">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend">kg</span>
                              </div>
                          </div>
                      </div>
                    @endif
                  </td>
                  <td>
                        <label for="nested-5">Brand:</label>
                        <div class="form-control form-control__select">
                            <select disabled name="brand-{{ $device->iddevices }}" class="select2-with-input" id="brand-{{ $device->iddevices }}">
                                @php($i = 1)
                                @if( empty($device->brand) )
                                  <option value="" selected></option>
                                @else
                                  <option value=""></option>
                                @endif
                                @foreach($brands as $brand)
                                  @if ($device->brand == $brand->brand_name)
                                    <option value="{{ $brand->brand_name }}" selected>{{ $brand->brand_name }}</option>
                                    @php($i++)
                                  @else
                                    <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                                  @endif
                                @endforeach
                                @if( $i == 1 && !empty($device->brand) )
                                  <option value="{{ $device->brand }}" selected>{{ $device->brand }}</option>
                                @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="nested-6">Model:</label>
                        <div class="form-group">
                            <input disabled type="text" class="form-control field" id="model-{{ $device->iddevices }}" name="model-{{ $device->iddevices }}" value="{{ $device->model }}" placeholder="Model" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <label for="nested-7">Age:</label>
                        <div class="form-group">
                            <input disabled type="number" class="form-control field" id="age-{{ $device->iddevices }}" name="age-{{ $device->iddevices }}" min="0" step="0.5" value="{{ $device->age }}" placeholder="Age (yrs)" autocomplete="off">
                        </div>
                    </td>
                    <td>
                        <label for="status-{{ $device->iddevices }}">Status:</label>
                        <div class="form-control form-control__select">
                            <select disabled class="repair_status select2" name="status" id="status-{{ $device->iddevices }}" data-device="{{ $device->iddevices }}" placeholder="Description of problem">
                              <option value="0">-- Status --</option>
                              @if ( $device->repair_status == 1 )
                                <option value="1" selected>Fixed</option>
                                <option value="2">Repairable</option>
                                <option value="3">End of Life</option>
                              @elseif ( $device->repair_status == 2 )
                                <option value="1">Fixed</option>
                                <option value="2" selected>Repairable</option>
                                <option value="3">End of Life</option>
                              @else
                                <option value="1">Fixed</option>
                                <option value="2">Repairable</option>
                                <option value="3" selected>End of Life</option>
                              @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="repair-info-{{ $device->iddevices }}">Repair details:</label>
                        <div class="form-control form-control__select">
                            <select disabled class="repair_details select2" name="repair-info" id="repair-info-{{ $device->iddevices }}" @if( $device->repair_status != 2 ) disabled @endif>
                              <option value="0">-- Repair Details --</option>
                              @if ( $device->more_time_needed == 1 )
                                <option value="1" selected>More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3">Do it yourself</option>
                              @elseif ( $device->professional_help == 1 )
                                <option value="1">More time needed</option>
                                <option value="2" selected>Professional help</option>
                                <option value="3">Do it yourself</option>
                              @elseif ( $device->do_it_yourself == 1 )
                                <option value="1" >More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3" selected>Do it yourself</option>
                              @else
                                <option value="1">More time needed</option>
                                <option value="2">Professional help</option>
                                <option value="3">Do it yourself</option>
                              @endif
                            </select>
                        </div>
                    </td>
                    <td>
                        <label for="spare_parts">Spare parts:</label>
                        <div class="form-control form-control__select">
                            <select disabled class="select2" name="spare-parts-{{ $device->iddevices }}" id="spare-parts-{{ $device->iddevices }}">
                              @if ($device->spare_parts == 1)
                                <option value="1" selected>Yes</option>
                                <option value="2">No</option>
                              @else
                                <option value="1">Yes</option>
                                <option value="2" selected>No</option>
                              @endif
                            </select>
                        </div>
                    </td>
                </tr>
                <tr class="table-row-more">
                    <td colspan="4">
                        <label for="description">Description of problem/solution:</label>
                        <div class="form-group">
                            <textarea disabled class="form-control" rows="6" name="problem-{{ $device->iddevices }}" id="problem-{{ $device->iddevices }}">{!! $device->problem !!}</textarea>
                        </div>
                    </td>
                    <td colspan="3" class="table-cell-upload-td">
                        <div class="table-cell-upload">
                            <!-- <div class="form-group">
                                <label for="file">Add image:</label>

                                <form id="dropzoneEl" class="dropzone" action="/device/image-upload/{{ $device->iddevices }}" method="post" enctype="multipart/form-data" data-field1="Add device images here" data-field2="Choose compelling images that show off your work">
                                    <div class="fallback" >
                                        <input id="file-{{ $device->iddevices }}" name="file-{{ $device->iddevices }}" type="file" multiple />
                                    </div>
                                </form>

                                <div class="previews"></div>

                            </div> -->
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
@endif
