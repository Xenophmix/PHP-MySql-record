<?php
if (isset($_GET['id'])) {
  $subject = find('survey_subject', $_GET['id']);
  // dd($subject);
  $options = all('survey_options', ['subject_id' => $_GET['id']]);
  // dd($options);
} else {

  header("location:admin_center.php?do=survey&error=沒有指定編輯的調查id");
}

?>
<h3 class="text-center text-white">編輯調查</h3>
<!-- <button onclick="addOption()" class="btn btn-success">+</button> -->
<form action="./api/survey_edit.php" class="col-10 mx-auto d-flex flex-wrap justify-content-end" method="post">
  <div class="container">
    <div class="row">
      <div class="col-2 text-end">
        <label class="text-end text-white lh-lg">主題</label>
      </div>
      <div class="col-8 text-end">
        <input name="subject" type="text" class="form-control" value="<?= $subject['subject']; ?>">
        <input name="subject_id" type="hidden" class="form-control" value="<?= $subject['id']; ?>">
      </div>
      <div class="col-2">
        <button onclick="addOption()" class="btn btn-success" type="button">+</button>
      </div>
    </div>
  </div>
  <!--選項區-->
  <div id="options" class="container-fluid">

    <?php
    foreach ($options as $idx => $option) {

    ?>
      <div class="container">
        <div class="option row justify-content-center mt-2">
          <div class="col-3 text-end">
            <label class="text-end text-white lh-lg">項目<?= $idx + 1; ?></label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name='opt[]' value="<?= $option['opt']; ?>">
            <input type="hidden" class="form-control" name='opt_id[]' value="<?= $option['id']; ?>">
          </div>
          <div class="col-2">
            <a href="./api/survey_option_del.php?id=<?= $option['id']; ?>" class="btn btn-danger">-</a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="text-center container mt-3">
    <input class="btn btn-primary mx-1" type="submit" value="確定編輯">
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
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "optn[]");
    input.setAttribute("type", "text");

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