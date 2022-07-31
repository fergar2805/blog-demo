@extends('layouts.posts')

@prepend('scripts')
    <script src="{{ asset('js/scripts.js')}}"></script>
@endpush

@section('content')
    <br>

    <div class="row postTitle">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>POST</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-light btn-sm postButton postButtonTable" href="{{ route('post') }}">BACK</a>
            </div>
        </div>
    </div>

    <br>

    <div class="card text-bg-dark postCard">
        <div class="card-header">
            {{ $post->title }}<br>
        </div>
        <div class="card-body">
            {{ $post->content }}
        </div>
        <div class="card-footer">
            by: {{ $post->user->getFullName() }}
        </div>
    </div>

    <br>

    <div class="row postTitle">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>COMMENTS</h2>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id='commentTable' class="table table-dark">
            <tbody>
            <tr>
                <td><input type='text' id='comment' class="form-control registerInput"></td>
                <td class="text-center"><button type='button' id='addComment' value='Add' class="btn btn-light btn-sm commentsButton">
                         ADD</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
