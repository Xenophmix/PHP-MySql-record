<h3 class="text-center text-white">新增調查</h3>

<form action="./api/survey_add.php" method="post" class="col-10 mx-auto d-flex flex-wrap justify-content-end">
  <div class="container">
    <div class="row">
      <div class="col-2 text-end">
        <label class="text-end text-white lh-lg">主題</label>
      </div>
      <div class="col-8 text-end">
        <input name="subject" type="text" class="form-control">
      </div>
      <div class="col-2">
        <button onclick="addOption()" class="btn btn-success" type="button">+</button>
      </div>
    </div>
  </div>
  <!--選項區-->
  <div id="options" class="container-fluid">
    <div class="container">
      <div class="option row justify-content-center mt-2">
        <div class="col-3 text-end">
          <label class="text-end text-white lh-lg">項目1</label>
        </div>
        <div class="col-7">
          <input type="text" class="form-control" name='opt[]'>
        </div>
        <div class="col-2">
        </div>
      </div>
    </div>
  </div>
  <div class="text-center col-12 mt-3">
    <input class="btn btn-primary mx-1" type="submit" value="確定新增">
    <input class="btn btn-warning mx-1" type="reset" value="重置">
  </div>
</form>
<script>
  function addOption() {
    let options = document.getElementById('options');
    let num = document.getElementsByClassName('option').length + 1
    let container = document.createElement("div");
    let row = document.createElement("div");
    let col3 = document.createElement("div");
    let col7 = document.createElement("div");
    let col2 = document.createElement("div");
    let label = document.createElement("lable");
    let input = document.createElement('input');
    let numNode = document.createTextNode("項目" + num);
    container.setAttribute("class", "container");
    row.setAttribute("class", "option row justify-content-center mt-2");
    col3.setAttribute("class", "col-3 text-end");
    col7.setAttribute("class", "col-7");
    col2.setAttribute("class", "col-2");
    label.setAttribute("class", "text-end text-white lh-lg");
    input.setAttribute("type", "text");
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "opt[]");

    container.appendChild(row);
    row.appendChild(col3);
    col3.appendChild(label);
    label.appendChild(numNode)
    row.appendChild(col7);
    col7.appendChild(input)
    row.appendChild(col2);

    options.appendChild(container);

  }
</script>