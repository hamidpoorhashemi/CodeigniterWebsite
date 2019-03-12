
        <!-- header area end -->
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="container">




              <div class="main-content-inner">
                  <div class="row">
                      <div class="col-lg-12 col-ml-12">
                          <div class="row">
                              <!-- Textual inputs start -->
                              <div class="col-4   mt-5">
                                  <div class="card">
                                      <div class="card-body">
                                        <div class="row">


                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group ">
                                                    <label class="col-form-label">Type:</label>
                                                    <select class="form-control">
                                                        <option>Select</option>
                                                        <?php foreach ($allType as $keyType => $valueType) { ?>
                                                        <option value="<?=$valueType->type_id?>"><?=$valueType->type_name?></option>
                                                      <?php } ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group ">

                                              <label class="col-form-label">Name:</label>
                                                    <input class="form-control" type="text" name="" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group ">

<button type="button" class="form-control btn btn-outline-secondary mb-3" onclick="loadAjax('<?=$link['ajax']['editItem']?>','id=5','ajaxLoadEditItem')">Search Item</button>

                                            </div>
                                        </div>



<br>
<hr>
<!-- With Badges start -->
<div class="col-md-12 mt-12">
    <div class="" >
        <div class="">
            <h4 class="header-title">Results:</h4>
            <ul class="list-group" style="max-height:400px;overflow-y:scroll">
              <?php foreach ($allItem as $keyItem => $valueItem) {?>

              <li style="cursor:pointer"  onclick="loadAjax('<?=$link['ajax']['editItem']?>','id=<?=$valueItem->item_id?>','ajaxLoadEditItem')" class="list-group-item d-flex justify-content-between align-items-center"><?=$valueItem->item_name?>
                    <?php foreach ($allType as $keyType => $valueType) { ?>
                      <?php if($valueItem->item_type==$valueType->type_id){ ?>
                      <span class="badge badge-info badge-pill"><?=$valueType->type_name?></span>
                    <?php }
                  } ?>
                 <?php if($valueItem->item_activation==0){ ?>
                   <span class="badge badge-warning badge-pill">Deactive</span>
                  <?php } ?>
                  <?php if($valueItem->item_deleted==1){ ?>
                    <span class="badge badge-danger badge-pill">Deleted</span>
                  <?php } ?>

              </li>
            <?php } ?>

            </ul>
        </div>
    </div>
</div>
<!-- With Badges end -->


                                    </div>


                              </div>
                            </div>
                            </div>

                            <!-- /**************************************************** -->
                            <!-- /**************************************************** -->

                            <div class="col-8 mt-5">
                                <div class="card">
                                      <div class="card-body" id="ajaxLoadEditItem">
                                      </div>
                                </div>
                          </div>

                            <!-- /**************************************************** -->
                            <!-- /**************************************************** -->




                          </div>
                      </div>
                    </div>
                  </div>


            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
