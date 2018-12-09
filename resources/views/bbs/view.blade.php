@extends('layouts.app')
@section('content')
<script src="/js/oneCheckbox.js"></script>
<div class="jumbotron">
    <h1>게시글 상세 내용</h1>
    <div class="=form-group">
      <label>제목</label><br>
      <input type="text" value="{{$board->title}}" required class="form-control" readonly><br> <!--required 무조건 입력하라-->
    </div>
    <div class="=form-group">
      <label>작성자</label><br>
      <input type="text" value="{{$board->user_id}}" required class="form-control" readonly name="writer"><br>
    </div>
    <div class="=form-group">
      <label>작성일자</label><br>
      <input type="text" value="{{$board->created_at}}" required class="form-control" readonly name="date"><br> <!--required 무조건 입력하라-->
    </div>
    <div class="=form-group">
      <label>조회수</label>
      <input type="text"  value="{{$board->hits}}" required class="form-control" readonly name="hit"><br> <!--required 무조건 입력하라-->
    </div>
      <div class="=form-group">
        <label>투표수</label>
        <input type="number" value="{{$board->complete_point}}" required class="form-control" readonly name="hit"><br> <!--required 무조건 입력하라-->
      </div>
      <form class="" action="{{route('voting',['board'=>$board, 'page'=>$page, 'item'=>$item])}}" method="post">
        @csrf
        <!--@Method('patch')  update에 보낼떄 사용   -->
      <div class="=form-group">
      <label>내용</label><br>
        @for($i=0; $i<count($item); $i++)
          {{$item[$i]->content}}
          <input type="checkbox" name="item" value="{{$item[$i]->id}}" onclick="oneCheckbox(this)">
          <br>
        @endfor
      <br>
    </div>
    <div class="=form-group">
      <input type="submit" value="완료"><br>
    </div>
    </form>
    <button type="button" name="button" onclick="location.href='{{route('votes.index', ['page'=>$page]) }}'">목록보기</button>
    <button type="button" name="button" onclick="location.href='{{route('delete', ['id'=>$board, 'page'=>$page])}}'">삭제</button>
@endsection
