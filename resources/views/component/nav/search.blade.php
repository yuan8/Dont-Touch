@isset($show_form_search)
  @if($show_form_search==true)
    <form action="{{(url()->current())}}" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" name="q" value="{{isset($_GET['q'])?$_GET['q']:''}}" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
      @foreach($_GET as $key=>$input)
        @if($key!='q')
          <input type="hidden" name="{{$key}}" value="{{$input}}">
        @endif
      @endforeach
    </form>

  @endif
@endisset
