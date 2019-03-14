function loadAjax(urlPath,dataSend=array(),showDiv){
$.ajax({
  xhr: function()
  {
    var xhr = new window.XMLHttpRequest();
    //Upload progress
    xhr.upload.addEventListener("progress", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with upload progress
        console.log(percentComplete);
      }
    }, false);
    //Download progress
    xhr.addEventListener("progress", function(evt){
      if (evt.lengthComputable) {
        var percentComplete = evt.loaded / evt.total;
        //Do something with download progress
        console.log(percentComplete);
      }
    }, false);
    return xhr;
  },
  type: 'POST',
  url: urlPath,
  data: dataSend,
  success: function(data){
    $("#"+showDiv).html(data);
  }
});
}


function apiAjax(urlAjax,action,data={},successActionName='',redirectlink=''){
  // var value = { "aaa": "111", "bbb": "222", "ccc": "333" };
  var value = data;
var blkstr = [];
$.each(value, function(idx2,val2) {
  var str = idx2 + "," + val2;
  blkstr.push(str);
});
var tdata="|&|"+blkstr.join("|&|");
console.log(tdata);
var arrayReqIn="action|$$|"+action+"|&&|data|$$|"+ tdata;
  var trackingJSON = JSON.stringify(arrayReqIn);
  console.log(arrayReqIn);

// console.log(trackingJSON);
// var myObject = new Object();
// myObject.action = action;
// myObject.data = tdata;
$.ajax({
    type: "POST",
    url: urlAjax,
    contentType: "application/json",
    data: trackingJSON,
    // headers: {
    //   'Content-Type': 'application/json',
    //       'Accept': 'application/json'
    //       },
    // dataType: 'json',
    beforeSend: function() {},
    complete: function() { },
    success: function(data) {
      console.log('ax:'+successActionName);
      console.log('dx:'+data);
      console.dir(data);

      // actData={data:data,link:redirectlink};
      if(successActionName.length>0){
      window[successActionName](data,redirectlink);
    }
     },
    error: function(data) {
      var out = '';
         for (var i in data) {
             out += i + ": " + data[i] + "\n";
         }
    console.log(out);
  },
    dataType: 'json'
});
}
// *************



 // ************
 function executeFunctionByName(functionName, context /*, args */) {
  var args = Array.prototype.slice.call(arguments, 2);
  var namespaces = functionName.split(".");
  var func = namespaces.pop();
  for(var i = 0; i < namespaces.length; i++) {
    context = context[namespaces[i]];
  }
  return context[func].apply(context, args);
}
