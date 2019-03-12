<?php if(isset($addedStatus) && $addedStatus==true){?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                              <strong>Success!</strong> Your new Item added.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span class="fa fa-times"></span>
                                              </button>
                                          </div>
<?php }elseif(isset($addedStatus) && $addedStatus==false){ ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              <strong>Faild!</strong> Faild to add new item.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span class="fa fa-times"></span>
                                              </button>
                                          </div>
 <?php } ?>
 <?php if(isset($changedStatus) && $changedStatus==true){?>
   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                               <strong>Success!</strong> Your  Item Updated.
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <span class="fa fa-times"></span>
                                               </button>
                                           </div>
 <?php }elseif(isset($changedStatus) && $changedStatus==false){ ?>
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                               <strong>Faild!</strong> Faild to Update item.
                                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <span class="fa fa-times"></span>
                                               </button>
                                           </div>
  <?php } ?>

<div class="pull-right col-lg-3 col-md-3">
    <div class="form-group ">
      <button type="button" onclick="addItem()" class=" form-control btn btn-outline-success mb-3">Add New One</button>
    </div>
</div>
<?php if($itemExist){ ?>
<div class=" col-lg-3 col-md-3">
    <div class="form-group ">
      <button type="button"  onclick="updateItem()" class=" form-control btn btn-outline-success mb-3">SAVE</button>
    </div>
</div>
<?php } ?>
<input id="itemId" value="<?=$item['item_id']?>" type="hidden">

  <label class="col-form-label">Item Name:</label>

  <input id="itemName" class="form-control mb-4" value="<?=$item['item_name']?>" type="text" placeholder="Item Name">

  <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text">Item Description:</span>
              </div>
              <textarea id="itemDescription" class="form-control" rows="4" aria-label="Description"><?=$item['item_description']?></textarea>
  </div>
  <label class="col-form-label">Item Value:</label>

  <input id="itemValue" class="form-control mb-4" value="<?=$item['item_value']?>" type="text" placeholder="Item value">

  <div class="form-group ">
          <label class="col-form-label">Type:</label>
          <select id="itemType" class="form-control ">
              <option>Select</option>
              <?php foreach ($allType as $keyType => $valueType) { ?>
              <option <?php
                  if($valueType->type_id==$item['item_type'])
                  echo "selected";
              ?> value="<?=$valueType->type_id?>"><?=$valueType->type_name?></option>
            <?php } ?>
          </select>
  </div>




    <!-- With Badges start -->
    <div class="col-md-12 mt-12">
        <div class="" >
            <div class="">
                <h4 class="header-title">Parent:</h4>
                <ul class="list-group" style="max-height:400px;overflow-y:scroll">
                  <?php
                  if(count($parent)>0){
                   foreach ($parent as $keyItem => $valueItem) {?>

                  <li style="cursor:pointer"  onclick="loadAjax('<?=$link['ajax']['editItem']?>','id=<?=$valueItem->item_id?>','ajaxLoadEditItem')" class="list-group-item d-flex justify-content-between align-items-center"><?=$valueItem->item_name?>
                    <?php if($valueItem->item_activation==0){ ?>
                      <span class="badge badge-warning badge-pill">Deactive</span>
                     <?php } ?>
                      <?php if($valueItem->item_deleted==1){ ?>
                        <span class="badge badge-danger badge-pill">Deleted</span>
                      <?php } ?>
                      <span class="badge badge-primary badge-pill" >14</span>

                  </li>
                <?php }
              } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- With Badges end -->


      <!-- With Badges start -->
      <div class="col-md-12 mt-12">
          <div class="" >
              <div class="">
                  <h4 class="header-title">Child:</h4>
                  <ul class="list-group" style="max-height:400px;overflow-y:scroll">
                    <?php foreach ($child as $keyItem => $valueItem) {?>

                    <li style="cursor:pointer"  onclick="loadAjax('<?=$link['ajax']['editItem']?>','id=<?=$valueItem->item_id?>','ajaxLoadEditItem')" class="list-group-item d-flex justify-content-between align-items-center"><?=$valueItem->item_name?>
                      <?php if($valueItem->item_activation==0){ ?>
                        <span class="badge badge-warning badge-pill">Deactive</span>
                       <?php } ?>
                        <?php if($valueItem->item_deleted==1){ ?>
                          <span class="badge badge-danger badge-pill">Deleted</span>
                        <?php } ?>
                        <span class="badge badge-primary badge-pill" >14</span>

                    </li>
                  <?php } ?>
                  </ul>
              </div>
          </div>
      </div>
      <!-- With Badges end -->


  <b class="text-muted mb-3 d-block">Status:</b>
  <div class="custom-control custom-checkbox">
      <input  type="checkbox" <?php if($item['item_activation']==1){ echo "checked"; }?> class="custom-control-input" id="customCheck1">
      <label class="custom-control-label" for="customCheck1">Active</label>
  </div>
  <div class="custom-control custom-checkbox">
      <input  type="checkbox" <?php if($item['item_deleted']==1){ echo "checked"; }?> class="custom-control-input" id="customCheck2">
      <label class="custom-control-label" for="customCheck2">Deleted</label>
  </div>


<script type="text/javascript">

function addItem(){
var data={};
  data['item_name']=$("#itemName").val();
  data['item_description']=$("#itemDescription").val();
  data['item_value']=$("#itemValue").val();
  data['item_type']=$("#itemType option:selected").val();
  // $('#aioConceptName').find(":selected").text();

  if ($('#customCheck1').is(":checked"))
  {
    data['item_activation']=1;
  }else{
    data['item_activation']=0;
  }

    if ($('#customCheck2').is(":checked"))
    {
      data['item_deleted']=1;
    }else{
      data['item_deleted']=0;
    }

$.each(data, function(index, val) {
    console.log(index+"-> "+val);
});
  var answer=confirm('Do you want to Add?');
      if(answer){


loadAjax('<?=$link['ajax']['ajaxAddItem']?>',data,'ajaxLoadEditItem')
      }
      else{
          alert('Not Added.');
      }


}

// **********************
function updateItem(){
var data={};
 data['saveChange']=true;
 data['id']=$("#itemId").val();
 data['item_name']=$("#itemName").val();
  data['item_description']=$("#itemDescription").val();
  data['item_value']=$("#itemValue").val();
  data['item_type']=$("#itemType option:selected").val();
  // $('#aioConceptName').find(":selected").text();

  if ($('#customCheck1').is(":checked"))
  {
    data['item_activation']=1;
  }else{
    data['item_activation']=0;
  }

    if ($('#customCheck2').is(":checked"))
    {
      data['item_deleted']=1;
    }else{
      data['item_deleted']=0;
    }

$.each(data, function(index, val) {
    console.log(index+"-> "+val);
});
  var answer=confirm('Do you want to Save?');
      if(answer){


loadAjax('<?=$link['ajax']['ajaxEditItem']?>',data,'ajaxLoadEditItem')
      }
      else{
          alert('Not Added.');
      }


}


</script>
