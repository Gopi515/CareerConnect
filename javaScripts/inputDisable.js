function toggleInput() {
    var checkbox = document.getElementById("myCheckbox");
    var textInput1 = document.getElementById("option1Input");
    var textInput2 = document.getElementById("option2Input");
    var textInput3 = document.getElementById("option3Input");
    var textInput4 = document.getElementById("option4Input");
    var textInput5 = document.getElementById("option5Input");
    var textInput6 = document.getElementById("option6Input");
    var textInput7 = document.getElementById("option7Input");

    if (checkbox.checked) {
      textInput1.classList.add("disabled-input");
      textInput1.disabled = true;
      textInput2.disabled = true;
      textInput3.disabled = true;
      textInput4.disabled = true;
      textInput5.disabled = true;
      textInput6.disabled = true;
      textInput7.disabled = true;
    } 
    else if (textInput5.checked){
        textInput2.classList.add("disabled-input");
        textInput2.disabled = true;
        textInput1.classList.remove("disabled-input");
        textInput1.disabled = false;
        textInput3.disabled = false;
        textInput4.disabled = false;
        textInput5.disabled = false;
        textInput6.disabled = false;
        textInput7.disabled = false;
    }
    else {
      textInput1.classList.remove("disabled-input");
      textInput1.disabled = false;
      textInput2.disabled = false;
      textInput3.disabled = false;
      textInput4.disabled = false;
      textInput5.disabled = false;
      textInput6.disabled = false;
      textInput7.disabled = false;
    }
  }

  function toggleInputjob() {
    var checkbox = document.getElementById("myCheckboxjob");
    var textInput1job = document.getElementById("option1Inputjob");
    var textInput2job = document.getElementById("option2Inputjob");
    var textInput3job = document.getElementById("option3Inputjob");
    var textInput4job = document.getElementById("option4Inputjob");
    var textInput5job = document.getElementById("option5Inputjob");
    var textInput6job = document.getElementById("option6Inputjob");

    if (checkbox.checked) {
      textInput1job.classList.add("disabled-input");
      textInput1job.disabled = true;
      textInput2job.disabled = true;
      textInput3job.disabled = true;
      textInput4job.disabled = true;
      textInput5job.disabled = true;
      textInput6job.disabled = true;
    } 
    else if (textInput5job.checked){
        textInput2job.classList.add("disabled-input");
        textInput2job.disabled = true;
        textInput1job.classList.remove("disabled-input");
        textInput1job.disabled = false;
        textInput3job.disabled = false;
        textInput4job.disabled = false;
        textInput5job.disabled = false;
        textInput6job.disabled = false;
    }
    else {
      textInput1job.classList.remove("disabled-input");
      textInput1job.disabled = false;
      textInput2job.disabled = false;
      textInput3job.disabled = false;
      textInput4job.disabled = false;
      textInput5job.disabled = false;
      textInput6job.disabled = false;
    }
  }
