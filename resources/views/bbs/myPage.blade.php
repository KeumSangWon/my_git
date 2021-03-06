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
    <th scope="row">{{$msg->title}}</th>
    <td>{{$msg->user_id}}</td>
    <td>{{$msg->end_date}}</td>
    <td>{{$msg->hits}}</td>
  </tr>
  @endforeach
</tbody>
</table>
{{$msgs->links()}}
</div>
{{----}}
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
  @foreach($last_msgs as $msg)
  <tr>
    <th scope="row">{{$msg->title}}</th>
    <td>{{$msg->user_id}}</td>
    <td>{{$msg->end_date}}</td>
    <td>{{$msg->hits}}</td>
  </tr>
  @endforeach
</tbody>
</table>
{{$msgs->links()}}
</div>
{{----}}
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
  @foreach($my_msgs as $msg)
  <tr>
    <th scope="row">{{$msg->title}}</th>
    <td>{{$msg->user_id}}</td>
    <td>{{$msg->end_date}}</td>
    <td>{{$msg->hits}}</td>
  </tr>
  @endforeach
</tbody>
</table>
{{$msgs->links()}}
</div>
@endsection
