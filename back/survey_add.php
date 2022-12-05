<h3 class="text-center text-white">新增調查</h3>

<form action="./api/survey_add.php" method="post" class="col-10 mx-auto d-flex flex-wrap justify-content-end">
    <div class="form-group row col-12 gap-3">
      <div class="col-2 text-end">
        <label class="text-end text-white">主題</label>
      </div>
      <div class="col-8 text-end">
        <input name="subject" type="text" class="form-control">
      </div>
    </div> 
    <!--選項區-->
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white" >項目1</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>    
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white">項目2</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white">項目3</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>  
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white">項目4</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white">項目5</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>    
        <div class="form-group row col-12 justify-content-center mt-2">
          <div class="col-1 text-end">
            <label class="text-end text-white">項目6</label>
          </div>
          <div class="col-7">
            <input type="text" class="form-control" name="opt[]">
          </div>
        </div>          
<div class="text-center col-12 mt-3">
    <input class="btn btn-primary mx-1" type="submit" value="確定新增">
    <input class="btn btn-warning mx-1" type="reset" value="重置">
</div>
</form>