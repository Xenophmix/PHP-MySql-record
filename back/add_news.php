<main class="container">
     <h1 class="text-center">新增消息</h1>
     <form action="./api/add_news.php" method="POST">
          <div class="form-group row mt-3">
               <label class="col-form-label col-md-2 text-end text-white">主題</label>
               <div class="col-md-8">
                    <input type="text" class="form-control" name="subject">
               </div>
          </div>
          <div class="form-group row mt-3">
               <label style="line-height: 10;" class="col-form-label col-md-2 text-end text-white">內容</label>
               <div class="col-md-8">
                    <textarea class="form-control" name="content" style="height:200px"></textarea>
               </div>
          </div>
          <div class="form-group row mt-3">
               <label class="col-form-label col-md-2 text-end text-white">類別</label>
               <div class="col-md-8">
                    <input type="text" class="form-control" name="type">
               </div>
          </div>
          <div class="form-group row mt-3">
               <div class="text-end text-info col-md-10">現在時間:<?= date("Y-m-d H:i:s"); ?></div>
          </div>
          <div class="text-center">
               <input class="btn btn-primary mx-2" type="submit" value="確定新增">
               <input class="btn btn-warning mx-2" type="reset" value="清空">
          </div>
     </form>
</main>
</form>