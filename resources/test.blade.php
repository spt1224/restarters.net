<div class="row justify-content-center">

  @if ($all)
    <form action="/group/all/search" method="get">
      <div class="col-lg-3">
        <div class="collapse d-lg-block fixed-overlay-md" id="collapseFilter">

          <div class="form-row">
            <div class="form-group col mobile-search-bar-md">
              <button class="btn btn-primary btn-groups" type="submit">@lang('groups.search_groups')</button>
              <button type="button" class="d-lg-none mobile-search-bar-md__close" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><svg width="21" height="21" viewBox="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><title>Close</title><g><path d="M11.25,10.387l-10.387,-10.387l-0.863,0.863l10.387,10.387l0.863,-0.863Z"/><path d="M0.863,11.25l10.387,-10.387l-0.863,-0.863l-10.387,10.387l0.863,0.863Z"/></g></svg></button>
            </div>
          </div>

          <aside class="edit-panel edit-panel__side">
            <legend>@lang('groups.by_details')</legend>

            <input type="hidden" name="sort_direction" value="{{$sort_direction}}" class="sr-only">
            <input type="radio" name="sort_column"   value="name" id="label-name" class="sr-only">
            <input type="radio" name="sort_column"  value="distance" id="label-location" class="sr-only">
            <input type="radio" name="sort_column"   value="hosts" id="label-hosts" class="sr-only">
            <input type="radio" name="sort_column"   value="restarters" id="label-restarters" class="sr-only">
            <input type="radio" name="sort_column"   value="created_at" id="label-created" class="sr-only">

            <div class="form-group">
              <label for="name">@lang('groups.groups_name'):</label>
              @if(isset($name))
                <input type="text" name="name" class="form-control" placeholder="@lang('groups.search_name')" value="{{ $name }}"/>
              @else
                <input type="text" name="name" class="form-control" placeholder="@lang('groups.search_name')"/>
              @endif
            </div>

            <div class="form-group">
              <label for="tags">@lang('groups.group_tag'):</label>
              <div class="form-control form-control__select">
                <select id="tags" name="tags[]" class="form-control select2-tags" multiple data-live-search="true" title="Choose group tags...">
                  @foreach ($all_group_tags as $group_tag)
                    @if(isset($selected_tags) && in_array($group_tag->id, $selected_tags))
                      <option value="{{ $group_tag->id }}" selected>{{ $group_tag->tag_name }}</option>
                    @else
                      <option value="{{ $group_tag->id }}">{{ $group_tag->tag_name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="location">@lang('groups.group_town-city'):</label>
              @if(isset($location))
                <input type="text" name="location" class="form-control" placeholder="@lang('groups.town-city-placeholder')" value="{{ $location }}"/>
              @else
                <input type="text" name="location" class="form-control" placeholder="@lang('groups.town-city-placeholder')"/>
              @endif
            </div>

            <div class="form-group">
              <label for="country">@lang('groups.group_country'):</label>
              <div class="form-control form-control__select">
                <select id="country" name="country" class="field select2">
                  <option value=""></option>
                  @foreach (FixometerHelper::getAllCountries() as $country_code => $country_name)
                    @if( isset($selected_country) && $country_name == $selected_country )
                      <option selected value="{{ $country_name }}">{{ $country_name }}</option>
                    @else
                      <option value="{{ $country_name }}">{{ $country_name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </aside>
        </div><!-- /collapseFilter -->
      </div>

      <div class="col-lg-9">
        @if( is_null($groups) )
          <section class="table-section" id="your-groups">
            <h2>@lang('groups.groups_title2') <sup>(<a href="/group/all">See all groups</a>)</sup></h2>
            <div class="table-responsive">
              <table role="table" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th width="42"></th>
                    <th width="200" scope="col"><label for="label-name">@lang('groups.groups_name')</label></th>
                    <th width="200" scope="col"><label for="label-location">@lang('groups.groups_location')</label></th>
                    <th width="75" scope="col" class="text-center"><label for="label-hosts">@lang('groups.groups_hosts')</label></th>
                    <th width="75" scope="col" class="text-center"><label for="label-restarters">@lang('groups.groups_restarters')</label></th>
                  </tr>
                </thead>
                <tbody>
                  @if( !is_null($groups_near_you) && count($groups_near_you) > 0 )
                    @foreach ($groups_near_you as $group)
                      @include('partials.tables.row-groups')
                    @endforeach
                  @else
                    <tr>
                      <td colspan="13" align="center" class="p-3">
                        @if ($your_area)
                          There are currently no groups near to your area ({{ $your_area }}). Would you consider starting a group?
                          <br><a href="/group/create/">@lang('groups.create_groups')</a>
                        @else
                          You do not currently have a town/city set.  You can set one in <a href="/profile/edit/{{ Auth::user()->id }}">your profile</a>.
                        @endif
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </section>
        @endif
      </div>
    </form>
  @else
  @endif
</div>
