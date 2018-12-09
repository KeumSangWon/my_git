
    function add_Input(){
    // pre_set 에 있는 내용을 읽어와서 처리..
    var div = document.createElement('div');
    div.innerHTML = "<br><input type='text' class='form-control' id='item' name='item[]' required><input type='button' class='btn btn-danger' value='Delete' onclick='delete_Input(this)'><br>"
    document.getElementById('field').appendChild(div);
    }
    function delete_Input(obj){
      document.getElementById('field').removeChild(obj.parentNode);
    }
