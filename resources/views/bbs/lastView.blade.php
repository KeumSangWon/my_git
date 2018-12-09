@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
  {{--<script src="/js/chart.js"></script>--}}
<script src="/js/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">
  $(function(){

    $("#gender").on('change',function(){
      var gender = $("#gender option:selected").val();
      if (  $("#age").val()!='ng') {
        var age = $("#age").val()?$("#age").val():"";
      }
      $.ajaxSetup({
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
             }
         });
        $.ajax({
          type: "POST",
          url: "/data",
          data:{
              gender:gender,
              age:age,
              id:{{$board->id}},
          },
          success: function(data){
            console.log(data);
            chart(data);
          },
          error:function(request,status,error){

            console.log(request+status+error);
            alert(request);
          }
        });
    });

    $("#age").on('change',function(){
      var age = $('#age option:selected').val();
      if (  $("#gender").val()!='ng') {
        var gender = $("#gender").val()?$("#gender").val():"";
      }

      $.ajaxSetup({
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
             }
         });
        $.ajax({
          type: "POST",
          url: "/data",
          data:{
              age:age,
              gender:gender,
              id:{{$board->id}},
          },
          success: function(data){
            console.log(data);
            chart(data);
          },
          error:function(request,status,error){
            console.log(request+status+error);
            alert('data is Undefined');
          }
        });
      });
    });

$(function(){
  var data = <?= json_encode($content_vote_arr)?>;
  chart(data);


  $("#resetButton").on("click", function(){
  var data = <?= json_encode($content_vote_arr)?>;
  chart(data);
  });
});
</script>

@section('content')
<div class="jumbotron">
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
        <input type="number" value="{{$board->voting_point}}" required class="form-control" readonly name="hit"><br> <!--required 무조건 입력하라-->
      </div>
        @csrf
        <!--@Method('patch')  update에 보낼떄 사용   -->
      <div class="=form-group">
      <label>내용</label><br>
        @for($i=0; $i<count($item); $i++)
          {{$item[$i]->content}}
          <br>
        @endfor
      <br>
    </div>
  <button type="button" name="button" onclick="location.href='{{route('lastVotes.index') }}'">List view</button>
  <br>

  <select class="" name="" id="gender">
    <option value="ng">gender</option>
    <option value="M">Men</option>
    <option value="W">Women</option>
  </select>
  <select class="" name="" id="age">
    <option value="ng">age</option>
    @for ($i =10; $i<=80; $i+=10)
      <option value="{{$i/10}}">{{$i}}</option>
    @endfor
  </select>s
  <button type="button" name="button" id="resetButton">reset</button>
  <br>
  <hr>
  <div id="chartContainer" style="height: 370px; width: 50%; margin: auto;"></div>
@endsection
