@extends('layout')

@section('title')
{{ $recipient->vardas }}
{{ $recipient->pavarde }}
@endsection

@section('content')
<div class="container content">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center">
        <span>{{ $recipient->vardas }}</span>
        <span class="text-danger">{{ $recipient->pavarde }}</span>
      </h2>

      <div id="chatContainer" style="height: 50vh; overflow: auto;" class="card-body pt-4 pb-1">
        <div class="container">
          @forelse ($messages as $message)
            <div class="row {{ $message->siuncia == $recipient->id ? '' : 'justify-content-end' }}">

              @if($message->siuncia != $recipient->id)
              <div class="small mx-2 my-auto text-muted">
                {{ $message->data_sukurta->diffForHumans() }}
              </div>
              @endif

              <div
                style="max-width: 69%; border-radius: 1em; margin-bottom: 0.125rem; margin-top: 0.125rem; word-wrap: break-word;"
                class="border border-danger px-2 py-1 {{ $message->siuncia == $recipient->id ? 'text-danger' : 'align-self-end text-light bg-danger' }}">
                {{ $message->tekstas }}
              </div>

              @if($message->siuncia == $recipient->id)
              <div class="small mx-2 my-auto text-muted">
                {{ $message->data_sukurta->diffForHumans() }}
              </div>
              @endif
            </div>
          @empty
            <div class="row justify-content-center">
              Žinučių nėra.
            </div>
          @endforelse
        </div>
      </div>

      <div class="card-body pt-2">
        <form method="POST" action="{{ route('tasks.comms.store') }}">
          <input type="hidden" name="recipientId" value={{ $recipient->id }}>

          <div class="input-group">
            @csrf

            <input
              id="message"
              type="text"
              class="form-control @error('message') is-invalid @enderror"
              name="message"
              value="{{ old('message') ?? '' }}"
              placeholder="Žinutė"
              maxlength="500"
              autocomplete="off"
              autofocus>

            <button type="submit" class="btn btn-danger ml-2">
              Siųsti
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  window.onload=function () {
    var objDiv = document.getElementById("chatContainer");
    objDiv.scrollTop = objDiv.scrollHeight;
  }
</script>
@endsection
