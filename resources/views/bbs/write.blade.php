@extends('layouts.app')
@section('content')
<script src="/js/write.js"></script>
<link rel="stylesheet" href="/css/write.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Write</div>
                  <div class="card-body">
                    <form class=""  id="form" method="POST" action="{{route('votes.store',['page'=>$page])}}">
                      @csrf
                      <div class="form-group row">
                          <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                          <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="" id="title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-md-4 col-form-label text-md-right">Option</label>
                      <div class="col-md-8">
                          <div  id="field">
                            <input type='text' class="form-control" id='item' name='item[]' required><br>

                            <br><input type='text' class="form-control" id='item' name='item[]'required>
                          </div>

                          <br>
                          <input type="button" class="btn btn-success" name="plus" value="Add" id="add" onclick="add_Input()"><span>Press button to add Item<span>
                          <br>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Set Expiration Period</label>
                        <div class="col-md-6">
                          <input type="date" class="form-control" name="end_date" value="" required>
                          <br>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="" class="col-md-4 col-form-label text-md-right">Number of participants</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control" name="complete_point" value="" required>
                        </div>
                      </div>
                      <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <input type="submit" class="btn btn-primary" value="Success" id="">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>


@endsection
