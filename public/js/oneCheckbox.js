function oneCheckbox(a){
      var obj = document.getElementsByName("item");
      for(var i=0; i<obj.length; i++){
          if(obj[i] != a){
              obj[i].checked = false;
          }
      }
  }
