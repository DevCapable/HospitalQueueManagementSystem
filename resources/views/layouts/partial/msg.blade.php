{{--            @if ($errors->any())--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--             <div class="alert alert-danger">--}}
{{--              <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>--}}
{{--              <span>--}}
{{--              <b> Danger - </b> {{ $error }}</span>--}}
{{--             </div>--}}
{{--            @endforeach--}}
{{--           @endif--}}

{{--            @if(session('successMsg'))--}}
{{--              <div class="alert alert-success">--}}
{{--                  <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>--}}
{{--                <span>--}}
{{--                <b> Success - </b> {{ session('successMsg') }}</span>--}}
{{--              </div>--}}
{{--              @endif--}}

{{----}}

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" aria-label="Close" class="close" onclick="this.parentElement.style.display='none'">
                <span aria-hidden="true">&times;</span>
            </button>
            <span><b>Danger - </b>{{ $error }}</span>
        </div>
    @endforeach
@endif

@if(session('successMsg'))
    <div class="alert alert-success">
        <button type="button" aria-label="Close" class="close" onclick="this.parentElement.style.display='none'">
            <span aria-hidden="true">&times;</span>
        </button>
        <span><b>Success - </b>{{ session('successMsg') }}</span>
    </div>
@endif
