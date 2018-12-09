@extends('layouts.app')
@section('content')

<div class="jumbotron">
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">제목</th>
      <th scope="col">작성자</th>
      <th scope="col">마감일자</th>
      <th scope="col">조회수</th>
    </tr>
  </thead>
  <tbody>
    @foreach($msgs as $msg)
    <tr>
      <td><a href="{{route('lastVotes.show',['board'=>$msg, 'page'=>$page])}}">{{$msg->title}}</a></td>
      <td>{{$msg->user_id}}</td>
      <td>{{$msg->end_date}}</td>
      <td>{{$msg->hits}}</td>
    </tr>
    @endforeach
  </tbody>
  </table>
  {{$last_msgs->links()}}
</div>
@endsection
