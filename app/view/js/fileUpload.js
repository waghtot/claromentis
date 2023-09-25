const output = document.getElementById("output");
const fileuploader = document.getElementById("fileUpload");

fileuploader.addEventListener("change", (event) => {

  const file = event.target.files[0];
  let fileType = file.type.split('/')[1];
  let fileName = changeFileName(file.name.replace('.'+fileType, '').replace(/([^\w]+|\s+)/g, ''), fileType);
    if(checkIfCsv(fileType) !== false){
      setCookie();
      data = {
        file:nameFile(file, fileName),
        filename: fileName,
        url:'/fileupload',
        method:'POST',
        action:'fileupload'
      }
      sendFile(data);
    }
});

function changeFileName(fileName, fileType){
  let timeto = (new Date()).toISOString().replace(/[^0-9]/g, '').slice(0, -3);
  let newName = fileName.split('.'+fileType)[0]+'_'+timeto+'.'+fileType;
  if(newName.length >= 250){
    newName = 'DataFile_'+timeto+'.'+fileType;
  }
  return newName;
}

function checkIfCsv(fileType){

  if(fileType == 'csv'){
      return true;
  }
  return false;
}

function setCookie(){
  document.cookie='fileupload='+create_UUID();
}

function nameFile(file, newName){

  var results = new File([file], newName);
  return results;

}

async function sendFile(data){

  let content = new FormData();
  
  if(data.action == 'fileupload'){
    content.append("file", data.file);
  }else{
    content.append('filename', data.filename);
  }
  content.append("auth", getCookie("fileupload"));
  content.append('action', data.action);

  let response = await fetch(data.url, {method: data.method, body: content, headers: {Authorization:btoa(getCookie("fileupload"))}});
  response.action = data.action;
  response.filename = data.filename;
  handle_response(response);

}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function handle_response(e){

  let title = '';
  let message = '';
  let icon = '';

  if(e.status == 200){
    title = 'Success';
    message = messageByAction(e.action, e.filename),
    icon = 'success';
  }else{
    title = 'Error';
    message = 'something went wrong';
    icon = 'error';
  }

  Swal.fire(
    title,
    message,
    icon
  ).then(function(){
    location.href='/';
  })
}

function messageByAction(action, filename){
  switch(action){
    case 'fileupload':
      return 'File uploaded with name: ' + filename;
    break;
    case 'process':
      return 'File: '+ filename + ' has been processed sucessfuly';
    break;
    case 'delete':
      return 'File: ' + filename + ' has been deleted';
    break;
  }
}

function create_UUID(){
  var dt = new Date().getTime();
  var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = (dt + Math.random()*16)%16 | 0;
      dt = Math.floor(dt/16);
      return (c=='x' ? r :(r&0x3|0x8)).toString(16);
  });
  return uuid;
}