@extends('layouts.app')

@section('title','Queue')

@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partial.msg')
                    <div class="card">
                         <div class="card-header card-header-primary">
                         <h4 class="card-title ">All Queues</h4>
                          <audio id="myAudio">
                          <source src="{{asset('backend/customer.M4A')}}" type="audio/mpeg">
                         </audio>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Service Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($queues as $key=>$queue)
                                        @php($publish = $queue->publication ? 'unpublished' : 'published')
                                        @php($class = $queue->publication ? 'btn btn-default btn-sm' : 'btn btn-success btn-sm')

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $queue->name }}</td>
                                            <td>{{ $queue->service }}</td>

                                            <th>
                                                @if($queue->status == true)
                                                    <span class="badge badge-success">Called</span>
                                                @else
                                                    <span class="badge badge-danger">not Called yet</span>
                                                @endif

                                            </th>
                                            <td>{{ $queue->created_at }}</td>
                                            <td>


                                                    <form id="publication-form-{{ $queue->id }}" action="{{ route('queue.publication',$queue->id) }}" style="display: none;" method="POST">
                                                        @csrf
                                                    </form>
                                                    <input type="hidden" id="publish{{$queue->id}}" name="publish" value="{{$queue->name}}">
                                                    <button type="button" class="{{$class}}" onclick="if(confirm('Are you sure you want to unpublish this?')){
                                                            playPublic({{$queue->id}});

                                                            }else {
                                                            event.preventDefault();
                                                            } "><i class="card-icon"></i>   {{ $publish }}</button>

                                                @if($queue->status == false)
                                                    <form id="status-form-{{ $queue->id }}" action="{{ route('queue.status',$queue->id) }}" style="display: none;" method="POST">
                                                        @csrf
                                                    </form>
                                                    <input type="hidden" id="s_name{{$queue->id}}" name="s_name" value="{{$queue->name}}">
                                                    <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')){
                                                            playAudio({{$queue->id}});

                                                            }else {
                                                            event.preventDefault();
                                                            } "><i class="material-icons">settings_phone</i></button>
                                                @endif
                                                <form id="delete-form-{{ $queue->id }}" action="{{ route('queue.destroy',$queue->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $queue->id }}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12">
            <form class="login-form" method="post" action="{{ route('notification.create') }}">
                @csrf

                <div class="row margin">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" placeholder="Title" value="" autofocus>
                        </div>
                    </div>
                </div>


                <br>
                <div class="row margin">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" name="message" placeholder="Enter Message" style="min-height: 100px;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Submit</button>
                    </div>
                </div>
            </form>
</div>
@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
var x = document.getElementById("myAudio");

function playAudio(id) {

  x.play();
  var name = $('#s_name'+id).val();
  alert(name);
  event.preventDefault();
    document.getElementById('status-form-'+id).submit();
    //alert("working");
}

    function playPublic(id) {

        x.play();
        var name = $('#publish'+id).val();
        alert(name);
        event.preventDefault();
        document.getElementById('publication-form-'+id).submit();
        //alert("working");
    }
</script>

@endpush
