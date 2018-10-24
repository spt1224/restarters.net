<div class="accordion" id="accordion-log">

  @forelse ($audits as $audit)
      <div class="card">
          <div class="card-header p-0" id="heading{{{ $audit->id }}}">
            <h5 class="mb-0">
              <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse{{{ $audit->id }}}" aria-expanded="true" aria-controls="collapse{{{ $audit->id }}}">
                  @lang($type.'.'.$audit->event.'.metadata', $audit->getMetadata())
              </button>
            </h5>
          </div>
          <div id="collapse{{{ $audit->id }}}" class="collapse" aria-labelledby="heading{{{ $audit->id }}}" data-parent="#accordion-log">
              <div class="card-body">
                  <table class="table table-striped">
                    <tbody>
                      @foreach ($audit->getModified() as $attribute => $modified)
                          <tr>
                            <td>@lang($type.'.'.$audit->event.'.modified.'.$attribute, $modified)</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
  @empty
      <div class="text-center">@lang('event-audits.unavailable_audits')</div>
  @endforelse

</div>
